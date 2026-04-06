@extends('partials.frontend.app')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">Form Peminjaman Buku</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <h5>{{ $buku->judul_buku }}</h5>
            <p>Penulis: {{ $buku->penulis }}</p>

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                <input type="hidden" name="buku_id" value="{{ $buku->id_buku }}">

                <div class="mb-3">
                    <label>Tanggal Pinjam</label>
                    <input type="text" class="form-control" value="{{ now()->format('Y-m-d') }}" readonly>
                </div>

                <div class="mb-3">
                    <label>Batas Kembali (7 Hari)</label>
                    <input type="text" class="form-control" value="{{ now()->addDays(7)->format('Y-m-d') }}" readonly>
                </div>

                <button class="btn btn-primary w-100">
                    📖 Ajukan Peminjaman
                </button>

            </form>

        </div>
    </div>
</div>
@endsection
