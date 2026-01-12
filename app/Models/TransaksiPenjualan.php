<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengguna_id',
        'so_id',
        'tanggal_transaksi',
        'tanggal_antar',
        'total_harga',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
        'tanggal_antar' => 'date',
        'total_harga' => 'decimal:0',
    ];

    // Relasi
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'so_id');
    }

    public function details()
    {
        return $this->hasMany(TransaksiPenjualanDetail::class, 'transaksi_id');
    }
}
