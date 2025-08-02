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
            $table->string('nomor_sptpd')->nullable()->after('id');
            $table->string('status')->default('Draft')->after('omset_tapping_box');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sptpd', function (Blueprint $table) {
            $table->dropColumn(['nomor_sptpd', 'status']);
        });
    }
};
