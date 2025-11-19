<?php
// database/migrations/2024_01_01_create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            // Novo tipo de usuário
            $table->enum('type', ['aluno', 'servidor', 'externo']);

            // --- Dados do aluno ---
            $table->string('registration_number')->nullable()->unique();
            $table->string('course')->nullable();
            $table->integer('semester')->nullable();

            // --- Dados do servidor ---
            $table->string('sector')->nullable();
            $table->string('verification_code')->nullable();

            // --- Dados do externo ---
            $table->string('external_school')->nullable();
            $table->string('external_course')->nullable();

            // Telefone (opcional)
            $table->string('phone')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
