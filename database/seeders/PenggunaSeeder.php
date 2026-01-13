<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengguna::factory()->count(5)->create();
        Pengguna::create([
            'role_id' => 1,
            'username' => 'admin1',
            'password' => bcrypt('password123'),
            'nama_pengguna' => 'Admin Utama',
            'telp' => '0812345678910',
        ]);
    }
}
