<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\TransaksiPenjualan;
use App\Models\TransaksiPenjualanDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiPenjualanDetail>
 */
class TransaksiPenjualanDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TransaksiPenjualanDetail::class;

    public function definition(): array
    {
        $barang = Barang::inRandomOrder()->first();

        return [
            'transaksi_id' => TransaksiPenjualan::factory(),
            'barang_id' => $barang->id,
            'jumlah' => $this->faker->numberBetween(1, 50),
            'harga_satuan' => $barang->harga_jual,
        ];
    }
}
