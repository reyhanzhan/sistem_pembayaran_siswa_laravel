@extends('layouts.sbadmin')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Daftar Siswa</h1>

{{-- Form pencarian --}}
<form method="GET" action="{{ route('siswa.index') }}" class="mb-4" id="searchForm">
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

{{-- Pesan jika tidak ada data dari pencarian --}}
@if($noData)
    <div class="alert alert-warning" role="alert">
        Tidak ada data siswa yang ditemukan untuk kriteria pencarian ini.
    </div>
@endif

{{-- Tabel daftar siswa --}}
<div class="table-responsive">
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>NISN</th>
            <th>Nama</th>
            <th>Agama</th>
            <th>Kelas</th>
            <th>Tahun Ajaran</th>
            <th>No. Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($siswas as $siswa)
            <tr>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>{{ $siswa->agama }}</td>
                <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
                <td>{{ $siswa->kelas->tahunAjaran->tahun ?? '-' }}</td>
                <td>{{ $siswa->no_telfon }}</td>
                <td>
                    <a href="{{ route('siswa.tagihan.index', ['siswa' => $siswa->id]) }}">Lihat Tagihan</a>
                    
                   
                    
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">
                    @if($noData)
                        Tidak ada data siswa yang ditemukan untuk kriteria pencarian ini.
                    @else
                        Tidak ada siswa yang ditemukan.
                    @endif
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>

{{-- Link untuk tambah siswa --}}

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

@endsection