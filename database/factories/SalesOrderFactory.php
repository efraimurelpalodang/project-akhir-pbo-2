<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\Pengguna;
use App\Models\SalesOrder;
use App\Models\SalesOrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesOrder>
 */
class SalesOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SalesOrder::class;

    public function definition(): array
    {
        return [
            'pembeli_id' => Pembeli::inRandomOrder()->first()->id ?? 1,
            'pengguna_id' => Pengguna::inRandomOrder()->first()->id ?? 1,
            'tanggal_so' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'status' => $this->faker->randomElement(['menunggu', 'proses_persiapan', 'siap_kirim', 'dikirim']),
            'total_harga' => 0,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (SalesOrder $salesOrder) {
            // Buat 2-5 detail items
            $jumlahDetail = rand(2, 5);
            $barangs = Barang::inRandomOrder()->limit($jumlahDetail)->get();

            $totalHarga = 0;
            foreach ($barangs as $barang) {
                $jumlah = rand(1, 50);
                $hargaSatuan = $barang->harga_jual;

                SalesOrderDetail::create([
                    'so_id' => $salesOrder->id,
                    'barang_id' => $barang->id,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $hargaSatuan,
                ]);

                $totalHarga += ($jumlah * $hargaSatuan);
            }

            // Update total harga
            $salesOrder->update(['total_harga' => $totalHarga]);
        });
    }

    public function menunggu()
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'menunggu',
        ]);
    }

    public function prosesPersiapan()
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'proses_persiapan',
        ]);
    }

    public function siapKirim()
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'siap_kirim',
        ]);
    }

    public function dikirim()
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'dikirim',
        ]);
    }

    public function dibatalkan()
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'dibatalkan',
        ]);
    }
}
