<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CampusFoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed User
        $userId = DB::table('users')->insertGetId([
            'email' => 'asep@mbg.id',
            'password' => Hash::make('password123'),
            'no_hp' => '08123456789',
            'created_at' => now(),
        ]);

        // 2. Seed Laporan
        $laporanId = DB::table('laporan')->insertGetId([
            'kategori_laporan' => 'found',
            'status_laporan' => 'active',
            'deskripsi' => 'Ditemukan kunci helikopter di lapangan Jaya Maju',
            'fk_id_user' => $userId,
            'created_at' => now(),
        ]);

        // 3. Seed Barang
        DB::table('barang')->insert([
            'nama_barang' => 'Kunci Helikopter',
            'lokasi' => 'Lapangan Jaya Maju',
            'kategori_barang' => 'lainnya',
            'fk_id_laporan' => $laporanId,
            'created_at' => now(),
        ]);

        // 4. Seed Komentar
        DB::table('komentar')->insert([
            'isi_komentar' => 'Izin bertanya, apakah ada gantungan kuncinya?',
            'fk_id_user' => $userId,
            'fk_id_laporan' => $laporanId,
            'created_at' => now(),
        ]);
        }
}
