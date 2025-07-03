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
        Schema::create('subjek_pajak', function (Blueprint $table) {
            $table->id();
            $table->string('no_form');
            $table->date('tanggal');
            $table->enum('pribadi_badan', ['pribadi', 'badan']);
            $table->string('pemilik');
            $table->string('subjek_pajak');
            $table->string('alamat');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('kabupaten');
            $table->string('kode_pos');
            $table->string('nohp');
            $table->string('email');
            $table->string('npwpd')->unique();
            $table->string('noPengukuhan');
            $table->date('tanggalPengukuhan');
            $table->string('pejabat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjek_pajak');
    }
};
