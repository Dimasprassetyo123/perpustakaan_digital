@extends('partials.backend.app')

@section('content')

<div class="content-wrapper">

    {{-- 🔥 HEADER --}}
    <div class="page-header">
        <h3 class="mb-0">
            Hi, selamat datang !
            <span class="pl-2 h6 text-muted">
                Di dashboard Petugas Perpustakaan
            </span>
        </h3>
    </div>

    {{-- 🔥 CARD --}}
    <div class="row">

        {{-- PETUGAS --}}
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card text-white" style="background: linear-gradient(135deg,#FFB347,#FFCC33);">
                <div class="card-body">
                    <h5>Total Petugas</h5>
                    <h2>{{ $totalPetugas }}</h2>
                </div>
            </div>
        </div>

        {{-- ANGGOTA --}}
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card text-white" style="background: linear-gradient(135deg,#FF6B9D,#FF8E53);">
                <div class="card-body">
                    <h5>Total Anggota</h5>
                    <h2>{{ $totalAnggota }}</h2>
                </div>
            </div>
        </div>

        {{-- BUKU --}}
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card text-white" style="background: linear-gradient(135deg,#667eea,#764ba2);">
                <div class="card-body">
                    <h5>Total Buku</h5>
                    <h2>{{ $totalBuku }}</h2>
                </div>
            </div>
        </div>

        {{-- PEMINJAMAN --}}
        <div class="col-md-3 grid-margin stretch-card">
            <div class="card text-white" style="background: linear-gradient(135deg,#11998e,#38ef7d);">
                <div class="card-body">
                    <h5>Total Peminjaman</h5>
                    <h2>{{ $totalPeminjaman }}</h2>
                </div>
            </div>
        </div>

    </div>

    {{-- 🔥 TABLE PEMINJAMAN HARI INI --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">

                    <h4 class="card-title mb-4">📅 Peminjaman Hari Ini</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">

                            <thead class="table-light">
                                <tr>
                                    <th>Nama Anggota</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Batas Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($peminjamanHariIni as $item)
                                    <tr>
                                        <td>{{ $item->anggota->nama_anggota ?? '-' }}</td>

                                        <td>{{ $item->buku->judul_buku ?? '-' }}</td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}
                                        </td>

                                        <td>
                                            {{ $item->wajib_kembali
                                                ? \Carbon\Carbon::parse($item->wajib_kembali)->format('d-m-Y')
                                                : '-' }}
                                        </td>

                                        <td>
                                            @if($item->status == 'menunggu')
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                            @elseif($item->status == 'dipinjam')
                                                <span class="badge bg-primary">Dipinjam</span>
                                            @elseif($item->status == 'dikembalikan')
                                                <span class="badge bg-success">Dikembalikan</span>
                                            @elseif($item->status == 'pengajuan_kembali')
                                                <span class="badge bg-info">Pengajuan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            Tidak ada peminjaman hari ini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
