<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesOrderDetail extends Model
{
    protected $fillable = ['so_id','barang_id','jumlah','harga_satuan'];

    public function so():BelongsTo
    {
        return $this->belongsTo(salesOrder::class);
    }
    
    public function barang(): BelongsTo
    {
        return $this->belongsTo(barang::class);
    }
}
