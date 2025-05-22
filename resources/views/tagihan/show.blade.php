@extends('layouts.sbadmin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tagihan Siswa: {{ $siswa->nama }}</h1>

    {{-- Form pencarian --}}
    <form method="GET" action="{{ route('siswa.tagihan.index', ['siswa' => $siswa->id]) }}" class="mb-4" id="searchForm">
        <div class="form-row">
            <div class="col-md-3 mb-2">
                <div class="input-group">
                    <input type="text" name="nisn" id="nisnInput" value="{{ request('nisn') }}" class="form-control" placeholder="Cari NISN">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary clear-input" data-input="nisnInput" style="display: {{ request('nisn') ? 'block' : 'none' }};">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="input-group">
                    <input type="text" name="nama" id="namaInput" value="{{ request('nama') }}" class="form-control" placeholder="Cari Nama">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary clear-input" data-input="namaInput" style="display: {{ request('nama') ? 'block' : 'none' }};">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <select name="kelas_id" class="form-control">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <button type="submit" class="btn btn-primary btn-block">Cari</button>
            </div>
        </div>
    </form>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pesan jika tidak ada data dari pencarian --}}
    @if($noData)
        <div class="alert alert-warning" role="alert">
            Tidak ada tagihan ditemukan untuk kriteria pencarian ini.
        </div>
    @endif

    {{-- Tabel tagihan --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Jenis Pembayaran</th>
                        <th>Jumlah Tagihan</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tagihans as $item)
                        <tr>
                            <td>{{ $item->jenisPembayaran->nama_pembayaran }}</td>
                            <td>Rp {{ number_format($item->jumlah_tagihan, 0, ',', '.') }}</td>
                            <td>{{ $item->jatuh_tempo->format('d-m-Y') }}</td>
                            <td>
                                @if($item->status == 'lunas')
                                    <span class="badge badge-success">Lunas</span>
                                @else
                                    <span class="badge badge-danger">Belum Lunas</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                @if($noData)
                                    Tidak ada tagihan ditemukan untuk kriteria pencarian ini.
                                @else
                                    Tidak ada tagihan ditemukan untuk siswa ini.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Link kembali ke daftar siswa --}}
    <a href="{{ route('siswa.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Siswa</a>
</div>
@endsection

@section('scripts')
<script>
    // Tampilkan/sembunyikan tombol "X" berdasarkan isi input
    document.querySelectorAll('.clear-input').forEach(button => {
        const inputId = button.getAttribute('data-input');
        const input = document.getElementById(inputId);
        
        // Periksa saat halaman dimuat
        if (input.value) {
            button.style.display = 'block';
        } else {
            button.style.display = 'none';
        }

        // Periksa saat input berubah
        input.addEventListener('input', () => {
            button.style.display = input.value ? 'block' : 'none';
        });

        // Aksi saat tombol "X" diklik
        button.addEventListener('click', () => {
            input.value = ''; // Kosongkan input
            button.style.display = 'none'; // Sembunyikan tombol
            // Submit form untuk mereset pencarian
            document.getElementById('searchForm').submit();
        });
    });
</script>
@endsection