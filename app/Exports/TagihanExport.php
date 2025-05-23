<?php

namespace App\Exports;

use App\Models\Siswa;
use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TagihanExport implements FromCollection, WithHeadings
{
    protected $kelas_id;

    public function __construct($kelas_id = null)
    {
        $this->kelas_id = $kelas_id;
    }

    /**
     * Mengambil data tagihan yang akan diekspor
     */
    public function collection()
    {
        $query = Tagihan::with(['siswa', 'siswa.kelas', 'siswa.kelas.tahunAjaran', 'jenisPembayaran']);

        // Filter berdasarkan kelas_id jika ada
        if ($this->kelas_id) {
            $query->whereHas('siswa', function ($q) {
                $q->where('kelas_id', $this->kelas_id);
            });
        }

        $tagihan = $query->get();

        $data = $tagihan->map(function ($tagihan) {
            return [
                'NISN' => $tagihan->siswa->nisn ?? '-',
                'Nama' => $tagihan->siswa->nama ?? '-',
                'Kelas' => $tagihan->siswa->kelas->nama_kelas ?? '-',
                'Tahun Ajaran' => $tagihan->siswa->kelas->tahunAjaran->tahun ?? '-',
                'Jenis Pembayaran' => $tagihan->jenisPembayaran->nama_pembayaran ?? '-',
                'Jumlah Tagihan' => 'Rp ' . number_format($tagihan->jumlah_tagihan, 0, ',', '.'),
                'Jatuh Tempo' => $tagihan->jatuh_tempo->format('d-m-Y') ?? '-',
                'Status' => $tagihan->status ?? 'Tidak Ada Status',
                'No. Telepon' => $tagihan->siswa->no_telfon ?? '-',
            ];
        });

        return $data;
    }

    /**
     * Menentukan header kolom untuk file Excel
     */
    public function headings(): array
    {
        return [
            'NISN',
            'Nama',
            'Kelas',
            'Tahun Ajaran',
            'Jenis Pembayaran',
            'Jumlah Tagihan',
            'Jatuh Tempo',
            'Status',
            'No. Telepon',
        ];
    }
}