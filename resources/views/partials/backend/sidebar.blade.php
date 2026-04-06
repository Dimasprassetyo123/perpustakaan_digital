<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="text-center sidebar-brand-wrapper d-flex align-items-center">

        {{-- LOGO --}}
        @auth
            @if(Auth::user()->role == 'kepala')
                <a class="sidebar-brand brand-logo" href="{{ route('kepala') }}">
            @else
                <a class="sidebar-brand brand-logo" href="{{ route('petugas.dashboard') }}">
            @endif
                <img src="{{ asset('assetsbackend/images/buku2.png') }}" alt="logo" />
            </a>
        @else
            <a class="sidebar-brand brand-logo" href="{{ route('login') }}">
                <img src="{{ asset('assetsbackend/images/buku2.png') }}" alt="logo" />
            </a>
        @endauth
    </div>

    <ul class="nav">

        {{-- PROFILE --}}
        @auth
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assetsbackend/images/faces/face1.jpg') }}" />
                </div>

                <div class="nav-profile-text d-flex flex-column pr-3">
                    <span>{{ Auth::user()->username }}</span>
                    <span class="font-weight-medium mb-2">
                        {{ Auth::user()->role == 'kepala' ? 'Kepala Perpustakaan' : 'Petugas Perpustakaan' }}
                    </span>
                </div>
            </a>
        </li>
        @endauth

        {{-- DASHBOARD --}}
        @auth
        <li class="nav-item {{ request()->is('kepala') || request()->is('petugas/dashboard') ? 'active' : '' }}">
            @if(Auth::user()->role == 'kepala')
                <a class="nav-link" href="{{ route('kepala') }}">
            @else
                <a class="nav-link" href="{{ route('petugas.dashboard') }}">
            @endif
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @endauth

        {{-- ===== PETUGAS ===== --}}
        @auth
        @if(Auth::user()->role == 'petugas')

        <li class="nav-item {{ request()->routeIs('buku.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('buku.index') }}">
                <i class="mdi mdi-book-open-page-variant menu-icon"></i>
                <span class="menu-title">Buku</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
            <a class="nav-link" href="#">
                <i class="mdi mdi-package-down menu-icon"></i>
                <span class="menu-title">Peminjaman</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}">
            <a class="nav-link" href="#">
                <i class="mdi mdi-clipboard-text menu-icon"></i>
                <span class="menu-title">Pengembalian</span>
            </a>
        </li>

        @endif
        @endauth

        {{-- ===== KEPALA ===== --}}
        @auth
        @if(Auth::user()->role == 'kepala')

        <li class="nav-item {{ request()->routeIs('petugas.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('petugas.index') }}">
                <i class="mdi mdi-account-group menu-icon"></i>
                <span class="menu-title">Data Petugas</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
            <a class="nav-link" href="#">
                <i class="mdi mdi-chart-bar menu-icon"></i>
                <span class="menu-title">Laporan</span>
            </a>
        </li>

        @endif
        @endauth

        {{-- TAMPILKAN LOGIN JIKA GUEST --}}
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
                <i class="mdi mdi-login menu-icon"></i>
                <span class="menu-title">Login</span>
            </a>
        </li>
        @endguest

    </ul>
</nav>
