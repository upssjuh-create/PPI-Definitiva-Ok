<?php
// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'registration_id',
        'user_id',
        'event_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id',
        'payment_data',
        'paid_at',
        'mercadopago_payment_id',
        'pix_txid',
        'pix_payload',
        'pix_qr_code',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    // Relacionamentos
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Helpers
    public function isPaid()
    {
        return $this->status === 'paid';
    }

    public function markAsPaid()
    {
        $this->status = 'paid';
        $this->paid_at = now();
        $this->save();

        // Confirmar inscrição
        $this->registration->update(['status' => 'confirmed']);
    }
}