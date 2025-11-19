<?php
// app/Models/Registration.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Registration extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'checked_in',
        'check_in_time',
        'check_in_code',
        'status',
    ];

    protected $casts = [
        'checked_in' => 'boolean',
        'check_in_time' => 'datetime',
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

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }

    // Auto-gerar código de check-in
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($registration) {
            if (empty($registration->check_in_code)) {
                $registration->check_in_code = strtoupper(Str::random(8));
            }
        });
    }
}