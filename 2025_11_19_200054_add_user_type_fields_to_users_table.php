<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            // Novo tipo de usuário
            $table->enum('user_type', ['student', 'server', 'external'])
                ->default('student')
                ->change();

            // Campos do Servidor
            $table->string('server_code')->nullable()->after('user_type');
            $table->string('sector')->nullable()->after('server_code');

            // Campos do Estudante
            $table->string('course')->nullable()->change();
            $table->integer('semester')->nullable()->change();

            // Campos do Externo
            $table->string('external_school')->nullable();
            $table->string('external_course')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            // Reverter para o estado anterior
            $table->enum('user_type', ['student', 'admin'])->default('student')->change();

            $table->dropColumn([
                'server_code',
                'sector',
                'external_school',
                'external_course',
            ]);
        });
    }
};