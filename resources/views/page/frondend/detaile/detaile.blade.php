@extends('partials.frontend.app')

@section('content')

<section class="py-5" style="background: #f8f9fa;">
    <div class="container">

        <div class="row align-items-center g-5">

            {{-- COVER --}}
            <div class="col-md-5 text-center">
                <div class="position-relative">
                    @if($buku->cover)
                        <img src="{{ asset('storage/'.$buku->cover) }}"
                             class="img-fluid rounded shadow"
                             style="height: 450px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/300x400"
                             class="img-fluid rounded shadow">
                    @endif
                </div>
            </div>

            {{-- DETAIL --}}
            <div class="col-md-7">

                {{-- JUDUL --}}
                <h2 class="fw-bold mb-3" style="letter-spacing: 0.5px;">
                    {{ $buku->judul_buku }}
                </h2>

                {{-- AUTHOR --}}
                <p class="text-muted mb-3">
                    ✍️ Ditulis oleh
                    <span class="fw-semibold text-dark">{{ $buku->penulis }}</span>
                </p>

                {{-- INFO BOX --}}
                <div class="d-flex gap-3 flex-wrap mb-4">

                    <div class="px-3 py-2 rounded-pill bg-light border">
                        📚 <strong>Kategori:</strong>
                        <span class="text-primary fw-semibold">
                            {{ $buku->kategori }}
                        </span>
                    </div>

                    <div class="px-3 py-2 rounded-pill
                        {{ $buku->stok > 0 ? 'bg-success text-white' : 'bg-danger text-white' }}">
                        📦 Stok: <strong>{{ $buku->stok }}</strong>
                    </div>

                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-4">
                    <h5 class="fw-bold mb-2">Deskripsi Buku</h5>
                    <p class="text-muted" style="line-height: 1.8;">
                        {{ $buku->deskripsi_buku ?? 'Tidak ada deskripsi buku untuk saat ini.' }}
                    </p>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex gap-3">

                    <a href="#"
                       class="btn btn-dark rounded-pill px-4 py-2 d-flex align-items-center gap-2 shadow-sm">
                        <i class="bi bi-book"></i> Pinjam Buku
                    </a>

                    <a href="{{ route('frontend.home') }}"
                       class="btn btn-outline-secondary rounded-pill px-4 py-2">
                        ← Kembali
                    </a>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection
