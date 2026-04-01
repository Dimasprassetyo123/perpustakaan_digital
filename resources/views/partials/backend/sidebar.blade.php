<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
        <a class="sidebar-brand brand-logo" href="{{ route('adminPetugas') }}">
            <img src="{{ asset('assetsbackend/images/buku2.png') }}" alt="logo" />
        </a>
    </div>

    <ul class="nav">

        {{-- PROFILE --}}
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assetsbackend/images/faces/face1.jpg') }}" />
                </div>

                <div class="nav-profile-text d-flex flex-column pr-3">
                    @auth
                        <span>
                            {{ Auth::user()->username }}
                        </span>

                        <span class="font-weight-medium mb-2">
                            {{ Auth::user()->role == 'kepala' ? 'Kepala Perpustakaan' : 'Petugas Perpustakaan' }}
                        </span>
                    @endauth
                </div>
            </a>
        </li>

        {{-- DASHBOARD (SEMUA ROLE) --}}
        <li class="nav-item {{ request()->routeIs('adminPetugas') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('adminPetugas') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- ================= PETUGAS ================= --}}
        @auth
        @if(Auth::user()->role == 'petugas')

            {{-- BUKU --}}
            <li class="nav-item {{ request()->routeIs('buku.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('buku.index') }}">
                    <i class="mdi mdi-book-open-page-variant menu-icon"></i>
                    <span class="menu-title">CRUD Buku</span>
                </a>
            </li>

        @endif
        @endauth

        {{-- ================= KEPALA ================= --}}
        @auth
        @if(Auth::user()->role == 'kepala')

            {{-- PETUGAS --}}
            <li class="nav-item {{ request()->routeIs('petugas') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="mdi mdi-account-group menu-icon"></i>
                    <span class="menu-title">Data Petugas</span>
                </a>
            </li>

            {{-- LAPORAN --}}
            <li class="nav-item {{ request()->routeIs('laporan') ? 'active' : '' }}">
                <a class="nav-link" href="#">
                    <i class="mdi mdi-chart-bar menu-icon"></i>
                    <span class="menu-title">Laporan</span>
                </a>
            </li>

        @endif
        @endauth

    </ul>
</nav>
