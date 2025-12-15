<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['role_id','username','password','nama_pengguna','jk','telp'];
    protected $with = ['role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
    

    public function bk(): HasMany
    {
        return $this->hasMany(barangKeluar::class);
    }

    public function bm(): HasMany
    {
        return $this->hasMany(barangMasuk::class);
    }

    public function so(): HasMany
    {
        return $this->hasMany(salesOrder::class);
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(transaksiPenjualan::class);
    }

    public function suratJalan(): HasMany
    {
        return $this->hasMany(suratJalan::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(role::class);
    }
}
