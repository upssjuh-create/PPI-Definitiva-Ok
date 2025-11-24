<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Obter dados do perfil
     */
    public function show()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    /**
     * Atualizar perfil
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'user_type' => 'sometimes|in:student,server,external',
            'matricula' => 'nullable|string|max:50',
            'curso' => 'nullable|string|max:255',
            'semestre' => 'nullable|string|max:20',
            'telefone' => 'nullable|string|max:20',
            'cpf' => 'nullable|string|max:20',
            'institution' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Se houver senha, fazer hash
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'Perfil atualizado com sucesso',
            'user' => $user
        ]);
    }
}
