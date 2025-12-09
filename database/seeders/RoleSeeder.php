<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'nama_peran' => 'Admin',
                'deskripsi' => 'petugas untuk mengelola semua data'
            ],
            [
                'nama_peran' => 'Sales',
                'deskripsi' => 'pengelola transaksi pembelian dari pembeli'
            ],
            [
                'nama_peran' => 'Admin Gudang',
                'deskripsi' => 'Pengelola data barang keluar dan masuk'
            ],
            [
                'nama_peran' => 'Staff Inventaris',
                'deskripsi' => 'pembuat laporan dan pembuatan surat jalan'
            ],
        ]);
    }
}
