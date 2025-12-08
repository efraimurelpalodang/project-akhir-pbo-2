<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangKeluar extends Model
{
    protected $fillable = ['pengguna_id','so_id','tanggal_keluar','asal_transaksi','keterangan'];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(pengguna::class);
    }

    public function bk_detail(): HasMany
    {
        return $this->hasMany(barangKeluarDetail::class);
    }

    public function so(): BelongsTo
    {
        return $this->belongsTo(salesOrder::class);
    }
}
