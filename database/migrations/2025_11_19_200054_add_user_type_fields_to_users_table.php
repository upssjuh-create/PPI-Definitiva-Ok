<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            // Criar user_type (porque não existe ainda)
            $table->enum('user_type', ['student', 'server', 'external'])
                ->default('student')
                ->after('password');

            // Campos do Servidor
            $table->string('server_code')->nullable()->after('user_type');
            $table->string('sector')->nullable()->after('server_code');

            // Campos do Estudante
            $table->string('registration_number')->nullable()->after('sector');
            $table->string('course')->nullable()->after('registration_number');
            $table->integer('semester')->nullable()->after('course');

            // Campos do Externo
            $table->string('external_school')->nullable()->after('semester');
            $table->string('external_course')->nullable()->after('external_school');

            // Telefone (caso não exista)
            $table->string('phone')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'user_type',
                'server_code',
                'sector',
                'registration_number',
                'course',
                'semester',
                'external_school',
                'external_course',
                'phone',
            ]);
        });
    }
};
