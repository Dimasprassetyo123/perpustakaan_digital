<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * { font-family: 'Inter', sans-serif !important; }

    html { scroll-behavior: smooth; }
    section { scroll-margin-top: 80px; }

    /* ===== NAVBAR WRAPPER ===== */
    #header-wrap {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 9999;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(168,133,95,0.1);
        box-shadow: 0 2px 20px rgba(168,133,95,0.06);
        transition: box-shadow 0.3s;
    }

    /* Top bar */
    .top-content {
        background: linear-gradient(90deg, #dabe96, #a8855f);
        padding: 5px 0;
    }

    .top-content .right-element {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
    }

    .top-content a {
        color: rgba(255,255,255,0.85);
        font-size: 12px;
        text-decoration: none;
        transition: color 0.2s;
    }

    .top-content a:hover { color: #fff; }

    /* Profile dropdown in top bar */
    .top-content .dropdown > a {
        display: flex;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,0.9);
        font-size: 13px;
        font-weight: 500;
    }

    .top-content .dropdown-menu {
        border-radius: 12px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        min-width: 180px;
        overflow: hidden;
        margin-top: 6px;
    }

    .top-content .dropdown-item {
        padding: 10px 16px;
        font-size: 13px;
        transition: background 0.15s;
    }

    .top-content .dropdown-item:hover {
        background: #f0f0ff;
    }

    /* ===== MAIN HEADER ===== */
    #header {
        padding: 10px 0;
    }

    .main-logo img {
        height: 44px;
        width: auto;
        object-fit: contain;
    }

    /* ===== NAVIGATION MENU ===== */
    .main-menu {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        height: 100%;
    }

    .menu-list {
        display: flex;
        align-items: center;
        gap: 4px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .menu-item a {
        display: block;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
        white-space: nowrap;
    }

    .menu-item a:hover {
        background: rgba(168,133,95,0.08);
        color: #a8855f;
    }

    .menu-item a.active {
        background: rgba(168,133,95,0.1);
        color: #a8855f;
        font-weight: 600;
    }

    /* ===== HAMBURGER ===== */
    .hamburger {
        display: none;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
        padding: 6px;
        border-radius: 8px;
        background: rgba(168,133,95,0.08);
        border: 1.5px solid rgba(168,133,95,0.15);
    }

    .hamburger .bar {
        width: 22px;
        height: 2px;
        background: #a8855f;
        border-radius: 2px;
        transition: all 0.3s;
    }

    @media (max-width: 991px) {
        .hamburger { display: flex; }

        .menu-list {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            padding: 12px 16px;
            gap: 2px;
            border-top: 1px solid rgba(168,133,95,0.1);
        }

        .menu-list.open { display: flex; }

        .menu-item { width: 100%; }
        .menu-item a { width: 100%; }

        .main-menu {
            position: relative;
            justify-content: flex-end;
        }
    }

    /* Body padding to push below fixed navbar */
    body {
        padding-top: 100px;
    }
</style>

<div id="header-wrap">
    {{-- TOP BAR --}}
    <div class="top-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="right-element">
                        @if (Auth::check())
                            @php $anggota = session('anggota'); @endphp
                            <div class="dropdown">
                                <a href="#" id="anggotaDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if ($anggota && $anggota->image)
                                        <img src="{{ asset('uploads/anggota/' . $anggota->image) }}"
                                             width="28" height="28"
                                             class="rounded-circle border border-2 border-white"
                                             style="object-fit:cover;">
                                    @else
                                        <span style="width:28px;height:28px;border-radius:50%;background:rgba(255,255,255,0.2);display:inline-flex;align-items:center;justify-content:center;">
                                            <i class="bi bi-person-fill"></i>
                                        </span>
                                    @endif
                                    <span>{{ Auth::user()->username }}</span>
                                    <i class="bi bi-chevron-down" style="font-size:10px;"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-person-circle me-2 text-primary"></i> Profil
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider my-1"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('anggota.logout') }}">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('anggota.login') }}">
                                <i class="bi bi-person me-1"></i> Login
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- HEADER / NAVBAR --}}
    <header id="header">
        <div class="container-fluid px-4">
            <div class="row align-items-center">

                {{-- LOGO --}}
                <div class="col-auto">
                    <div class="main-logo">
                        <a href="{{ route('frontend.home') }}">
                            <img src="{{ asset('assetsfrontend/images/main-logo.png') }}" alt="logo">
                        </a>
                    </div>
                </div>

                {{-- MENU --}}
                <div class="col">
                    <nav id="navbar">
                        <div class="main-menu stellarnav">

                            <ul class="menu-list" id="mainMenuList">
                                <li class="menu-item">
                                    <a href="{{ route('frontend.home') }}"
                                       class="{{ request()->routeIs('frontend.home') ? 'active' : '' }}">
                                        <i class="bi bi-house me-1"></i> Home
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('frontend.home') }}#popular-books">
                                        <i class="bi bi-book me-1"></i> Semua Buku
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{ route('frontend.home') }}#popular-swiper">
                                        <i class="bi bi-fire me-1"></i> Populer
                                    </a>
                                </li>
                                @auth
                                <li class="menu-item">
                                    <a href="{{ route('riwayat') }}"
                                       class="{{ request()->routeIs('riwayat') ? 'active' : '' }}">
                                        <i class="bi bi-clock-history me-1"></i> Riwayat
                                    </a>
                                </li>
                                @endauth
                            </ul>

                            {{-- HAMBURGER --}}
                            <div class="hamburger" id="hamburgerBtn">
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </div>

                        </div>
                    </nav>
                </div>

            </div>
        </div>
    </header>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn  = document.getElementById('hamburgerBtn');
    const menu = document.getElementById('mainMenuList');
    if (btn && menu) {
        btn.addEventListener('click', function () {
            menu.classList.toggle('open');
        });
    }
});
</script>
