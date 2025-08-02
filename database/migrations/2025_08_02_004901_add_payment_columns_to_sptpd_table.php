<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sptpd', function (Blueprint $table) {
            $table->string('metode_bayar')->nullable()->after('status');
            $table->string('bukti_bayar')->nullable()->after('metode_bayar');
            $table->text('keterangan_bayar')->nullable()->after('bukti_bayar');
            $table->timestamp('tanggal_bayar')->nullable()->after('keterangan_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sptpd', function (Blueprint $table) {
            $table->dropColumn(['metode_bayar', 'bukti_bayar', 'keterangan_bayar', 'tanggal_bayar']);
        });
    }
};
