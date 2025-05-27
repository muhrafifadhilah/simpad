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
        Schema::create('groups_privileges', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('module');
            $table->boolean('baca')->default(false);
            $table->boolean('tambah')->default(false);
            $table->boolean('edit')->default(false);
            $table->boolean('hapus')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups_privileges');
    }
};
