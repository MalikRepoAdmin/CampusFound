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
        Schema::create('klaim', function (Blueprint $table) {
            $table->id();
            $table->string('ciri'); 
            $table->string('foto_bukti'); 
            
            $table->dateTime('created_at'); 
            
            $table->unsignedBigInteger('fk_id_user');
            $table->unsignedBigInteger('fk_id_laporan');

            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klaim');
    }
};
