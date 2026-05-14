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
        Schema::create('barang', function (Blueprint $table) {
        $table->id('id_barang');
        $table->string('nama_barang');
        $table->string('lokasi')->nullable();
        $table->enum('kategori_barang', ['tas/dompet', 'elektronik', 'alat tulis', 'dokumen', 'kartu identitas', 'lainnya']);
        $table->binary('foto_barang')->nullable(); // blob
        
        $table->unsignedBigInteger('fk_id_laporan');
        $table->foreign('fk_id_laporan')->references('id_laporan')->on('laporan')->onDelete('cascade');
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
