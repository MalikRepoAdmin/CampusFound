<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Laporan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Laporan>
 */
class LaporanFactory extends Factory
{
    protected $model = Laporan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // id_laporan is skipped here since it is auto-incrementing (AU)
            'fk_id_user' => \App\Models\User::factory(), // Dynamically provisions a parent user if not overridden
            'kategori_laporan' => $this->faker->randomElement(['lost', 'found']),
            'status_laporan' => 'active',
            'deskripsi' => $this->faker->paragraph(),
        ];
    }

    /**
     * Configure the model factory hooks.
     */
    public function configure()
    {
        // Execute this logic immediately after the Laporan record is saved to the test DB
        return $this->afterCreating(function (Laporan $laporan) {
            // Automatically spawn 1 matching Barang linked to your custom primary id_laporan
            Barang::factory()->create([
                'fk_id_laporan' => $laporan->id_laporan,
                'kategori_barang' => $this->faker->randomElement(['tas/dompet', 'elektronik', 'alat tulis', 'dokumen', 'kartu identitas', 'lainnya']),
                'nama_barang' => $this->faker->word(),
                'lokasi' => $this->faker->address(),
                'foto_barang' => 'photos/' . $this->faker->word() . 'jpeg',
            ]);
        });
    }
}
