<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangMasuk extends Model
{
    protected $fillable = ['pengguna_id','tanggal_masuk','asal_barang','keterangan','harga'];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(pengguna::class);
    }
}
