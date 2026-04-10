@extends('partials.frontend.app')

@section('content')
<section class="riwayat-section">
    <div class="container">
        
        {{-- SECTION HEADER --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4 gap-3">
            <div class="section-head text-start mb-0">
                <span class="section-badge">🕒 Riwayat</span>
                <h2 class="section-title">Riwayat <span>Peminjaman</span></h2>
                <p class="section-desc m-0">Kelola dan pantau status peminjaman buku Anda dengan mudah</p>
            </div>
            <div>
                <a href="{{ route('frontend.home') }}" class="btn-back">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($data as $item)
            <div class="col-md-6 col-lg-4">
                <div class="riwayat-card">
                    <div class="rcard-body">
                        {{-- Header Info --}}
                        <div class="d-flex gap-3 mb-3">
                            <div class="rcard-cover">
                                @if ($item->buku && $item->buku->cover)
                                    <img src="{{ asset('storage/' . $item->buku->cover) }}" alt="{{ $item->buku->judul_buku }}">
                                @else
                                    <div class="rcard-no-cover"><i class="bi bi-book-half"></i></div>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="rcard-title">{{ $item->buku->judul_buku ?? 'Buku Tidak Ditemukan' }}</h5>
                                <p class="rcard-author"><i class="bi bi-person me-1"></i> {{ $item->buku->penulis ?? '-' }}</p>
                                
                                <div class="mt-2">
                                    @php
                                        $now = now()->startOfDay();
                                        $wajibKembali = \Carbon\Carbon::parse($item->wajib_kembali)->startOfDay();
                                        $isDipinjamLate = ($item->status == 'dipinjam') && $now->gt($wajibKembali);
                                    @endphp

                                    @if($item->status == 'menunggu')
                                        <span class="status-badge st-warning">
                                            <i class="bi bi-clock-history me-1"></i> Menunggu
                                        </span>
                                    @elseif($isDipinjamLate)
                                        <span class="status-badge st-danger">
                                            <i class="bi bi-alarm me-1"></i> Terlambat
                                        </span>
                                    @elseif($item->status == 'dipinjam')
                                        <span class="status-badge st-primary">
                                            <i class="bi bi-book me-1"></i> Dipinjam
                                        </span>
                                    @elseif($item->status == 'pengajuan_kembali')
                                        <span class="status-badge st-info">
                                            <i class="bi bi-send-check me-1"></i> Menunggu Konfirmasi
                                        </span>
                                    @elseif($item->status == 'dikembalikan')
                                        <span class="status-badge st-success">
                                            <i class="bi bi-check-circle me-1"></i> Selesai
                                        </span>
                                    @elseif($item->status == 'terlambat')
                                        <span class="status-badge st-danger">
                                            <i class="bi bi-alarm me-1"></i> Terlambat
                                        </span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="status-badge st-secondary">
                                            <i class="bi bi-x-circle me-1"></i> Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Metadata --}}
                        <div class="rcard-meta">
                            <div class="meta-item">
                                <span class="meta-label">Tgl. Pinjam</span>
                                <span class="meta-value">{{ $item->tanggal_pinjam->format('d/m/Y') }}</span>
                            </div>
                            <div class="meta-separator"></div>
                            <div class="meta-item">
                                <span class="meta-label">Batas Kembali</span>
                                <span class="meta-value {{ $item->wajib_kembali->isPast() && $item->status == 'dipinjam' ? 'text-danger' : '' }}">
                                    {{ $item->wajib_kembali->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>

                        @if($item->denda && $item->denda > 0)
                        <div class="denda-box mt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-exclamation-triangle text-danger me-1"></i> 
                                    <span class="denda-label">Tagihan Denda Dibayar</span>
                                </div>
                                <span class="denda-value">Rp {{ number_format($item->denda,0,',','.') }}</span>
                            </div>
                        </div>
                        @elseif(isset($isDipinjamLate) && $isDipinjamLate)
                            @php
                                $hariTelat = abs($now->diffInDays($wajibKembali));
                                $estimasiDenda = $hariTelat * 2000;
                            @endphp
                            <div class="denda-box mt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-clock-history text-danger me-1"></i> 
                                        <span class="denda-label text-danger">Estimasi Denda (Lewat {{ $hariTelat }} Hari)</span>
                                    </div>
                                    <span class="denda-value text-danger">Rp {{ number_format($estimasiDenda,0,',','.') }}</span>
                                </div>
                            </div>
                        @endif

                        @if($item->status == 'ditolak' && $item->alasan_ditolak)
                            <div class="denda-box mt-3" style="background:#fef2f2; border-color:#fecaca;">
                                <div class="denda-label text-danger">Alasan ditolak:</div>
                                <div class="small fw-semibold mt-1" style="color:#dc2626;">{{ $item->alasan_ditolak }}</div>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Footer Action --}}
                    @if($item->status == 'dipinjam')
                    <div class="rcard-footer">
                        <form action="{{ route('peminjaman.kembalikan', $item->id_peminjaman) }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn-return w-100">
                                <i class="bi bi-arrow-return-left me-2"></i> Ajukan Pengembalian
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <h4 class="empty-title">Belum ada peminjaman</h4>
                        <p class="empty-desc">Riwayat peminjaman kosong. Ayo jelajahi koleksi buku kami dan mulai meminjam!</p>
                        <a href="{{ route('frontend.home') }}#popular-books" class="btn-primary-elegant">
                            <i class="bi bi-search me-2"></i> Cari Buku
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</section>

