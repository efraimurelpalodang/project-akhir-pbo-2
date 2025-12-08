<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembeli extends Model
{
    /** @use HasFactory<\Database\Factories\PembeliFactory> */
    use HasFactory;

    protected $fillable = ['nama_pembeli','alamat','telp'];

    public function so() :BelongsTo 
    {
        return $this->belongsTo(salesOrder::class);    
    }

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(transaksiPenjualan::class);
    }
}
