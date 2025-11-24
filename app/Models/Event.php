<?php
// app/Models/Event.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'category',
        'organizer',
        'capacity',
        'price',
        'image',
        'speakers',
        'tags',
        'is_completed',
        'is_active',
        'certificate_hours',
        'certificate_description',
        'signature1_id',
        'signature2_id',
    ];

    protected $casts = [
        'date' => 'date',
        'speakers' => 'array',
        'tags' => 'array',
        'is_completed' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
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

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function signature1()
    {
        return $this->belongsTo(Signature::class, 'signature1_id');
    }

    public function signature2()
    {
        return $this->belongsTo(Signature::class, 'signature2_id');
    }

    // Helpers
    public function isPast()
    {
        return $this->date->isPast();
    }

    public function canEdit()
    {
        return !$this->isPast();
    }
    public function isFree()
    {
        return $this->price == 0;
    }

    public function hasAvailableSpots()
    {
        return $this->registrations()->where('status', 'confirmed')->count() < $this->capacity;
    }

    public function registeredCount()
    {
        return $this->registrations()->where('status', 'confirmed')->count();
    }

    public function attendeesCount()
    {
        return $this->registrations()->where('checked_in', true)->count();
    }
}