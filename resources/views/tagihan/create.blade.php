@extends('layouts.sbadmin')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Tagihan untuk: {{ $siswa->nama }}</h1>

<form action="{{ route('tagihan.store', $siswa->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Jenis Pembayaran</label>
        <select name="jenis_pembayaran_id" class="form-control" required>
            <option value="">-- Pilih Jenis Pembayaran --</option>
            @foreach($jenisPembayaran as $jenis)
                <option value="{{ $jenis->id }}" {{ old('jenis_pembayaran_id') == $jenis->id ? 'selected' : '' }}>
                    {{ $jenis->nama_pembayaran }}
                </option>
            @endforeach
        </select>
        @error('jenis_pembayaran_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label>Jumlah Tagihan</label>
        <input type="number" name="jumlah_tagihan" class="form-control" value="{{ old('jumlah_tagihan') }}" required>
        @error('jumlah_tagihan') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label>Jatuh Tempo</label>
        <input type="date" name="jatuh_tempo" class="form-control" value="{{ old('jatuh_tempo') }}" required>
        @error('jatuh_tempo') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="belum_lunas" {{ old('status') == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
            <option value="lunas" {{ old('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
        </select>
        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button class="btn btn-primary" type="submit">Simpan</button>
    {{-- <a href="{{ route('tagihan.index', $siswa->id) }}" class="btn btn-secondary">Batal</a> --}}
    <a href="{{ route('siswa.tagihan.index', ['siswa' => $siswa->id]) }}" class="btn btn-secondary">Kembali</a>
    {{-- <a href="{{ route('siswa.tagihan.index', ['siswa' => $siswa->id]) }}">Lihat Tagihan</a> --}}
    
</form>
@endsection
