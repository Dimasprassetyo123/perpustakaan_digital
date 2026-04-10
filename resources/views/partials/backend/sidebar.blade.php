{{-- ========== SIDEBAR OVERLAY (Mobile/Tablet) ========== --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- ========== SIDEBAR ========== --}}
<nav class="sidebar" id="sidebar">

    {{-- ===== SIDEBAR HEADER / BRAND ===== --}}
    <div class="sidebar-header">
        @auth
            @if (Auth::user()->role == 'kepala')
                <a class="sidebar-brand" href="{{ route('kepala') }}">
            @else
                <a class="sidebar-brand" href="{{ route('petugas.dashboard') }}">
            @endif
        @else
            <a class="sidebar-brand" href="{{ route('login') }}">
        @endauth
            <div class="sidebar-brand-icon">
                <img src="{{ asset('assetsbackend/images/buku2.png') }}" alt="logo" />
            </div>
            <div class="sidebar-brand-text">
                <span class="brand-name">Perpustakaan</span>
                <span class="brand-sub">Digital System</span>
            </div>
        </a>

        {{-- Close button (mobile only) --}}
        <button class="sidebar-close-btn" id="sidebarCloseBtn" aria-label="Tutup sidebar">
            <i class="mdi mdi-close"></i>
        </button>
    </div>

    {{-- ===== PROFILE SECTION ===== --}}
    @auth
    <div class="sidebar-profile">
        <div class="sidebar-profile-avatar">
            <img src="{{ asset('assetsbackend/images/faces/face1.jpg') }}" alt="Profile" />
            <span class="avatar-status online"></span>
        </div>
        <div class="sidebar-profile-info">
            <span class="profile-name">{{ Auth::user()->username }}</span>
            <span class="profile-role">
                <i class="mdi mdi-shield-account"></i>
                {{ Auth::user()->role == 'kepala' ? 'Kepala Perpustakaan' : 'Petugas Perpustakaan' }}
            </span>
        </div>
    </div>
    @endauth

    {{-- ===== NAV MENU ===== --}}
    <div class="sidebar-nav-wrapper">
        <ul class="sidebar-nav">

            {{-- ===== DASHBOARD ===== --}}
            @auth
            <li class="nav-section-label">
                <span>Utama</span>
            </li>

            <li class="sidebar-nav-item {{ request()->is('kepala') || request()->is('petugas/dashboard') ? 'active' : '' }}">
                @if (Auth::user()->role == 'kepala')
                    <a class="sidebar-nav-link" href="{{ route('kepala') }}">
                @else
                    <a class="sidebar-nav-link" href="{{ route('petugas.dashboard') }}">
                @endif
                    <span class="nav-icon-wrapper">
                        <i class="mdi mdi-view-dashboard"></i>
                    </span>
                    <span class="nav-label">Dashboard</span>
                    @if (request()->is('kepala') || request()->is('petugas/dashboard'))
                        <span class="nav-active-dot"></span>
                    @endif
                    </a>
            </li>
            @endauth

            {{-- ===== MENU PETUGAS ===== --}}
            @auth
            @if (Auth::user()->role == 'petugas')
            <li class="nav-section-label">
                <span>Menu Petugas</span>
            </li>

            <li class="sidebar-nav-item {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                <a class="sidebar-nav-link" href="{{ route('buku.index') }}">
                    <span class="nav-icon-wrapper">
                        <i class="mdi mdi-book-open-page-variant"></i>
                    </span>
                    <span class="nav-label">Data Buku</span>
                    @if (request()->routeIs('buku.*'))
                        <span class="nav-active-dot"></span>
                    @endif
                </a>
            </li>

            <li class="sidebar-nav-item {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
                <a class="sidebar-nav-link" href="{{ route('peminjaman.index') }}">
                    <span class="nav-icon-wrapper">
                        <i class="mdi mdi-package-down"></i>
                    </span>
                    <span class="nav-label">Peminjaman</span>
                    @if (request()->routeIs('peminjaman.*'))
                        <span class="nav-active-dot"></span>
                    @endif
                </a>
            </li>

            <li class="sidebar-nav-item {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}">
                <a class="sidebar-nav-link" href="{{ route('pengembalian.index') }}">
                    <span class="nav-icon-wrapper">
                        <i class="mdi mdi-clipboard-check"></i>
                    </span>
                    <span class="nav-label">Pengembalian</span>
                    @if (request()->routeIs('pengembalian.*'))
                        <span class="nav-active-dot"></span>
                    @endif
                </a>
            </li>

            <li class="sidebar-nav-item {{ request()->routeIs('denda.*') ? 'active' : '' }}">
                <a class="sidebar-nav-link" href="{{ route('denda.index') }}">
                    <span class="nav-icon-wrapper">
                        <i class="mdi mdi-cash-multiple"></i>
                    </span>
                    <span class="nav-label">Data Denda</span>
                    @if (request()->routeIs('denda.*'))
                        <span class="nav-active-dot"></span>
                    @endif
                </a>
            </li>
            @endif
            @endauth

            {{-- ===== MENU KEPALA ===== --}}
            @auth
            @if (Auth::user()->role == 'kepala')
            <li class="nav-section-label">
                <span>Menu Kepala</span>
            </li>

            <li class="sidebar-nav-item {{ request()->routeIs('petugas.*') ? 'active' : '' }}">
                <a class="sidebar-nav-link" href="{{ route('petugas.index') }}">
                    <span class="nav-icon-wrapper">
                        <i class="mdi mdi-account-group"></i>
                    </span>
                    <span class="nav-label">Data Petugas</span>
                    @if (request()->routeIs('petugas.*'))
                        <span class="nav-active-dot"></span>
                    @endif
                </a>
            </li>

            <li class="sidebar-nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                <a class="sidebar-nav-link" href="{{ route('laporan.index') }}">
                    <span class="nav-icon-wrapper">
                        <i class="mdi mdi-chart-bar"></i>
                    </span>
                    <span class="nav-label">Laporan</span>
                    @if (request()->routeIs('laporan.*'))
                        <span class="nav-active-dot"></span>
                    @endif
                </a>
            </li>
            @endif
            @endauth

            {{-- ===== GUEST ===== --}}
            @guest
            <li class="nav-section-label">
                <span>Akses</span>
            </li>

            <li class="sidebar-nav-item">
                <a class="sidebar-nav-link" href="{{ route('login') }}">
                    <span class="nav-icon-wrapper">
                        <i class="mdi mdi-login"></i>
                    </span>
                    <span class="nav-label">Login</span>
                </a>
            </li>
            @endguest

        </ul>
    </div>

    {{-- ===== SIDEBAR FOOTER ===== --}}
    @auth
    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-logout-btn">
                <i class="mdi mdi-logout"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
    @endauth

</nav>
