<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TagihanExport;

class SiswaController extends Controller
{
    public function index(Request $request)
{
    // Ambil data kelas untuk dropdown filter
    $kelasList = Kelas::orderBy('nama_kelas')->get();

    // Query dasar siswa dengan relasi kelas dan tahun ajaran
    $query = Siswa::with('kelas.tahunAjaran');

    // Flag untuk menandakan ada filter aktif
    $hasFilter = false;

    // Filter NISN jika ada input
    if ($request->filled('nisn')) {
        $query->where('nisn', 'like', '%' . $request->nisn . '%');
        $hasFilter = true;
    }

    // Filter nama jika ada input
    if ($request->filled('nama')) {
        // Gunakan LOWER untuk pencarian case-insensitive (untuk MySQL)
        $query->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($request->nama) . '%']);
        $hasFilter = true;
    }

    // Filter kelas jika ada input
    if ($request->filled('kelas_id')) {
        $query->where('kelas_id', $request->kelas_id);
        $hasFilter = true;
    }

    // Ambil data dengan pagination
    $siswas = $query->paginate(10)->withQueryString();

    // Tentukan apakah pesan "tidak ada data" harus ditampilkan
    $noData = $hasFilter && $siswas->isEmpty();

    return view('siswa.index', compact('siswas', 'kelasList', 'noData'));
}


    public function show($id)
    {
        // Ambil siswa dengan kelas dan tahun ajaran
        $siswa = Siswa::with('kelas.tahunAjaran')->findOrFail($id);

        // Ambil tagihan siswa dengan jenis pembayaran
        $tagihan = Tagihan::with('jenisPembayaran')
            ->where('siswa_id', $id)
            ->get();

        return view('siswa.show', compact('siswa', 'tagihan'));
    }

    public function lihatTagihan(Request $request)
    {
        $query = Siswa::query()->with(['kelas.tahunAjaran', 'tagihan']);

        if ($request->nisn) {
            $query->where('nisn', 'like', '%' . $request->nisn . '%');
        }
        if ($request->nama) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }
        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $siswas = $query->get();
        $kelasList = Kelas::all();
        $noData = ($request->filled('nisn') || $request->filled('nama') || $request->filled('kelas_id')) && $siswas->isEmpty();

        // Ekspor data ke Excel
        if ($request->has('export') && $request->export === 'excel') {
            $kelas_id = $request->input('kelas_id', null); // Null untuk semua data
            return Excel::download(new TagihanExport($kelas_id), 'tagihan_siswa_' . ($kelas_id ? 'kelas_' . $kelas_id : 'all') . '.xlsx');
        }

        return view('lihat_tagihan.index', compact('siswas', 'kelasList', 'noData'));
    }
}
