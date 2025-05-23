@extends('layouts.sbadmin')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Tagihan untuk: {{ $siswa->nama }}</h1>

<form action="{{ route('tagihan.update', [$siswa->id, $tagihan->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Jenis Pembayaran</label>
        <select name="jenis_pembayaran_id" class="form-control" required>
            <option value="">-- Pilih Jenis Pembayaran --</option>
            @foreach($jenisPembayaran as $jenis)
                <option value="{{ $jenis->id }}" {{ old('jenis_pembayaran_id', $tagihan->jenis_pembayaran_id) == $jenis->id ? 'selected' : '' }}>
                    {{ $jenis->nama_pembayaran }}
                </option>
            @endforeach
        </select>
        @error('jenis_pembayaran_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label>Jumlah Tagihan</label>
        <input type="number" name="jumlah_tagihan" class="form-control" value="{{ old('jumlah_tagihan', $tagihan->jumlah_tagihan) }}" required>
        @error('jumlah_tagihan') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label>Jatuh Tempo</label>
        <input type="date" name="jatuh_tempo" class="form-control" value="{{ old('jatuh_tempo', $tagihan->jatuh_tempo->format('Y-m-d')) }}" required>
        @error('jatuh_tempo') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="belum_lunas" {{ old('status', $tagihan->status) == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
            <option value="lunas" {{ old('status', $tagihan->status) == 'lunas' ? 'selected' : '' }}>Lunas</option>
        </select>
        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button class="btn btn-primary" type="submit">Update</button>
    <a href="{{ route('siswa.tagihan.index', $siswa->id) }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
