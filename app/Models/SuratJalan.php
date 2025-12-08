<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratJalan extends Model
{
    protected $fillable = ['so_id','pengguna_id','tanggal_sj','tanggal_pengantaran'];

    public function so(): BelongsTo
    {
        return $this->belongsTo(salesOrder::class);
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(pengguna::class);
    }
}
