<?php
// app/Models/Certificate.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'registration_id',
        'certificate_code',
        'pdf_path',
        'issued_at',
        'validation_count',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];

    // Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    // Auto-gerar código do certificado
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificate) {
            if (empty($certificate->certificate_code)) {
                $certificate->certificate_code = 'IFFAR' . date('Y') . strtoupper(Str::random(6));
            }
            if (empty($certificate->issued_at)) {
                $certificate->issued_at = now();
            }
        });
    }

    // Helper para validação
    public function incrementValidation()
    {
        $this->increment('validation_count');
    }
}