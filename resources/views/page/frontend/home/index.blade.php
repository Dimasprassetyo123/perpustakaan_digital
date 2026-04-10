@extends('partials.frontend.app')
@section('content')

{{-- ============================================================
     HERO SECTION
============================================================ --}}
<section id="home">
    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="container mt-3">
            <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <div class="hero-section">
        <div class="hero-bg-decor"></div>
        <div class="container" style="position:relative;z-index:2;">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hero-badge">📚 Perpustakaan Digital</div>
                    <h1 class="hero-title">
                        Temukan Buku<br>
                        <span class="hero-title-gradient">Impianmu Disini</span>
                    </h1>
                    <p class="hero-desc">
                        Akses ribuan koleksi buku digital, pinjam, dan kelola riwayat
                        peminjaman Anda dengan mudah dan cepat.
                    </p>
                    <div class="hero-actions">
                        <a href="#popular-books" class="btn-hero-primary">
                            <i class="bi bi-search me-2"></i> Jelajahi Buku
                        </a>
                        <a href="#popular-swiper" class="btn-hero-outline">
                            🔥 Buku Populer
                        </a>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <span class="stat-num">{{ $buku->count() }}</span>
                            <span class="stat-label">Koleksi Buku</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="stat-num">{{ $populer->count() }}</span>
                            <span class="stat-label">Buku Populer</span>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <span class="stat-num">Free</span>
                            <span class="stat-label">Akses Gratis</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-books-visual">
                        @foreach($buku->take(4) as $i => $hb)
                        <div class="hero-book-card hero-book-{{ $i + 1 }}">
                            @if($hb->cover)
                                <img src="{{ asset('storage/'.$hb->cover) }}" alt="{{ $hb->judul_buku }}">
                            @else
                                <div class="hero-book-placeholder"><i class="bi bi-book-half"></i></div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SEMUA BUKU
============================================================ --}}
<section id="popular-books" class="books-section">
    <div class="container">

        {{-- SECTION HEADER --}}
        <div class="section-head">
            <span class="section-badge">📖 Koleksi</span>
            <h2 class="section-title">Semua <span>Buku</span></h2>
            <p class="section-desc">Temukan buku yang Anda butuhkan dari koleksi lengkap perpustakaan kami</p>
        </div>

        {{-- SEARCH BAR --}}
        <div class="search-wrapper">
            <div class="search-box">
                <i class="bi bi-search search-icon"></i>
                <input type="text" id="searchBuku" class="search-input" placeholder="Cari judul buku...">
            </div>
        </div>

        {{-- CATEGORY TABS --}}
        <div class="cat-tabs-wrapper">
            <button class="cat-tab active" data-target="all">Semua</button>
            @foreach ($buku->pluck('kategori')->unique() as $kat)
                <button class="cat-tab" data-target="{{ Str::slug($kat) }}">{{ $kat }}</button>
            @endforeach
        </div>

        {{-- BOOKS GRID --}}
        <div id="books-all" class="books-grid cat-content active">
            @forelse ($buku as $item)
            <div class="book-card-item buku-item" data-judul="{{ strtolower($item->judul_buku) }}" data-kat="{{ Str::slug($item->kategori) }}">
                <div class="bcard">
                    <div class="bcard-cover">
                        @if ($item->cover)
                            <img src="{{ asset('storage/' . $item->cover) }}" alt="{{ $item->judul_buku }}">
                        @else
                            <div class="bcard-no-cover"><i class="bi bi-book-half"></i></div>
                        @endif
                        <div class="bcard-overlay">
                            <a href="{{ route('buku.detail', $item->id_buku) }}" class="bcard-overlay-btn">
                                Lihat Detail
                            </a>
                        </div>
                        <div class="bcard-kat-badge">{{ $item->kategori }}</div>
                    </div>
                    <div class="bcard-body">
                        <p class="bcard-title">{{ $item->judul_buku }}</p>
                        <p class="bcard-author"><i class="bi bi-person me-1"></i>{{ $item->penulis }}</p>
                        <div class="bcard-footer">
                            @if ($item->stok > 5)
                                <span class="stok-badge stok-ok">{{ $item->stok }} Tersedia</span>
                            @elseif ($item->stok > 0)
                                <span class="stok-badge stok-warn">{{ $item->stok }} Sisa</span>
                            @else
                                <span class="stok-badge stok-empty">Habis</span>
                            @endif

                            @if ($item->stok > 0)
                                <a href="{{ route('peminjaman.create', $item->id_buku) }}" class="btn-pinjam">
                                    Pinjam
                                </a>
                            @else
                                <button class="btn-pinjam-disabled" disabled>Habis</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-inbox display-3" style="color:#c7d2fe;"></i>
                <p class="mt-3" style="color:#6b7280;">Belum ada buku tersedia</p>
            </div>
            @endforelse
        </div>

        {{-- NO RESULT --}}
        <div id="no-result" style="display:none;" class="text-center py-5">
            <i class="bi bi-search display-3" style="color:#c7d2fe;"></i>
            <p class="mt-3" style="color:#6b7280;">Buku tidak ditemukan</p>
        </div>

    </div>
