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

        $events = $query->orderBy('date', 'desc')
                       ->get()
                       ->map(function($event) {
                           // Contar apenas inscrições confirmadas
                           $event->registered_count = $event->registrations()
                               ->where('status', 'confirmed')
                               ->count();
                           
                           // Verificar se o usuário está inscrito
                           $event->is_user_registered = false;
                           $event->user_registration = null;
                           if (auth()->check()) {
                               $registration = $event->registrations()
                                   ->where('user_id', auth()->id())
                                   ->where('status', '!=', 'cancelled')
                                   ->with(['payment'])
                                   ->first();
                               
                               if ($registration) {
                                   $event->is_user_registered = true;
                                   $event->user_registration = $registration;
                               }
                           }
                           
                           return $event;
                       });

        return response()->json($events);
    }

    // Detalhes de um evento
    public function show(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        // Verificar se o usuário está inscrito
        $event->is_user_registered = false;
        $event->user_registration = null;
        
        // Tentar obter o usuário autenticado via Sanctum
        $user = $request->user();
        
        \Log::info('=== EVENT SHOW DEBUG ===', [
            'event_id' => $id,
            'user_authenticated' => $user ? true : false,
            'user_id' => $user ? $user->id : null,
            'user_email' => $user ? $user->email : null,
        ]);
        
        if ($user) {
            // Buscar qualquer inscrição que não seja cancelada
            $registration = $event->registrations()
                ->where('user_id', $user->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->with(['payment', 'user'])
                ->first();
            
            \Log::info('Registration found:', [
                'registration' => $registration ? $registration->toArray() : null
            ]);
            
            if ($registration) {
                $event->is_user_registered = true;
                $event->user_registration = $registration;
            }
        }
        
        // Adicionar contagem de inscritos confirmados
        $event->registered_count = $event->registrations()
            ->where('status', 'confirmed')
            ->count();

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
            'certificate_hours' => 'nullable|integer',
            'certificate_description' => 'nullable|string',
        ]);

        // Upload de imagem
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                                         ->store('events', 'public');
        }

        // Gerar código único de check-in
        $validated['check_in_code'] = $this->generateCheckInCode();

        $event = Event::create($validated);

        return response()->json($event, 201);
    }

    // Gerar código único de check-in
    private function generateCheckInCode()
    {
        do {
            $code = strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
        } while (Event::where('check_in_code', $code)->exists());
        
        return $code;
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