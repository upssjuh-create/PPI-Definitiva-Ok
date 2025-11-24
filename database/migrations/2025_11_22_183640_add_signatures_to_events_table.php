<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('signature1_id')->nullable()->constrained('signatures')->onDelete('set null');
            $table->foreignId('signature2_id')->nullable()->constrained('signatures')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['signature1_id']);
            $table->dropForeign(['signature2_id']);
            $table->dropColumn(['signature1_id', 'signature2_id']);
        });
    }
};
