<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\JenisPembayaran;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    // Tampilkan daftar tagihan siswa
    public function index(Siswa $siswa)
    {
        $tagihan = Tagihan::with('jenisPembayaran')->where('siswa_id', $siswa->id)->get();

        return view('tagihan.index', compact('siswa', 'tagihan'));
    }


    // Tampilkan form tambah tagihan baru
    public function create(Siswa $siswa)
    {
        $jenisPembayaran = JenisPembayaran::all();
        return view('tagihan.create', compact('siswa', 'jenisPembayaran'));
    }

    // Simpan data tagihan baru
    public function store(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'jenis_pembayaran_id' => 'required|exists:jenis_pembayaran,id',
            'jumlah_tagihan' => 'required|numeric|min:0',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:lunas,belum_lunas',
        ]);

        $validated['siswa_id'] = $siswa->id;

        Tagihan::create($validated);

        // return redirect()->route('tagihan.index', $siswa->id)->with('success', 'Tagihan berhasil ditambahkan.');
        return redirect()->route('siswa.tagihan.index', $siswa->id)->with('success', 'Tagihan berhasil ditambahkan.');
    }

    // Tampilkan form edit tagihan
    public function edit(Siswa $siswa, Tagihan $tagihan)
    {
        $jenisPembayaran = JenisPembayaran::all();

        return view('tagihan.edit', compact('siswa', 'tagihan', 'jenisPembayaran'));
    }

    // Update data tagihan
    public function update(Request $request, Siswa $siswa, Tagihan $tagihan)
    {
        $validated = $request->validate([
            'jenis_pembayaran_id' => 'required|exists:jenis_pembayaran,id',
            'jumlah_tagihan' => 'required|numeric|min:0',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:lunas,belum_lunas',
        ]);

        $tagihan->update($validated);

        return redirect()->route('tagihan.index', $siswa->id)->with('success', 'Tagihan berhasil diperbarui.');
    }

    // Hapus tagihan
    public function destroy(Siswa $siswa, Tagihan $tagihan)
    {
        $tagihan->delete();

        return redirect()->route('tagihan.index', $siswa->id)->with('success', 'Tagihan berhasil dihapus.');
    }
}
