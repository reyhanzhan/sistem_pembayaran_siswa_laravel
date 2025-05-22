<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\JenisPembayaran;

class Tagihan extends Model
{
    protected $table = 'tagihan';

    protected $fillable = [
        'siswa_id',
        'jenis_pembayaran_id',
        'jumlah_tagihan',
        'jatuh_tempo',
        'status',
    ];

    protected $casts = [
        'jatuh_tempo' => 'date',  // atau 'datetime' jika ada waktu
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
