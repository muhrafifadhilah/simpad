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
        Schema::create('objek_pajak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subjek_pajak_id')->constrained('subjek_pajak')->onDelete('cascade');
            $table->string('nopd')->unique();
            $table->string('nama_usaha');
            $table->string('kategori_usaha');
            $table->string('jenis_usaha');
            $table->string('jenis_pajak');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('alamat');
            $table->string('keterangan');
            $table->float('langtitude');
            $table->float('longitude');
            $table->enum('status', ['aktif', 'tutup', 'tutup-sementara'])->default('aktif');
            $table->date('status_tmt');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objek_pajak');
    }
};
