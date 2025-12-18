<?php

namespace Database\Seeders;

use App\Models\Pembeli;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Pembeli::factory()->count(20)->create();
        $this->call([
            SatuanSeeder::class,
            BarangSeeder::class,
            RoleSeeder::class,
            PenggunaSeeder::class,
        ]);
    }
}
