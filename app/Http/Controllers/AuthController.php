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
        // 1. Validação básica
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
    
            // novo tipo para separar aluno, servidor, externo
            'type' => 'required|in:aluno,servidor,externo',
        ]);
    
        // 2. Validações condicionais
        if ($request->type === 'aluno') {
            $request->validate([
                'registration_number' => 'required|string|unique:users',
                'course' => 'required|string|max:255',
                'semester' => 'required|integer|min:1|max:12',
            ]);
        }
    
        if ($request->type === 'servidor') {
            $request->validate([
                'sector' => 'required|string|max:255',
                'verification_code' => 'required|string|in:CODIGO123,CODIGO456',
            ]);
        }
    
        if ($request->type === 'externo') {
            $request->validate([
                'external_school' => 'required|string|max:255',
                'external_course' => 'required|string|max:255',
            ]);
        }
    
        // 3. Criação do usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
    
            'type' => $request->type,
    
            // aluno
            'registration_number' => $request->registration_number,
            'course' => $request->course,
            'semester' => $request->semester,
    
            // servidor
            'sector' => $request->sector,
            'verification_code' => $request->verification_code,
    
            // externo
            'external_school' => $request->external_school,
            'external_course' => $request->external_course,
        ]);
    
        // token de login
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
