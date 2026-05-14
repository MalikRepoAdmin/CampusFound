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
        Schema::create('laporan', function (Blueprint $table) {
        $table->id('id_laporan');
        $table->enum('kategori_laporan', ['lost', 'found']);
        $table->enum('status_laporan', ['active', 'resolved']);
        $table->string('deskripsi')->nullable();
        
        // Foreign Key ke tabel users
        $table->unsignedBigInteger('fk_id_user');
        $table->foreign('fk_id_user')->references('id_user')->on('users')->onDelete('cascade');
        
        $table->timestamps(); // Ini otomatis membuat created_at & updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
