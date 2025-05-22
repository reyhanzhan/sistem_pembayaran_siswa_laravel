<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\JenisPembayaran;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'siswa_id',
        'jenis_pembayaran_id',
        'tanggal_bayar',
        'jumlah_bayar',
        'status',
        'keterangan',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // Relasi ke JenisPembayaran
    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class);
    }
}
