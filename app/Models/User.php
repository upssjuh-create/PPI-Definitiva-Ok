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

        // Novo tipo (aluno, servidor, externo)
        'type',

        // aluno
        'registration_number',
        'course',
        'semester',

        // servidor
        'sector',
        'verification_code',

        // externo
        'external_school',
        'external_course',

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
        return $this->type === 'aluno';
    }

    public function isServidor()
    {
        return $this->type === 'servidor';
    }

    public function isExterno()
    {
        return $this->type === 'externo';
    }
}
