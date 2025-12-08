<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiPenjualan extends Model
{
    protected $fillable = ['pengguna_id','pembeli_id','tanggal_transaksi','tanggal_antar','total_harga'];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(pengguna::class);
    }

    public function pembeli(): BelongsTo
    {
        return $this->belongsTo(pembeli::class);
    }

    public function transaksi_detail(): HasMany
    {
        return $this->hasMany(transaksiPenjualan::class);
    }
}
