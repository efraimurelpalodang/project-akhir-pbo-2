<?php

namespace App\Models;

use App\Models\Satuan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    protected $fillable = ['satuan_id','kode','nama_barang','harga_jual','jumlah_stok'];
    protected $with = ['satuan'];

    public function satuan(): BelongsTo
    {
        return $this->belongsTo(Satuan::class);
    }
}
