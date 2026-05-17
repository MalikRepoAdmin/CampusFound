<?php

namespace Database\Factories;

use App\Models\Komentar;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Komentar>
 */
class KomentarFactory extends Factory
{
    protected $model = Komentar::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'isi_komentar'  => $this->faker->paragraph(),
            'fk_id_user'    => User::factory(),    
            'fk_id_laporan' => Laporan::factory(), 
            'created_at'    => now(),
        ];
    }
}
