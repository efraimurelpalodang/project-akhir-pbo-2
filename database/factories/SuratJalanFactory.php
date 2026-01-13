<?php

namespace Database\Factories;

use App\Models\Pengguna;
use App\Models\SalesOrder;
use App\Models\SuratJalan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratJalan>
 */
class SuratJalanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SuratJalan::class;

    public function definition(): array
    {
        $tanggalSj = $this->faker->dateTimeBetween('-20 days', 'now');
        $tanggalAntar = $this->faker->dateTimeBetween($tanggalSj, '+5 days');

        return [
            'so_id' => SalesOrder::factory(),
            'pengguna_id' => Pengguna::inRandomOrder()->first()->id ?? 1,
            'tanggal_sj' => $tanggalSj,
            'tanggal_pengantaran' => $tanggalAntar,
        ];
    }
}
