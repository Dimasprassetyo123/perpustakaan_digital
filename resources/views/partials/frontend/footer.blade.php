<footer class="frontend-footer">
    <div class="container">
        <div class="row g-5">
            
            {{-- BRAND --}}
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <img src="{{ asset('assetsfrontend/images/main-logo.png') }}" alt="Perpustakaan Logo" class="footer-logo">
                    <p class="footer-desc">
                        Platform perpustakaan digital modern yang memudahkan Anda untuk mencari, meminjam, dan membaca koleksi buku terbaik dari manapun dan kapanpun.
                    </p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>

            {{-- LINKS 1 --}}
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget">
                    <h5 class="widget-title">Eksplorasi</h5>
                    <ul class="widget-lists">
                        <li><a href="{{ route('frontend.home') }}">Beranda</a></li>
                        <li><a href="{{ route('frontend.home') }}#popular-books">Semua Buku</a></li>
                        <li><a href="{{ route('frontend.home') }}#popular-swiper">Buku Populer</a></li>
                        @auth
                        <li><a href="{{ route('riwayat') }}">Riwayat Peminjaman</a></li>
                        @endauth
                    </ul>
                </div>
            </div>

            {{-- LINKS 2 --}}
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h5 class="widget-title">Pusat Bantuan</h5>
                    <ul class="widget-lists">
                        <li><a href="#">Cara Meminjam</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">FAQ (Tanya Jawab)</a></li>
                    </ul>
                </div>
            </div>

            {{-- CONTACT --}}
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h5 class="widget-title">Hubungi Kami</h5>
                    <ul class="contact-lists">
                        <li>
                            <i class="bi bi-geo-alt"></i> 
                            <span>Jl. Pendidikan No. 123, Kota Edukasi, Indonesia</span>
                        </li>
                        <li>
                            <i class="bi bi-envelope"></i> 
                            <span>info@perpustakaandigital.com</span>
                        </li>
                        <li>
                            <i class="bi bi-telephone"></i> 
                            <span>(021) 1234-5678</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    {{-- BOTTOM BAR --}}
    <div class="footer-bottom">
        <div class="container text-center">
            <p class="m-0">&copy; {{ date('Y') }} <strong>Perpustakaan Digital</strong>. Seluruh Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>

<style>
    .frontend-footer {
        background: #faf3e8;
        color: #8b7355;
        padding-top: 80px;
        font-family: 'Inter', sans-serif;
    }

    .footer-logo {
        height: 40px;
        margin-bottom: 20px;
        /* No brightness/invert needed for dark text on light bg */
    }

    .footer-desc {
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 25px;
        color: #8b7355;
    }

    .social-links {
        display: flex;
        gap: 12px;
    }

    .social-links a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        background: #fdf5e6;
        color: #a8855f;
        border-radius: 50%;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid #f2e3c6;
    }

    .social-links a:hover {
        background: #a8855f;
        border-color: #a8855f;
        transform: translateY(-3px);
    }

    .widget-title {
        color: #4a3f35;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 20px;
        letter-spacing: 0.5px;
    }

    .widget-lists {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .widget-lists li {
        margin-bottom: 12px;
    }

    .widget-lists a {
        color: #8b7355;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s, padding-left 0.2s;
        display: inline-block;
    }

    .widget-lists a:hover {
        color: #dabe96;
        padding-left: 5px;
    }

    .contact-lists {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .contact-lists li {
        display: flex;
        gap: 12px;
        margin-bottom: 15px;
        font-size: 14px;
        line-height: 1.6;
    }

    .contact-lists i {
        color: #dabe96;
        font-size: 18px;
        margin-top: 2px;
    }

    .footer-bottom {
        background: #fdf9f1;
        padding: 20px 0;
        margin-top: 60px;
        font-size: 13px;
        border-top: 1px solid #f2e3c6;
    }

    .footer-bottom strong {
        color: #4a3f35;
    }
</style>
