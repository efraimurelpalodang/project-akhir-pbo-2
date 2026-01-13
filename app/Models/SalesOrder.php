<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesOrder extends Model
{
    use HasFactory;
    
    protected $fillable = ['pembeli_id','transaksi_id','pengguna_id','tanggal_so','status','total_harga'];

    public function getBadgeColorAttribute()
    {
        return match($this->status) {
            'proses_persiapan' => 'warning',
            'menunggu'         => 'info',
            'siap_kirim'       => 'secondary',
            'dikirim'          => 'success',
            default            => 'danger',
        };
    }

    public function getBadgeTextAttribute()
    {
        return match($this->status) {
            'proses_persiapan' => 'Proses Persiapan',
            'menunggu'         => 'Menunggu',
            'siap_kirim'       => 'Selesai Penyiapan',
            'dikirim'          => 'Barang Dikirim',
            'dibatalkan'            => 'Dibatalkan',
            default            => 'kosong',
        };
    }

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

    public function sj(): HasOne
    {
        return $this->hasOne(SuratJalan::class, 'so_id');
    }
}
