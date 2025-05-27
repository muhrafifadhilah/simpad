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
        Schema::create('has_groups_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wp_id')
                ->constrained('wp')
                ->onDelete('cascade');
            $table->foreignId('groups_user_id')
                ->constrained('groups_user')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('has_groups_user');
    }
};
