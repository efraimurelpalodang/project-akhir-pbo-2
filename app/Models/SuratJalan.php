<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratJalan extends Model
{
    protected $fillable = ['so_id','pengguna_id','tanggal_sj','tanggal_pengantaran'];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'so_id');
    }

    public function petugas()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
