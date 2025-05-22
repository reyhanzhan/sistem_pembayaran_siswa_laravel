@extends('layouts.sbadmin')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tagihan Siswa: {{ $siswa->nama }}</h1>

{{-- Link untuk tambah tagihan di halaman detail siswa --}}
<a href="{{ route('tagihan.create', ['siswa' => $siswa->id]) }}" class="btn btn-primary mb-3">Tambah Tagihan</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Jenis Pembayaran</th>
            <th>Jumlah Tagihan</th>
            <th>Jatuh Tempo</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tagihan as $item)
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
                <td>
                    <a href="{{ route('tagihan.edit', [$siswa->id, $item->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                    
                    <form action="{{ route('tagihan.destroy', [$siswa->id, $item->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus tagihan ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('siswa.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Siswa</a>
@endsection
