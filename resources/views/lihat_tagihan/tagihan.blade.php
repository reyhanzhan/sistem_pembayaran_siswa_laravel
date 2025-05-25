@extends('layouts.sbadmin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tagihan Siswa: {{ $siswa->nama }}</h1>

    {{-- Tabel tagihan --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
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
                                Tidak ada tagihan ditemukan untuk siswa ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>

    {{-- Link kembali ke daftar siswa --}}
    <a href="{{ route('lihat-tagihan.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Siswa</a>
</div>
@endsection