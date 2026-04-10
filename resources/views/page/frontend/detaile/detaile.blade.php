@extends('partials.frontend.app')

@section('content')
<section class="detail-section">
    <div class="container">
        
        <div class="row align-items-center justify-content-center g-5">

            {{-- COVER --}}
            <div class="col-md-5 text-center text-md-end">
                <div class="detail-cover-wrapper">
                    @if ($buku->cover)
                        <img src="{{ asset('storage/' . $buku->cover) }}" class="detail-cover-img" alt="{{ $buku->judul_buku }}">
                    @else
                        <div class="detail-cover-placeholder">
                            <i class="bi bi-book-half"></i>
                        </div>
                    @endif
                </div>
            </div>

            {{-- DETAIL --}}
            <div class="col-md-7">
                <div class="detail-content">
                    
                    {{-- CAT BADGE --}}
                    <div class="mb-3">
                        <span class="detail-badge-cat">
                            <i class="bi bi-tags-fill me-1"></i> {{ $buku->kategori }}
                        </span>
                    </div>

                    {{-- JUDUL --}}
                    <h1 class="detail-title">
                        {{ $buku->judul_buku }}
                    </h1>

                    {{-- AUTHOR --}}
                    <p class="detail-author">
                        <i class="bi bi-person-circle me-1"></i> Ditulis oleh
                        <span>{{ $buku->penulis }}</span>
                    </p>

                    {{-- STOK --}}
                    <div class="detail-stok-box {{ $buku->stok > 0 ? 'stok-tersedia' : 'stok-habis' }}">
                        <div class="stok-icon">
                            <i class="bi {{ $buku->stok > 0 ? 'bi-check2-circle' : 'bi-x-circle' }}"></i>
                        </div>
                        <div class="stok-text">
                            <span class="stok-label">Status Ketersediaan</span>
                            <span class="stok-value">
                                {{ $buku->stok > 0 ? $buku->stok . ' Buku Tersedia' : 'Stok Habis' }}
                            </span>
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="detail-desc-box">
                        <h5 class="desc-heading">Sinopsis & Deskripsi</h5>
                        <p class="desc-text">
                            {{ $buku->deskripsi_buku ?? 'Buku ini belum memiliki ringkasan/deskripsi.' }}
                        </p>
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="detail-actions">
                        @if ($buku->stok > 0)
                            <a href="{{ route('peminjaman.create', $buku->id_buku) }}" class="btn-pinjam-lg">
                                <i class="bi bi-journal-plus me-2"></i> Ajukan Peminjaman
                            </a>
                        @else
                            <button class="btn-pinjam-disabled-lg" disabled>
                                <i class="bi bi-slash-circle me-2"></i> Buku Tidak Tersedia
                            </button>
                        @endif

                        <a href="{{ route('frontend.home') }}" class="btn-back-outline">
                            Kembali ke Koleksi
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<style>
    .detail-section {
        padding: 80px 0 100px;
        background: linear-gradient(180deg, #fdfbf7 0%, #ffffff 100%);
        min-height: calc(100vh - 100px);
    }

    .detail-cover-wrapper {
        position: relative;
        display: inline-block;
        padding: 15px;
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(168,133,95,0.15);
        border: 1px solid #fdf5e6;
    }

    .detail-cover-img {
        width: 100%;
        max-width: 320px;
        height: auto;
        aspect-ratio: 3/4;
        object-fit: cover;
        border-radius: 14px;
    }

    .detail-cover-placeholder {
        width: 320px;
        height: 426px;
        background: linear-gradient(135deg, #fdf9f1, #e2d1bc);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px;
        color: #dabe96;
    }

    @media (max-width: 767px) {
        .detail-cover-img, .detail-cover-placeholder {
            max-width: 260px;
            height: 346px;
        }
    }

    .detail-content {
        max-width: 600px;
    }

    .detail-badge-cat {
        display: inline-block;
        background: #fdf5e6;
        color: #a8855f;
        border: 1px solid #f2e3c6;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .detail-title {
        font-size: clamp(30px, 4vw, 42px);
        font-weight: 800;
        color: #4a3f35;
        line-height: 1.2;
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }

    .detail-author {
        font-size: 15px;
        color: #8b7355;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
    }

    .detail-author span {
        font-weight: 700;
        color: #a8855f;
        margin-left: 6px;
    }

    .detail-stok-box {
        display: flex;
        align-items: center;
        padding: 16px 24px;
        border-radius: 16px;
        margin-bottom: 30px;
        gap: 16px;
    }

    .stok-tersedia {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
    }

    .stok-tersedia .stok-icon { color: #059669; }
    
    .stok-habis {
        background: #fef2f2;
        border: 1px solid #fecaca;
    }

    .stok-habis .stok-icon { color: #dc2626; }

    .stok-icon {
        font-size: 28px;
        line-height: 1;
    }

    .stok-text {
        display: flex;
        flex-direction: column;
    }

    .stok-label {
        font-size: 12px;
        color: #8b7355;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .stok-tersedia .stok-value { color: #059669; font-weight: 800; font-size: 18px; }
    .stok-habis .stok-value { color: #dc2626; font-weight: 800; font-size: 18px; }

    .detail-desc-box {
        margin-bottom: 40px;
    }

    .desc-heading {
        font-size: 18px;
        font-weight: 700;
        color: #4a3f35;
        margin-bottom: 12px;
    }

    .desc-text {
        font-size: 15px;
        color: #8b7355;
        line-height: 1.8;
    }

    .detail-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-pinjam-lg {
        background: linear-gradient(135deg, #a8855f, #c0a07a);
        color: #fff;
        padding: 14px 32px;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 6px 20px rgba(168,133,95,0.3);
    }

    .btn-pinjam-lg:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(168,133,95,0.4);
        color: #fff;
    }

    .btn-pinjam-disabled-lg {
        background: #fdf5e6;
        color: #9ca3af;
        border: 1px solid #f2e3c6;
        padding: 14px 32px;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 600;
        cursor: not-allowed;
        display: inline-flex;
        align-items: center;
    }

    .btn-back-outline {
        background: #fff;
        color: #a8855f;
        border: 1.5px solid #f2e3c6;
        padding: 14px 32px;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s;
    }

    .btn-back-outline:hover {
        background: #faf3e8;
        border-color: #a8855f;
        color: #a8855f;
    }
</style>
@endsection