<style>
    /* Global Section Styles Reused for consistency */
    .riwayat-section {
        padding: 60px 0 100px;
        background: #fdfbf7;
        min-height: calc(100vh - 100px);
    }

    .section-head {
        margin-bottom: 20px;
    }

    .section-badge {
        display: inline-block;
        background: #fdf5e6;
        border: 1px solid #f2e3c6;
        color: #a8855f;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 5px 16px;
        border-radius: 50px;
        margin-bottom: 12px;
    }

    .section-title {
        font-size: clamp(24px, 3.5vw, 36px);
        font-weight: 800;
        color: #4a3f35;
        margin: 0 0 10px;
        letter-spacing: -0.5px;
    }

    .section-title span { color: #a8855f; }
    
    .section-desc {
        color: #6b7280;
        font-size: 15px;
    }

    .btn-back {
        background: #fff;
        color: #8b7355;
        border: 1.5px solid #f2e3c6;
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    }

    .btn-back:hover {
        background: #faf3e8;
        border-color: #dabe96;
        color: #4a3f35;
    }

    /* Riwayat Card */
    .riwayat-card {
        background: #fff;
        border: 1px solid #fdf5e6;
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 4px 15px rgba(168,133,95,0.04);
    }

    .riwayat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(168,133,95,0.1);
        border-color: rgba(168,133,95,0.2);
    }

    .rcard-body {
        padding: 20px;
        flex: 1;
    }

    .rcard-cover {
        width: 75px; 
        height: 105px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
        background: #faf3e8;
        border: 1px solid #fdf5e6;
    }

    .rcard-cover img {
        width: 100%; height: 100%; object-fit: cover;
    }

    .rcard-no-cover {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #fdf9f1, #e2d1bc);
        font-size: 32px; color: #dabe96;
    }

    .rcard-title {
        font-size: 15px; font-weight: 700; color: #4a3f35;
        margin-bottom: 6px;
        display: -webkit-box; -webkit-line-clamp: 2;
        -webkit-box-orient: vertical; overflow: hidden;
        line-height: 1.4;
    }

    .rcard-author {
        font-size: 12px; color: #9ca3af; margin-bottom: 0;
    }

    /* Meta Boxes */
    .rcard-meta {
        display: flex;
        background: #fdfbf7;
        border: 1px solid #fdf5e6;
        border-radius: 12px;
        padding: 12px 16px;
        margin-top: 15px;
    }

    .meta-item {
        flex: 1;
    }

    .meta-separator {
        width: 1px; background: #f2e3c6; margin: 0 16px;
    }

    .meta-label {
        display: block; font-size: 10px; color: #8b7355;
        text-transform: uppercase; letter-spacing: 0.5px;
        font-weight: 600; margin-bottom: 4px;
    }

    .meta-value {
        font-size: 13px; font-weight: 700; color: #4a3f35;
    }

    /* Badges */
    .status-badge {
        display: inline-flex; align-items: center;
        padding: 5px 12px; border-radius: 50px;
        font-size: 11px; font-weight: 600;
    }

    .st-warning { background: #fffbeb; color: #d97706; border: 1px solid #fef3c7; }
    .st-primary { background: #eff6ff; color: #2563eb; border: 1px solid #dbeafe; }
    .st-info    { background: #f0fdfa; color: #0d9488; border: 1px solid #ccfbf1; }
    .st-success { background: #ecfdf5; color: #059669; border: 1px solid #d1fae5; }
    .st-danger  { background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }
    .st-secondary { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }

    /* Denda Box */
    .denda-box {
        background: #fff5f5; border: 1px solid #ffe4e6;
        padding: 12px; border-radius: 10px;
    }

    .denda-label { font-size: 11px; font-weight: 600; color: #9ca3af; }
    .denda-value { font-size: 14px; font-weight: 800; color: #e11d48; }

    /* Footer Action */
    .rcard-footer {
        padding: 15px 20px;
        background: #fdfbf7;
        border-top: 1px solid #fdf5e6;
    }

    .btn-return {
        background: #fff;
        color: #a8855f;
        border: 1.5px solid #a8855f;
        padding: 10px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-return:hover {
        background: #a8855f;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(168,133,95,0.25);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        background: #fff;
        border: 1px dashed #dabe96;
        border-radius: 20px;
        padding: 60px 20px;
        max-width: 500px;
        margin: 0 auto;
    }

    .empty-icon {
        font-size: 60px; line-height: 1; margin-bottom: 20px;
    }

    .empty-title {
        font-size: 20px; font-weight: 700; color: #4a3f35;
        margin-bottom: 10px;
    }

    .empty-desc {
        font-size: 14px; color: #8b7355; margin-bottom: 25px;
    }

    .btn-primary-elegant {
        background: linear-gradient(135deg, #a8855f, #c0a07a);
        color: #fff;
        padding: 10px 24px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(168,133,95,0.3);
    }

    .btn-primary-elegant:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(168,133,95,0.4);
        color: #fff;
    }
</style>
@endsection
