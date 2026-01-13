<?php

namespace App\Models;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Satuan extends Model
{
    protected $table = 'satuans';
    protected $fillable = ['nama','deskripsi'];

    public function barang() : HasMany 
    {
        return $this->hasMany(Barang::class);
    }
}
