<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tagihan;
use App\Models\Pembayaran;

class JenisPembayaran extends Model
{
    protected $table = 'jenis_pembayaran';

    protected $fillable = [
        'nama_pembayaran',
        'jumlah',
        'deskripsi',
    ];

    // Relasi ke Tagihan
    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }

    // Relasi ke Pembayaran
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