</section>

{{-- ============================================================
     POPULAR BOOKS SWIPER  (tetap dari sebelumnya)
============================================================ --}}
{{-- ========== POPULAR BOOKS SWIPER ========== --}}
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        /* ===== SECTION WRAPPER ===== */
        #popular-swiper {
            padding: 70px 0 80px;
            background: #fdfbf7;
            position: relative;
            overflow: hidden;
        }

        /* Subtle top border accent */
        #popular-swiper::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #dabe96, #f2e3c6, #c0a07a);
        }

        /* ===== SECTION HEADER ===== */
        .popular-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .popular-header .subtitle {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #8b7355;
            background: rgba(168,133,95,0.08);
            border: 1px solid rgba(168,133,95,0.2);
            padding: 5px 18px;
            border-radius: 50px;
            margin-bottom: 14px;
        }

        .popular-header h2 {
            font-size: clamp(24px, 3.5vw, 38px);
            font-weight: 800;
            color: #4a3f35;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .popular-header h2 span { color: #a8855f; }

        /* ===== SWIPER OUTER WRAPPER ===== */
        .popular-swiper-outer {
            position: relative;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        /* ===== NAVIGATION BUTTONS ===== */
        .swiper-btn-prev,
        .swiper-btn-next {
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #ffffff;
            border: 1.5px solid #eae1d8;
            color: #a8855f;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: background 0.25s, border-color 0.25s, box-shadow 0.25s, transform 0.2s;
            box-shadow: 0 2px 12px rgba(168,133,95,0.1);
        }

        .swiper-btn-prev:hover, .swiper-btn-next:hover {
            background: #a8855f;
            border-color: #a8855f;
            color: #fff;
            box-shadow: 0 4px 18px rgba(168,133,95,0.35);
            transform: scale(1.08);
        }

        .swiper-btn-prev.swiper-button-disabled,
        .swiper-btn-next.swiper-button-disabled {
            opacity: 0.35;
            cursor: not-allowed;
            transform: none;
        }

        /* ===== SWIPER CONTAINER ===== */
        .swiper-populer {
            flex: 1;
            min-width: 0;
            padding-bottom: 50px !important;
            overflow: visible !important;
        }

        .swiper-populer .swiper-slide { height: auto; }

        /* ===== CARD ===== */
        .book-card-populer {
            background: #ffffff;
            border: 1px solid #fdf5e6;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
            box-shadow: 0 2px 12px rgba(168,133,95,0.06);
        }

        .book-card-populer:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(168,133,95,0.15);
            border-color: rgba(168,133,95,0.3);
        }

        .book-card-cover {
            position: relative;
            overflow: hidden;
            aspect-ratio: 3/4;
            flex-shrink: 0;
            background: #faf3e8;
        }

        .book-card-cover img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
            display: block;
        }

        .book-card-populer:hover .book-card-cover img { transform: scale(1.05); }

        .book-rank-badge {
            position: absolute; top: 10px; left: 10px;
            width: 30px; height: 30px; border-radius: 50%;
            background: linear-gradient(135deg, #dabe96, #a8855f);
            color: #fff; font-size: 11px; font-weight: 800;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 3px 8px rgba(0,0,0,0.15); z-index: 2;
        }

        .book-hot-badge {
            position: absolute; top: 10px; right: 10px;
            background: #ef4444; color: #fff;
            font-size: 9px; font-weight: 700;
            padding: 3px 9px; border-radius: 50px; z-index: 2;
        }

        .book-card-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(74,63,53,0.82) 0%, transparent 55%);
            opacity: 0; transition: opacity 0.3s ease;
            display: flex; align-items: flex-end; justify-content: center;
            padding-bottom: 16px; z-index: 3;
        }

        .book-card-populer:hover .book-card-overlay { opacity: 1; }

        .book-overlay-btn {
            background: #a8855f; color: #fff; border: none;
            padding: 8px 18px; border-radius: 50px;
            font-size: 12px; font-weight: 600;
            text-decoration: none; cursor: pointer;
            transition: background 0.2s, transform 0.2s; display: inline-block;
        }

        .book-overlay-btn:hover { background: #8b7355; transform: scale(1.04); color: #fff; }

        .book-card-body { padding: 14px; flex: 1; display: flex; flex-direction: column; gap: 6px; }

        .book-card-title {
            font-size: 13px; font-weight: 700; color: #4a3f35; line-height: 1.4;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
            overflow: hidden; margin: 0;
        }

        .book-card-author { font-size: 11px; color: #9ca3af; margin: 0; }

        .book-card-meta {
            display: flex; align-items: center; justify-content: space-between;
            margin-top: auto; padding-top: 10px;
            border-top: 1px solid #fdf5e6; gap: 6px;
        }

        .book-popular-count { font-size: 10px; color: #ef4444; font-weight: 600; flex-shrink: 0; }

        .book-card-action { text-decoration: none; }

        .btn-pinjam-swiper {
            background: #a8855f; color: #fff; border: none;
            padding: 5px 12px; border-radius: 50px;
            font-size: 10px; font-weight: 600; cursor: pointer;
            transition: background 0.2s; white-space: nowrap; display: inline-block;
        }

        .btn-pinjam-swiper:hover { background: #8b7355; color: #fff; }

        .btn-habis-swiper {
            background: #fef2f2; color: #ef4444;
            border: 1px solid #fecaca;
            padding: 5px 12px; border-radius: 50px;
            font-size: 10px; font-weight: 600; cursor: not-allowed; white-space: nowrap;
        }

        /* ===== PAGINATION ===== */
        .swiper-pagination-populer { bottom: -5px !important; }

        .swiper-pagination-populer .swiper-pagination-bullet {
            width: 8px; height: 8px; background: #e2d1bc;
            opacity: 1; transition: width 0.3s, background 0.3s; border-radius: 50px;
        }

        .swiper-pagination-populer .swiper-pagination-bullet-active {
            width: 32px; background: #a8855f;
            box-shadow: 0 0 10px rgba(168,133,95,0.5);
        }

        /* Highlight Center Slide in Coverflow */
        .swiper-slide-active .book-card-populer {
            box-shadow: 0 25px 50px -12px rgba(168,133,95,0.35);
            border-color: rgba(168,133,95,0.6);
        }

        @media (max-width: 768px) {
            .swiper-btn-prev, .swiper-btn-next { width: 38px; height: 38px; font-size: 18px; }
            .popular-swiper-outer { gap: 0px; }
        }

        @media (max-width: 480px) {
            .swiper-btn-prev, .swiper-btn-next { width: 34px; height: 34px; font-size: 16px; }
        }
    </style>
    @endpush

    <section id="popular-swiper">
        <div class="container position-relative" style="z-index:1;">
            <div class="popular-header">
                <div class="subtitle">🔥 Trending Now</div>
                <h2>Buku <span>Paling Populer</span></h2>
            </div>

            @if($populer->isNotEmpty())
            <div class="popular-swiper-outer">
                <button class="swiper-btn-prev" id="popularPrev" aria-label="Sebelumnya">
                    <i class="mdi mdi-chevron-left"></i>
                </button>

                <div class="swiper swiper-populer" id="swiperPopuler">
                    <div class="swiper-wrapper">
                        @foreach($populer as $index => $item)
                        <div class="swiper-slide">
                            <div class="book-card-populer">
                                <div class="book-card-cover">
                                    @if ($item->buku && $item->buku->cover)
                                        <img src="{{ asset('storage/' . $item->buku->cover) }}" alt="{{ $item->buku->judul_buku }}">
                                    @else
                                        <img src="https://placehold.co/300x400/ebebf5/6366f1?text=📖" alt="No Cover">
                                    @endif
                                    <div class="book-rank-badge">#{{ $index + 1 }}</div>
                                    @if($index < 3)
                                    <div class="book-hot-badge">🔥 HOT</div>
                                    @endif
                                    <div class="book-card-overlay">
                                        <a href="{{ route('buku.detail', $item->buku->id_buku) }}" class="book-overlay-btn">Lihat Detail</a>
                                    </div>
                                </div>
                                <div class="book-card-body">
                                    <p class="book-card-title">{{ $item->buku->judul_buku ?? '-' }}</p>
                                    <p class="book-card-author">{{ $item->buku->penulis ?? '-' }}</p>
                                    <div class="book-card-meta">
                                        <span class="book-popular-count">🔥 {{ $item->total }}x dipinjam</span>
                                        @if ($item->buku && $item->buku->stok > 0)
                                            <a href="{{ route('peminjaman.create', $item->buku->id_buku) }}" class="btn-pinjam-swiper book-card-action">📖 Pinjam</a>
                                        @else
                                            <span class="btn-habis-swiper">❌ Habis</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination swiper-pagination-populer"></div>
                </div>

                <button class="swiper-btn-next" id="popularNext" aria-label="Berikutnya">
                    <i class="mdi mdi-chevron-right"></i>
                </button>
            </div>{{-- .popular-swiper-outer --}}
            @else
                <div class="text-center py-5">
                    <p style="color: #9ca3af; font-size:16px;">Belum ada buku populer.</p>
                </div>
            @endif
        </div>
    </section>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Modern Coverflow Slider Configuration
            new Swiper('#swiperPopuler', {
                effect: 'coverflow',
                grabCursor: true,
                centeredSlides: true,
                slidesPerView: 'auto',
                coverflowEffect: {
                    rotate: 20,       // Slide rotate in degrees
                    stretch: -30,     // Stretch space between slides
                    depth: 150,       // Depth offset
                    modifier: 1.5,    // Effect multiplier
                    slideShadows: true, // Enable slide shadow
                },
                loop: true,
                autoplay: { 
                    delay: 3500, 
                    disableOnInteraction: false, 
                    pauseOnMouseEnter: true 
                },
                pagination: { 
                    el: '.swiper-pagination-populer', 
                    clickable: true,
                    dynamicBullets: true 
                },
                navigation: { 
                    prevEl: '#popularPrev', 
                    nextEl: '#popularNext' 
                },
                breakpoints: {
                    320: { slidesPerView: 1.4 },
                    480: { slidesPerView: 1.8 },
                    768: { slidesPerView: 2.5 },
                    1024: { slidesPerView: 3.2 },
                    1280: { slidesPerView: 3.8 },
                },
            });
        });
    </script>
    @endpush

{{-- ============================================================
     HOME PAGE STYLES
============================================================ --}}
<style>
    /* ===== HERO ===== */
    .hero-section {
        background: linear-gradient(135deg, #fdfbf7 0%, #faf3e8 60%, #fffefe 100%);
        padding: 70px 0 80px;
        position: relative;
        overflow: hidden;
        margin-top: -1px;
    }

    .hero-bg-decor {
        position: absolute;
        top: -100px; right: -100px;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(168,133,95,0.08) 0%, transparent 70%);
        pointer-events: none;
    }

    .hero-badge {
        display: inline-block;
        background: rgba(168,133,95,0.08);
        border: 1px solid rgba(168,133,95,0.2);
        color: #8b7355;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 6px 18px;
        border-radius: 50px;
        margin-bottom: 20px;
    }

    .hero-title {
        font-size: clamp(32px, 5vw, 58px);
        font-weight: 800;
        color: #4a3f35;
        line-height: 1.15;
        margin-bottom: 18px;
        letter-spacing: -1px;
    }

    .hero-title-gradient {
        background: linear-gradient(135deg, #a8855f, #c0a07a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-desc {
        font-size: 16px;
        color: #8b7355;
        line-height: 1.7;
        max-width: 480px;
        margin-bottom: 32px;
    }

    .hero-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 40px;
    }

    .btn-hero-primary {
        background: linear-gradient(135deg, #a8855f, #c0a07a);
        color: #fff;
        padding: 13px 28px;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 6px 20px rgba(168,133,95,0.25);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-hero-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(168,133,95,0.35);
        color: #fff;
    }

    .btn-hero-outline {
        background: #fff;
        color: #a8855f;
        padding: 13px 28px;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        border: 1.5px solid rgba(168,133,95,0.3);
        display: inline-flex;
        align-items: center;
        transition: background 0.2s, border-color 0.2s, transform 0.2s;
    }

    .btn-hero-outline:hover {
        background: rgba(168,133,95,0.05);
        border-color: #a8855f;
        transform: translateY(-2px);
        color: #8b7355;
    }

    /* Hero stats */
    .hero-stats {
        display: flex;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
    }

    .hero-stat {
        display: flex;
        flex-direction: column;
    }

    .stat-num {
        font-size: 24px;
        font-weight: 800;
        color: #4a3f35;
        line-height: 1;
    }

    .stat-label {
        font-size: 11px;
        color: #8b7355;
        font-weight: 500;
        margin-top: 2px;
    }

    .hero-stat-divider {
        width: 1px;
        height: 36px;
        background: #f2e3c6;
    }

    /* Hero visual books */
    .hero-books-visual {
        position: relative;
        height: 380px;
    }

    .hero-book-card {
        position: absolute;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 16px 40px rgba(168,133,95,0.12);
        border: 3px solid #fff;
    }

    .hero-book-card img {
        width: 100%; height: 100%;
        object-fit: cover; display: block;
    }

    .hero-book-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #fdf9f1, #e2d1bc);
        display: flex; align-items: center; justify-content: center;
        font-size: 48px; color: #dabe96;
    }

    .hero-book-1 { width: 140px; height: 190px; top: 20px; left: 60px; z-index: 4; transform: rotate(-4deg); }
    .hero-book-2 { width: 130px; height: 180px; top: 60px; left: 200px; z-index: 3; transform: rotate(3deg); }
    .hero-book-3 { width: 120px; height: 170px; top: 160px; left: 80px; z-index: 2; transform: rotate(-2deg); }
    .hero-book-4 { width: 130px; height: 180px; top: 180px; left: 220px; z-index: 1; transform: rotate(5deg); }

    /* ===== ALL BOOKS SECTION ===== */
    .books-section {
        padding: 80px 0;
        background: #fff;
    }

    .section-head {
        text-align: center;
        margin-bottom: 40px;
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
        font-size: clamp(26px, 3.5vw, 40px);
        font-weight: 800;
        color: #4a3f35;
        margin: 0 0 10px;
        letter-spacing: -0.5px;
    }

    .section-title span { color: #a8855f; }

    .section-desc {
        color: #6b7280;
        font-size: 15px;
        max-width: 500px;
        margin: 0 auto;
    }

    /* Search */
    .search-wrapper {
        max-width: 520px;
        margin: 0 auto 32px;
    }

    .search-box {
        display: flex;
        align-items: center;
        background: #fdfbf7;
        border: 1.5px solid #f2e3c6;
        border-radius: 50px;
        padding: 10px 20px;
        gap: 10px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-box:focus-within {
        border-color: #a8855f;
        box-shadow: 0 0 0 3px rgba(168,133,95,0.1);
    }

    .search-icon { color: #a8855f; font-size: 16px; flex-shrink: 0; }

    .search-input {
        border: none; background: transparent; outline: none;
        font-size: 14px; color: #4a3f35; width: 100%;
    }

    .search-input::placeholder { color: #9ca3af; }

    /* Category tabs */
    .cat-tabs-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
        margin-bottom: 36px;
    }

    .cat-tab {
        background: #fdf5e6;
        border: 1.5px solid #f2e3c6;
        color: #8b7355;
        padding: 7px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .cat-tab:hover {
        background: #faf3e8;
        border-color: #dabe96;
        color: #a8855f;
    }

    .cat-tab.active {
        background: #a8855f;
        border-color: #a8855f;
        color: #fff;
        box-shadow: 0 4px 12px rgba(168,133,95,0.3);
    }

    /* Books grid */
    .books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 24px;
    }

    /* Book card */
    .bcard {
        background: #fff;
        border: 1px solid #fdf5e6;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 2px 10px rgba(168,133,95,0.05);
    }

    .bcard:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(168,133,95,0.14);
        border-color: rgba(168,133,95,0.3);
    }

    .bcard-cover {
        position: relative;
        aspect-ratio: 3/4;
        overflow: hidden;
        background: #faf3e8;
        flex-shrink: 0;
    }

    .bcard-cover img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
        display: block;
    }

    .bcard:hover .bcard-cover img { transform: scale(1.05); }

    .bcard-no-cover {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, #fdf9f1, #e2d1bc);
        font-size: 42px; color: #dabe96;
    }

    .bcard-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(74,63,53,0.8) 0%, transparent 55%);
        opacity: 0; transition: opacity 0.3s;
        display: flex; align-items: flex-end; justify-content: center;
        padding-bottom: 14px; z-index: 2;
    }

    .bcard:hover .bcard-overlay { opacity: 1; }

    .bcard-overlay-btn {
        background: #fff; color: #a8855f;
        padding: 7px 20px; border-radius: 50px;
        font-size: 12px; font-weight: 700;
        text-decoration: none;
        transition: background 0.2s;
    }

    .bcard-overlay-btn:hover { background: #faf3e8; color: #8b7355; }

    .bcard-kat-badge {
        position: absolute; top: 10px; left: 10px;
        background: rgba(255,255,255,0.9);
        color: #a8855f; font-size: 9px; font-weight: 700;
        padding: 3px 10px; border-radius: 50px;
        backdrop-filter: blur(4px); z-index: 2;
        letter-spacing: 0.3px;
    }

    .bcard-body {
        padding: 14px; flex: 1;
        display: flex; flex-direction: column; gap: 5px;
    }

    .bcard-title {
        font-size: 13px; font-weight: 700; color: #4a3f35;
        line-height: 1.4; margin: 0;
        display: -webkit-box; -webkit-line-clamp: 2;
        -webkit-box-orient: vertical; overflow: hidden;
    }

    .bcard-author { font-size: 11px; color: #9ca3af; margin: 0; }

    .bcard-footer {
        display: flex; align-items: center; justify-content: space-between;
        margin-top: auto; padding-top: 10px;
        border-top: 1px solid #fdf5e6; gap: 6px;
    }

    .stok-badge {
        font-size: 10px; font-weight: 600; padding: 3px 10px; border-radius: 50px;
    }

    .stok-ok { background: #ecfdf5; color: #059669; }
    .stok-warn { background: #fffbeb; color: #d97706; }
    .stok-empty { background: #fef2f2; color: #dc2626; }

    .btn-pinjam {
        background: #a8855f; color: #fff; border: none;
        padding: 5px 14px; border-radius: 50px;
        font-size: 11px; font-weight: 600; cursor: pointer;
        text-decoration: none; white-space: nowrap;
        transition: background 0.2s;
    }

    .btn-pinjam:hover { background: #8b7355; color: #fff; }

    .btn-pinjam-disabled {
        background: #fdf5e6; color: #9ca3af;
        border: 1px solid #f2e3c6;
        padding: 5px 14px; border-radius: 50px;
        font-size: 11px; font-weight: 600; cursor: not-allowed;
        white-space: nowrap;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .books-grid { grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 16px; }
        .hero-section { padding: 50px 0 60px; }
        .hero-title { font-size: 32px; }
    }

    @media (max-width: 480px) {
        .books-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ===== Search =====
    const searchInput = document.getElementById('searchBuku');
    const noResult    = document.getElementById('no-result');
    const allCards    = document.querySelectorAll('.buku-item');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            let found = 0;
            allCards.forEach(card => {
                const match = card.dataset.judul.includes(q);
                card.style.display = match ? '' : 'none';
                if (match) found++;
            });
            if (noResult) noResult.style.display = found === 0 ? 'block' : 'none';
        });
    }

    // ===== Category tabs =====
    const tabs = document.querySelectorAll('.cat-tab');
    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const target = this.dataset.target;
            allCards.forEach(card => {
                if (target === 'all' || card.dataset.kat === target) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });

            if (searchInput) searchInput.value = '';
            if (noResult) noResult.style.display = 'none';
        });
    });
});
</script>

@endsection
