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
        Schema::create('komentar', function (Blueprint $table) {
        $table->id('id_komentar');
        $table->string('isi_komentar');
        
        // Foreign Keys
        $table->unsignedBigInteger('fk_id_user');
        $table->unsignedBigInteger('fk_id_laporan');
        
        $table->foreign('fk_id_user')->references('id_user')->on('users')->onDelete('cascade');
        $table->foreign('fk_id_laporan')->references('id_laporan')->on('laporan')->onDelete('cascade');
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
