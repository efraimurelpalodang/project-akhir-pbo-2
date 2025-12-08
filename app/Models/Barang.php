<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['satuan_id','kode','nama_barang','harga_jual','jumlah_stok'];

    public function satuan(): BelongsTo
    {
        return $this->belongsTo(satuan::class);
    }
}
