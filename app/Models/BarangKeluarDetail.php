<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangKeluarDetail extends Model
{
    protected $fillable = ['bk_id','barang_id','jumlah_keluar'];

    public function bk(): BelongsTo
    {
        return $this->belongsTo(barangKeluar::class);
    }

    public function barang(): BelongsTo
    {
        return $this->belongsTo(barang::class);
    }
}
