<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    protected $fillable = [
        'name',
        'title',
        'image_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relacionamento com eventos (assinatura 1)
    public function eventsAsSignature1()
    {
        return $this->hasMany(Event::class, 'signature1_id');
    }

    // Relacionamento com eventos (assinatura 2)
    public function eventsAsSignature2()
    {
        return $this->hasMany(Event::class, 'signature2_id');
    }

    // Helper para obter URL completa da imagem
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}
