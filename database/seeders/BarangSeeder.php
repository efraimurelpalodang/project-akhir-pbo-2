<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::insert([
            [
                'satuan_id' => 4, 
                'kode' => 'BRG001',
                'nama_barang' => 'Semen 40kg',
                'harga_jual' => 58000,
                'jumlah_stok' => 120,
            ],
            [
                'satuan_id' => 1, 
                'kode' => 'BRG002',
                'nama_barang' => 'Bata Merah',
                'harga_jual' => 800,
                'jumlah_stok' => 5000,
            ],
            [
                'satuan_id' => 1,
                'kode' => 'BRG003',
                'nama_barang' => 'Batako Press',
                'harga_jual' => 3500,
                'jumlah_stok' => 1500,
            ],
            [
                'satuan_id' => 5, 
                'kode' => 'BRG004',
                'nama_barang' => 'Cat Tembok 5 Liter',
                'harga_jual' => 95000,
                'jumlah_stok' => 40,
            ],
            [
                'satuan_id' => 1,
                'kode' => 'BRG005',
                'nama_barang' => 'Paku 2 Inch',
                'harga_jual' => 15000,
                'jumlah_stok' => 200,
            ],
            [
                'satuan_id' => 2, 
                'kode' => 'BRG006',
                'nama_barang' => 'Keramik Lantai 40x40',
                'harga_jual' => 48000,
                'jumlah_stok' => 90,
            ],
            [
                'satuan_id' => 3, 
                'kode' => 'BRG007',
                'nama_barang' => 'Lem Kayu Putih',
                'harga_jual' => 18000,
                'jumlah_stok' => 120,
            ],
            [
                'satuan_id' => 1,
                'kode' => 'BRG008',
                'nama_barang' => 'Pipa PVC 3 Inch',
                'harga_jual' => 35000,
                'jumlah_stok' => 80,
            ],
            [
                'satuan_id' => 1,
                'kode' => 'BRG009',
                'nama_barang' => 'Kunci Inggris',
                'harga_jual' => 25000,
                'jumlah_stok' => 40,
            ],
            [
                'satuan_id' => 1,
                'kode' => 'BRG010',
                'nama_barang' => 'Gergaji Kayu',
                'harga_jual' => 30000,
                'jumlah_stok' => 30,
            ],
            [
                'satuan_id' => 1,
                'kode' => 'BRG011',
                'nama_barang' => 'Cat Besi 1 Liter',
                'harga_jual' => 55000,
                'jumlah_stok' => 50,
            ],
            [
                'satuan_id' => 4, // KG
                'kode' => 'BRG012',
                'nama_barang' => 'Besi Beton 10mm',
                'harga_jual' => 74000,
                'jumlah_stok' => 100,
            ],
            [
                'satuan_id' => 1,
                'kode' => 'BRG013',
                'nama_barang' => 'Engsel Pintu 4 Inch',
                'harga_jual' => 12000,
                'jumlah_stok' => 200,
            ],
            [
                'satuan_id' => 1,
                'kode' => 'BRG014',
                'nama_barang' => 'Handle Pintu',
                'harga_jual' => 35000,
                'jumlah_stok' => 70,
            ],
            [
                'satuan_id' => 1,
                'kode' => 'BRG015',
                'nama_barang' => 'Skru Gypsum',
                'harga_jual' => 25000,
                'jumlah_stok' => 300,
            ],
        ]);
    }
}
