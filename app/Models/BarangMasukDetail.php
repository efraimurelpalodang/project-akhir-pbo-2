<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangMasukDetail extends Model
{
    protected $fillable = ['bm_id','barang_id','jumlah_masuk','keterangan'];
    
    public function bm(): BelongsTo
    {
        return $this->belongsTo(barangMasuk::class);
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(barang::class);
    }
}
