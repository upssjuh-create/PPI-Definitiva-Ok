<?php
// database/migrations/2024_01_03_create_registrations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            
            // Check-in
            $table->boolean('checked_in')->default(false);
            $table->timestamp('check_in_time')->nullable();
            $table->string('check_in_code')->unique()->nullable();
            
            // Status
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            
            $table->timestamps();
            
            // Unique constraint: um usuário só pode se inscrever uma vez em cada evento
            $table->unique(['user_id', 'event_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('registrations');
    }
};