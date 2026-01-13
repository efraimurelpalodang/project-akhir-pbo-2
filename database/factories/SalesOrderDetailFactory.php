<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesOrderDetail>
 */
class SalesOrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SalesOrderDetail::class;
    
    public function definition(): array
    {
        $barang = Barang::inRandomOrder()->first();

        return [
            'so_id' => SalesOrder::factory(),
            'barang_id' => $barang->id,
            'jumlah' => $this->faker->numberBetween(1, 50),
            'harga_satuan' => $barang->harga_jual,
        ];
    }
}
