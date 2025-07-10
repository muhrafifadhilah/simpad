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
        Schema::create('sptpd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('objek_pajak_id')->constrained('objek_pajak')->onDelete('cascade');
            $table->foreignId('subjek_pajak_id')->constrained('subjek_pajak')->onDelete('cascade');
            $table->foreignId('upt_id')->constrained('upt')->onDelete('cascade');
            $table->date('masa_pajak_awal');
            $table->date('masa_pajak_akhir');
            $table->date('jatuh_tempo');
            $table->bigInteger('dasar'); // ubah ke bigInteger
            $table->float('tarif');
            $table->bigInteger('denda');
            $table->bigInteger('bunga');
            $table->bigInteger('setoran');
            $table->bigInteger('lain_lain');
            $table->bigInteger('kenaikan');
            $table->bigInteger('kompensasi');
            $table->bigInteger('pajak_terutang');
            $table->bigInteger('omset_tapping_box');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sptpd');
    }
};
