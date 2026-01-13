<?php

namespace Database\Factories;

use App\Models\Pengguna;
use App\Models\SalesOrder;
use App\Models\TransaksiPenjualan;
use App\Models\TransaksiPenjualanDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiPenjualan>
 */
class TransaksiPenjualanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TransaksiPenjualan::class;

    public function definition(): array
    {
        $tanggalTransaksi = $this->faker->dateTimeBetween('-25 days', 'now');

        return [
            'pengguna_id' => Pengguna::inRandomOrder()->first()->id ?? 1,
            'so_id' => SalesOrder::factory(),
            'tanggal_transaksi' => $tanggalTransaksi,
            'tanggal_antar' => $tanggalTransaksi,
            'total_harga' => 0,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (TransaksiPenjualan $transaksi) {
            $salesOrder = $transaksi->salesOrder ?? SalesOrder::find($transaksi->so_id);

            if ($salesOrder && $salesOrder->details) {
                $totalHarga = 0;
                foreach ($salesOrder->details as $detail) {
                    TransaksiPenjualanDetail::create([
                        'transaksi_id' => $transaksi->id,
                        'barang_id' => $detail->barang_id,
                        'jumlah' => $detail->jumlah,
                        'harga_satuan' => $detail->harga_satuan,
                    ]);

                    $totalHarga += ($detail->jumlah * $detail->harga_satuan);
                }

                // Update total harga
                $transaksi->update(['total_harga' => $totalHarga]);
            }
        });
    }

    public function forSalesOrder(SalesOrder $salesOrder)
    {
        return $this->state(fn(array $attributes) => [
            'so_id' => $salesOrder->id,
            'tanggal_transaksi' => $salesOrder->tanggal_so,
            'tanggal_antar' => $salesOrder->tanggal_so,
        ]);
    }
}
