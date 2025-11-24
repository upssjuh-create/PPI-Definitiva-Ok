<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Verificar se as colunas já existem antes de adicionar
            if (!Schema::hasColumn('payments', 'pix_txid')) {
                $table->string('pix_txid')->nullable()->after('payment_method');
            }
            if (!Schema::hasColumn('payments', 'pix_payload')) {
                $table->text('pix_payload')->nullable()->after('pix_txid');
            }
            if (!Schema::hasColumn('payments', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('status');
            }
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'pix_txid')) {
                $table->dropColumn('pix_txid');
            }
            if (Schema::hasColumn('payments', 'pix_payload')) {
                $table->dropColumn('pix_payload');
            }
            if (Schema::hasColumn('payments', 'paid_at')) {
                $table->dropColumn('paid_at');
            }
        });
    }
};
