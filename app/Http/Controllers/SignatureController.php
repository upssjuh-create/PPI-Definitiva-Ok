<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
    /**
     * Listar todas as assinaturas
     */
    public function index()
    {
        $signatures = Signature::orderBy('name')->get();
        return response()->json($signatures);
    }

    /**
     * Criar nova assinatura
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Upload da imagem
        $imagePath = $request->file('image')->store('signatures', 'public');

        $signature = Signature::create([
            'name' => $validated['name'],
            'title' => $validated['title'],
            'image_path' => $imagePath,
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Assinatura criada com sucesso',
            'signature' => $signature
        ], 201);
    }

    /**
     * Atualizar assinatura
     */
    public function update(Request $request, $id)
    {
        $signature = Signature::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            'image' => 'sometimes|image|mimes:png,jpg,jpeg|max:2048',
            'is_active' => 'sometimes|boolean',
        ]);

        // Se houver nova imagem, fazer upload e deletar a antiga
        if ($request->hasFile('image')) {
            // Deletar imagem antiga
            if ($signature->image_path) {
                Storage::disk('public')->delete($signature->image_path);
            }
            
            // Upload nova imagem
            $validated['image_path'] = $request->file('image')->store('signatures', 'public');
        }

        $signature->update($validated);

        return response()->json([
            'message' => 'Assinatura atualizada com sucesso',
            'signature' => $signature
        ]);
    }

    /**
     * Deletar assinatura
     */
    public function destroy($id)
    {
        $signature = Signature::findOrFail($id);

        // Deletar imagem
        if ($signature->image_path) {
            Storage::disk('public')->delete($signature->image_path);
        }

        $signature->delete();

        return response()->json([
            'message' => 'Assinatura deletada com sucesso'
        ]);
    }
}
