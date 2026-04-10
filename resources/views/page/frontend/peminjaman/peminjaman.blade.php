@extends('partials.frontend.app')

@section('content')
<section class="form-peminjaman-section">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">

                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('buku.detail', $buku->id_buku) }}" class="btn-back-icon">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="pmj-card">
                    <div class="pmj-card-header">
                        <div class="pmj-badge">Formulir Pengajuan</div>
                        <h3 class="pmj-title">Peminjaman Buku</h3>
                        <p class="pmj-desc">Harap pastikan detail buku yang akan dipinjam sudah sesuai.</p>
                    </div>

                    <div class="pmj-card-body">

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="book-preview-box">
                            <div class="bpreview-cover">
                                @if ($buku->cover)
                                    <img src="{{ asset('storage/'.$buku->cover) }}" alt="{{ $buku->judul_buku }}">
                                @else
                                    <div class="bpreview-no-cover"><i class="bi bi-book-half"></i></div>
                                @endif
                            </div>
                            <div class="bpreview-info">
                                <h5 class="bp-title">{{ $buku->judul_buku }}</h5>
                                <p class="bp-author"><i class="bi bi-person me-1"></i> {{ $buku->penulis }}</p>
                                <span class="bp-stok">
                                    <i class="bi bi-box-seam me-1"></i> Sisa Stok: <strong>{{ $buku->stok }}</strong>
                                </span>
                            </div>
                        </div>

                        <hr class="pmj-divider">

                        <form action="{{ route('peminjaman.store') }}" method="POST" class="pmj-form">
                            @csrf
                            <input type="hidden" name="id_buku" value="{{ $buku->id_buku }}">

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Pinjam</label>
                                        <div class="input-with-icon">
                                            <i class="bi bi-calendar-check form-icon text-primary"></i>
                                            <input type="text" class="form-control form-control-elegant"
                                                   value="{{ now()->format('d-m-Y') }}" readonly>
                                        </div>
                                        <small class="text-muted mt-1 d-block"><i class="bi bi-info-circle"></i> Hari ini</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Batas Kembali</label>
                                        <div class="input-with-icon">
                                            <i class="bi bi-calendar-x form-icon text-danger"></i>
                                            <input type="text" class="form-control form-control-elegant"
                                                   value="{{ now()->addDays(2)->format('d-m-Y') }}" readonly>
                                        </div>
                                        <small class="text-muted mt-1 d-block"><i class="bi bi-info-circle"></i> Maks. 2 Hari</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-5">
                                <button type="submit" class="btn-submit-pmj w-100">
                                    Ajukan Peminjaman Sekarang <i class="bi bi-arrow-right-circle ms-2"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    .form-peminjaman-section {
        background: #fdfbf7;
        min-height: calc(100vh - 100px);
    }

    .btn-back-icon {
        color: #8b7355;
        font-weight: 600;
        text-decoration: none;
        font-size: 15px;
        transition: color 0.2s;
    }
    .btn-back-icon:hover { color: #a8855f; }
    .btn-back-icon i { margin-right: 5px; }

    .pmj-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 15px 40px rgba(168,133,95,0.08);
        overflow: hidden;
        border: 1px solid #fdf5e6;
    }

    .pmj-card-header {
        background: linear-gradient(135deg, #a8855f, #c0a07a);
        padding: 40px;
        text-align: center;
        color: #fff;
    }

    .pmj-badge {
        display: inline-block;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(5px);
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    .pmj-title {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .pmj-desc {
        color: rgba(255,255,255,0.8);
        margin: 0;
        font-size: 14px;
    }

    .pmj-card-body {
        padding: 40px;
    }

    .book-preview-box {
        display: flex;
        align-items: center;
        gap: 20px;
        background: #fdfbf7;
        border: 1px solid #fdf5e6;
        padding: 20px;
        border-radius: 16px;
    }

    .bpreview-cover {
        width: 80px;
        height: 110px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .bpreview-cover img {
        width: 100%; height: 100%; object-fit: cover;
    }

    .bpreview-no-cover {
        width: 100%; height: 100%;
        background: #e2d1bc; color: #a8855f;
        display: flex; align-items: center; justify-content: center; font-size: 32px;
    }

    .bp-title {
        font-size: 18px; font-weight: 800; color: #4a3f35; margin-bottom: 6px;
    }

    .bp-author {
        font-size: 14px; color: #8b7355; margin-bottom: 12px;
    }

    .bp-stok {
        display: inline-block;
        background: #ecfdf5; color: #059669;
        font-size: 12px; font-weight: 600;
        padding: 4px 12px; border-radius: 50px; border: 1px solid #d1fae5;
    }

    .pmj-divider {
        margin: 30px 0;
        border-color: #fdf5e6;
        opacity: 1;
    }

    .form-label {
        font-size: 13px; font-weight: 700; color: #4a3f35; margin-bottom: 8px;
    }

    .input-with-icon { position: relative; }
    
    .form-icon {
        position: absolute; top: 50%; left: 16px; transform: translateY(-50%); font-size: 16px;
    }

    .form-control-elegant {
        padding: 12px 16px 12px 42px;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-weight: 600;
        color: #1e293b;
    }

    .form-control-elegant:focus {
        background: #fff;
        border-color: #a8855f;
        box-shadow: 0 0 0 3px rgba(168,133,95,0.15);
    }

    .btn-submit-pmj {
        background: linear-gradient(135deg, #a8855f, #c0a07a);
        color: white; border: none; padding: 16px;
        border-radius: 12px; font-size: 16px; font-weight: 700;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-submit-pmj:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(168,133,95,0.4);
    }

    @media (max-width: 576px) {
        .pmj-card-header, .pmj-card-body { padding: 25px; }
    }
</style>
@endsection
