<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pembeli;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SalesOrder;
use App\Models\SuratJalan;
use Illuminate\Database\Seeder;
use App\Models\TransaksiPenjualan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PenggunaSeeder::class,
            SatuanSeeder::class,
            BarangSeeder::class,
        ]);

        Pembeli::factory()->count(20)->create();

        SalesOrder::factory(5)->menunggu()->create();
        SalesOrder::factory(3)->prosesPersiapan()->create();
        SalesOrder::factory(3)->siapKirim()->create();

        $sosDikirim = SalesOrder::factory(5)->dikirim()->create();

        SalesOrder::factory(2)->dibatalkan()->create();

        $sosDikirim->each(function ($so) {
            SuratJalan::factory()->create([
                'so_id' => $so->id,
                'tanggal_sj' => $so->tanggal_so,
            ]);
        });

        $sosDikirim->each(function ($so) {
            TransaksiPenjualan::factory()->forSalesOrder($so)->create();
        });
    }
}
