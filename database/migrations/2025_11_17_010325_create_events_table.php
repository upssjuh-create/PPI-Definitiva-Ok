<?php
// database/migrations/2024_01_02_create_events_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->time('time');
            $table->string('location');
            $table->string('category');
            $table->string('organizer');
            $table->integer('capacity');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('image')->nullable();
            
            // Palestrantes (JSON)
            $table->json('speakers')->nullable();
            
            // Tags (JSON)
            $table->json('tags')->nullable();
            
            // Status
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_active')->default(true);
            
            // Configurações de pagamento (JSON)
            $table->json('payment_config')->nullable();
            
            // Configurações de certificado
            $table->integer('certificate_hours')->nullable();
            $table->text('certificate_description')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};