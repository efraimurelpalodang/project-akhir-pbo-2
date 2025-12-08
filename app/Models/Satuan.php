<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Satuan extends Model
{
    protected $fillable = ['nama','deskripsi'];

    public function barang() : HasMany 
    {
        return $this->hasMany(barang::class);
    }
}
