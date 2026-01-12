<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'jumlah',
        'harga_satuan',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'harga_satuan' => 'decimal:0',
    ];

    // Relasi
    public function transaksi()
    {
        return $this->belongsTo(TransaksiPenjualan::class, 'transaksi_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
