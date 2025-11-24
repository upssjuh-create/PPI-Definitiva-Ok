<?php
// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Registro de novo usuário
    public function register(Request $request)
    {
        // Validação geral
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
<<<<<<< HEAD
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
=======
    
            // student / server / external
            'user_type' => 'required|in:student,server,external',
    
            // Campos do aluno
            'registration_number' => 'required_if:user_type,student|nullable|string|max:50',
            'course' => 'required_if:user_type,student|nullable|string|max:255',
            'semester' => 'required_if:user_type,student|nullable|integer',
    
            // Campos do servidor
            'server_code' => ['required_if:user_type,server','nullable','string','max:50','in:' . env('SERVER_CODE_SECRETO') ],
            'sector' => 'required_if:user_type,server|nullable|string|max:255',
    
            // Campos do externo
            'external_school' => 'required_if:user_type,external|nullable|string|max:255',
            'external_course' => 'required_if:user_type,external|nullable|string|max:255',
    
            'phone' => 'nullable|string|max:20'
>>>>>>> daee4a14bc98567d00e4f14d4f62ade5f371d630
        ]);
    
        // Criação do usuário
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
    
            'user_type' => $validated['user_type'],
<<<<<<< HEAD
            'cpf' => $validated['cpf'],
            'phone' => $validated['phone'] ?? null,
            'registration_number' => $validated['registration_number'] ?? null,
            'course' => $validated['course'] ?? null,
            'semester' => $validated['semester'] ?? null,
            'department' => $validated['department'] ?? null,
            'institution' => $validated['institution'] ?? null,
=======
    
            // Aluno
            'registration_number' => $validated['registration_number'] ?? null,
            'course' => $validated['course'] ?? null,
            'semester' => $validated['semester'] ?? null,
    
            // Servidor
            'server_code' => $validated['server_code'] ?? null,
            'sector' => $validated['sector'] ?? null,
    
            // Externo
            'external_school' => $validated['external_school'] ?? null,
            'external_course' => $validated['external_course'] ?? null,
    
            'phone' => $validated['phone'] ?? null,
>>>>>>> daee4a14bc98567d00e4f14d4f62ade5f371d630
        ]);
    
        // Token
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
