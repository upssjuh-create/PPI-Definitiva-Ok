<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'matricula')) {
                $table->string('matricula')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'curso')) {
                $table->string('curso')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'semestre')) {
                $table->string('semestre')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'telefone')) {
                $table->string('telefone')->nullable()->after('email');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['matricula', 'curso', 'semestre', 'telefone'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
