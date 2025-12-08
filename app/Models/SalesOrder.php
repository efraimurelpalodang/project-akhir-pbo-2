<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesOrder extends Model
{
    protected $fillable = ['transaksi_id','pengguna_id','tanggal_so','status'];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(transaksiPenjualan::class);
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(pengguna::class);
    }

    public function soDetail(): HasMany
    {
        return $this->hasMany(salesOrderDetail::class);
    }

    public function sj(): BelongsTo
    {
        return $this->belongsTo(suratJalan::class);
    }
}
