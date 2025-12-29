<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesOrder extends Model
{
    protected $fillable = ['pembeli_id','transaksi_id','pengguna_id','tanggal_so','status','total_harga'];

    public function pembeli(): BelongsTo
    {
        return $this->belongsTo(Pembeli::class);
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(pengguna::class, 'pengguna_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(salesOrderDetail::class, 'so_id');
    }

    public function sj(): BelongsTo
    {
        return $this->belongsTo(suratJalan::class);
    }
}
