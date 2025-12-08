<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiPenjualanDetail extends Model
{
    protected $fillable = ['transaksi_id','barang_id','jumlah','harga_satuan'];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(transaksiPenjualan::class);
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(barang::class);
    }
}
