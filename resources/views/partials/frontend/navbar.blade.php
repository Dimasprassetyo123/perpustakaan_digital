<style>
    html {
        scroll-behavior: smooth;
    }

    /* supaya ga ketutup navbar */
    section {
        scroll-margin-top: 120px;
    }

    /* navbar aktif */
    .nav-link.active {
        color: #ff6b6b !important;
        font-weight: bold;
    }
</style>

<div id="header-wrap">

    <!-- TOP BAR -->
    <div class="top-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-17">
                    <div class="right-element">
                        @if (Auth::check())
                            @php $anggota = session('anggota'); @endphp

                            <div class="dropdown">
                                <a href="#" id="anggotaDropdown" data-bs-toggle="dropdown" aria-expanded="false">

                                    @if ($anggota && $anggota->image)
                                        <img src="{{ asset('uploads/anggota/' . $anggota->image) }}" width="40"
                                            height="40" class="rounded-circle border border-2"
                                            style="object-fit:cover;">
                                    @else
                                        <i class="icon icon-user fs-4"></i>
                                    @endif

                                    <span>{{ Auth::user()->username }}</span>
                                    <i class="bi bi-chevron-down ms-1"></i> <!-- optional arrow -->
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="anggotaDropdown">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                            href="#">
                                            <i class="bi bi-person-circle"></i> Profil
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2 text-danger"
                                            href="{{ route('anggota.logout') }}">
                                            <i class="bi bi-box-arrow-right"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('anggota.login') }}">Login</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- HEADER -->
    <header id="header">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-2">
                    <div class="main-logo">
                        <a href="#home">
                            <img src="{{ asset('assetsfrontend/images/main-logo.png') }}" alt="logo">
                        </a>
                    </div>
                </div>

                <div class="col-md-10">

                    <nav id="navbar">
                        <div class="main-menu stellarnav">

                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="#home" class="nav-link active">Home</a>
                                </li>

                                <li class="menu-item">
                                    <a href="#popular-books" class="nav-link">Semua Buku</a>
                                </li>

                                <li class="menu-item">
                                    <a href="#special-offer" class="nav-link">Popular</a>
                                </li>

                                <li class="menu-item">
                                    <a href="#" class="nav-link">Peminjaman</a>
                                </li>

                                <li class="menu-item">
                                    <a href="#latest-blog" class="nav-link">Riwayat</a>
                                </li>
                            </ul>

                            <!-- HAMBURGER -->
                            <div class="hamburger">
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
