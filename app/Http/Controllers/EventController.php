<?php
// app/Http/Controllers/EventController.php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Listar todos os eventos
    public function index(Request $request)
    {
        $query = Event::query()->where('is_active', true);

        // Filtros
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('is_completed')) {
            $query->where('is_completed', $request->is_completed);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $events = $query->withCount('registrations')
                       ->orderBy('date', 'desc')
                       ->get()
                       ->map(function($event) {
                           $event->registered = $event->registrations_count;
                           return $event;
                       });

        return response()->json($events);
    }

    // Detalhes de um evento
    public function show($id)
    {
        $event = Event::with(['registrations.user'])
                     ->withCount('registrations')
                     ->findOrFail($id);

        $event->registered = $event->registrations_count;

        return response()->json($event);
    }

    // Criar evento (Admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string',
            'category' => 'required|string',
            'organizer' => 'required|string',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'speakers' => 'nullable|array',
            'tags' => 'nullable|array',
            'payment_config' => 'nullable|array',
            'certificate_hours' => 'nullable|integer',
            'certificate_description' => 'nullable|string',
        ]);

        // Upload de imagem
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                                         ->store('events', 'public');
        }

        $event = Event::create($validated);

        return response()->json($event, 201);
    }

    // Atualizar evento (Admin)
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'date' => 'sometimes|date',
            'time' => 'sometimes',
            'location' => 'sometimes|string',
            'category' => 'sometimes|string',
            'organizer' => 'sometimes|string',
            'capacity' => 'sometimes|integer|min:1',
            'price' => 'sometimes|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'speakers' => 'nullable|array',
            'tags' => 'nullable|array',
            'payment_config' => 'nullable|array',
            'is_completed' => 'sometimes|boolean',
            'certificate_hours' => 'nullable|integer',
            'certificate_description' => 'nullable|string',
        ]);

        // Upload de nova imagem
        if ($request->hasFile('image')) {
            // Deletar imagem antiga
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')
                                         ->store('events', 'public');
        }

        $event->update($validated);

        return response()->json($event);
    }

    // Deletar evento (Admin)
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Deletar imagem
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return response()->json([
            'message' => 'Evento deletado com sucesso'
        ]);
    }
}