<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Registro de novo usuário
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|in:aluno,servidor_iffar,externo,admin',
            'cpf' => 'required|string|unique:users|size:11',
            'phone' => 'nullable|string',
            
            // Campos específicos para aluno (todos opcionais)
            'registration_number' => 'nullable|string|unique:users',
            'course' => 'nullable|string',
            'semester' => 'nullable|integer',
            
            // Campos específicos para servidor IFFAR
            'department' => 'required_if:user_type,servidor_iffar|nullable|string',
            
            // Campos específicos para externo
            'institution' => 'required_if:user_type,externo|nullable|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_type' => $validated['user_type'],
            'cpf' => $validated['cpf'],
            'phone' => $validated['phone'] ?? null,
            'registration_number' => $validated['registration_number'] ?? null,
            'course' => $validated['course'] ?? null,
            'semester' => $validated['semester'] ?? null,
            'department' => $validated['department'] ?? null,
            'institution' => $validated['institution'] ?? null,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso'
        ]);
    }

    // Usuário atual
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}