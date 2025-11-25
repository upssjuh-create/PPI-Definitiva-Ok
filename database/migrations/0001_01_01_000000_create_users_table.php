<?php

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

            // Tipo de usuário: student | server | external | admin
            $table->enum('user_type', ['student', 'server', 'external', 'admin'])
                  ->default('student');

            // --- Dados do aluno ---
            $table->string('registration_number')->nullable()->unique();
            $table->string('course')->nullable();
            $table->integer('semester')->nullable();

            // --- Dados do servidor ---
            $table->string('server_code')->nullable();
            $table->string('sector')->nullable();

            // --- Dados do usuário externo ---
            $table->string('external_school')->nullable();
            $table->string('external_course')->nullable();

            // Telefone e CPF (opcional)
            $table->string('phone')->nullable();
            $table->string('cpf')->nullable();

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
