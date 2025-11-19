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
        'payment_config',
        'certificate_hours',
        'certificate_description',
    ];

    protected $casts = [
        'date' => 'date',
        'speakers' => 'array',
        'tags' => 'array',
        'payment_config' => 'array',
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

    // Helpers
    public function isFree()
    {
        return $this->price == 0;
    }

    public function hasAvailableSpots()
    {
        return $this->registrations()->count() < $this->capacity;
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