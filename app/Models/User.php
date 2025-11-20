<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',

        // Tipo do usuário (student, server, external)
        'user_type',

        // Dados do aluno
        'registration_number',
        'course',
        'semester',

        // Dados do servidor
        'server_code',
        'sector',

        // Dados do usuário externo
        'external_school',
        'external_course',

        // Outros
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relacionamentos
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Helpers
    public function isAluno()
    {
        return $this->user_type === 'student';
    }

    public function isServidor()
    {
        return $this->user_type === 'server';
    }

    public function isExterno()
    {
        return $this->user_type === 'external';
    }
}
