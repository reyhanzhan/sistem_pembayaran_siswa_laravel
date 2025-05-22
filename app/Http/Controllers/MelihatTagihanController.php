<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\Kelas;


class MelihatTagihanController extends Controller
{
    public function index(Request $request, Siswa $siswa)
    {
        $query = Tagihan::where('siswa_id', $siswa->id)
            ->with(['jenisPembayaran', 'siswa.kelas']);

        // Pencarian berdasarkan NISN
        if ($request->nisn) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nisn', 'like', '%' . $request->nisn . '%');
            });
        }

        // Pencarian berdasarkan nama
        if ($request->nama) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama . '%');
            });
        }

        // Pencarian berdasarkan kelas
        if ($request->kelas_id) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('kelas_id', $request->kelas_id);
            });
        }

        $tagihans = $query->get();
        $kelasList = Kelas::all();
        $noData = $request->filled('nisn') || $request->filled('nama') || $request->filled('kelas_id');

        return view('tagihan.index', compact('tagihans', 'siswa', 'kelasList', 'noData'));
    }

    public function create(Siswa $siswa)
    {
        return view('tagihan.create', compact('siswa'));
    }

    public function store(Request $request, Siswa $siswa)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'deskripsi' => 'required|string|max:255',
        ]);

        Tagihan::create([
            'siswa_id' => $siswa->id,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('siswa.tagihan.index', $siswa->id)->with('success', 'Tagihan berhasil ditambahkan.');
    }

    // Method lain (edit, update, destroy) sesuai kebutuhan
}