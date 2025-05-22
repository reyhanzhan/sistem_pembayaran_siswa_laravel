<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';

    protected $fillable = [
        'tahun',
        'status_aktif',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
