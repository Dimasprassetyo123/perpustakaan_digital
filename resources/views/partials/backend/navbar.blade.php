<style>
/* 🔥 FIX AGAR TIDAK KE POTONG */
.navbar,
.navbar-menu-wrapper,
.navbar-nav {
    overflow: visible !important;
}

/* 🔥 NAVBAR LAYOUT */
.navbar-menu-wrapper {
    width: 100%;
    display: flex;
    align-items: center;
    padding: 0 16px;
    gap: 10px;
}

/* Logo di navbar (mobile/iPad only) */
.navbar-mobile-brand {
    display: none;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    flex: 1;
}
.navbar-mobile-brand .mobile-brand-icon {
    width: 32px;
    height: 32px;
    border-radius: 9px;
    background: linear-gradient(135deg, #dabe96, #a8855f);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 3px 10px rgba(168,133,95,0.4);
    overflow: hidden;
    flex-shrink: 0;
}
.navbar-mobile-brand .mobile-brand-icon img {
    width: 20px;
    height: 20px;
    object-fit: contain;
    filter: brightness(0) invert(1);
}
.navbar-mobile-brand .mobile-brand-name {
    font-size: 14px;
    font-weight: 700;
    color: #1a1f36;
    letter-spacing: 0.2px;
}

/* 🔥 SEMBUNYIKAN TOGGLE DI DESKTOP, TAMPILKAN DI HP/IPAD */
.navbar-toggler {
    display: none;
    background: rgba(168,133,95,0.08);
    border: 1.5px solid rgba(168,133,95,0.2);
    color: #a8855f;
    width: 38px;
    height: 38px;
    border-radius: 10px;
    font-size: 20px;
    cursor: pointer;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: background 0.2s, color 0.2s;
    padding: 0;
}
.navbar-toggler:hover {
    background: rgba(168,133,95,0.18);
    color: #8b7355;
}
@media (max-width: 1024px) {
    .navbar-toggler {
        display: flex !important;
    }
    .navbar-mobile-brand {
        display: flex !important;
    }
    /* Geser right-nav ke ujung kanan */
    .navbar-nav-right {
        margin-left: auto !important;
    }
}

/* 🔥 BIAR DI ATAS */
.navbar {
    z-index: 9999 !important;
    padding-right: 20px;
}

/* 🔥 JARAK ICON KANAN */
.navbar-nav {
    display: flex;
    align-items: center;
    gap: 15px;
}

/* 🔥 POSISI */
.nav-notif,
.nav-profile {
    position: relative;
}

/* 🔥 BADGE */
.notif-badge {
    position: absolute;
    top: 4px;
    right: 4px;
    font-size: 10px;
    padding: 4px 6px;
    border-radius: 50%;
    background: red;
    color: white;
    font-weight: bold;
}

/* 🔥 DROPDOWN */
.nav-profile .dropdown-menu,
.nav-notif .dropdown-menu {
    display: none;
    position: absolute;
    top: 55px;
    right: 0;
    left: auto;
    margin-right: 10px;
    width: 280px;
    max-height: 400px;
    overflow-y: auto;
    background: #fff;
    border-radius: 16px;
    border: 1px solid #fdf5e6;
    box-shadow: 0 15px 35px rgba(168,133,95,0.15);
    padding: 0;
}

/* 🔥 SHOW */
.dropdown-menu.show {
    display: block;
}

/* 🔥 ITEM */
.dropdown-item {
    padding: 12px 16px;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    transition: background 0.2s;
}

.dropdown-item:hover {
    background-color: #faf3e8;
}

.dropdown-item .title {
    font-weight: 700;
    color: #4a3f35;
}

.dropdown-item .subtitle {
    font-size: 12px;
    color: #8b7355;
    margin-top: 2px;
}

.dropdown-divider-custom {
    border-top: 1px solid #fdf5e6;
    margin: 0;
}

/* 🔥 PROFILE HEADER - FIX SPACING */
.profile-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    border-bottom: 1px solid #fdf5e6;
    background: #fdfbf7;
    border-radius: 16px 16px 0 0;
}

.profile-header img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
}

.profile-header .profile-info {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.profile-header .profile-name {
    font-weight: 700;
    font-size: 14px;
    color: #4a3f35;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.profile-header .profile-role {
    font-size: 12px;
    color: #8b7355;
    margin-top: 2px;
}

/* 🔥 LOGOUT BUTTON - FIX */
.logout-section {
    padding: 12px 16px;
}

.logout-btn {
    width: 100%;
    padding: 10px 16px;
    border: none;
    background: #fdf5e6;
    color: #dc2626;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.15s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border: 1px solid #f2e3c6;
}

.logout-btn:hover {
    background: #fef2f2;
    border-color: #fecaca;
    color: #b91c1c;
}

.logout-btn i {
    font-size: 16px;
}

/* 🔥 NAV PROFILE LINK */
.nav-profile .nav-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 12px;
    border-radius: 8px;
    transition: background 0.2s ease;
}

.nav-profile .nav-link:hover {
    background: #fdf5e6;
}

.nav-profile .nav-link img {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    object-fit: cover;
    border: 1.5px solid #dabe96;
}

.nav-profile .nav-link span {
    font-weight: 600;
    color: #4a3f35;
}

.navbar-cream {
    background: #fdf9f1 !important; /* Warna Krem Terang */
    border-bottom: 1px solid #f2e3c6;
    box-shadow: 0 4px 20px rgba(168,133,95,0.06) !important;
}

.nav-notif .nav-link i {
    color: #8b7355;
}
</style>

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-cream" style="background-color: #fdf9f1 !important;">
    <div class="navbar-menu-wrapper" style="background-color: transparent !important;">

        {{-- TOGGLE (Kiri, muncul di HP/iPad) --}}
        <button class="navbar-toggler" type="button" id="navbarToggleBtn"
            onclick="if(typeof toggleSidebar === 'function') toggleSidebar();" aria-label="Toggle sidebar">
            <i class="mdi mdi-menu"></i>
        </button>

        {{-- LOGO BRAND (muncul di HP/iPad saja) --}}
        @auth
            @if (Auth::user()->role == 'kepala')
                <a class="navbar-mobile-brand" href="{{ route('kepala') }}">
            @else
                <a class="navbar-mobile-brand" href="{{ route('petugas.dashboard') }}">
            @endif
        @else
            <a class="navbar-mobile-brand" href="{{ route('login') }}">
        @endauth
            <div class="mobile-brand-icon">
                <img src="{{ asset('assetsbackend/images/buku2.png') }}" alt="logo" />
            </div>
            <span class="mobile-brand-name">Perpustakaan</span>
        </a>

        {{-- RIGHT NAV --}}
        <ul class="navbar-nav navbar-nav-right ml-lg-auto">

            {{-- 🔔 NOTIF --}}
            <li class="nav-item nav-notif dropdown">

                @php
                    use App\Models\Peminjaman;

                    $notifs = Peminjaman::whereIn('status', [
                        Peminjaman::STATUS_MENUNGGU,
                        Peminjaman::STATUS_PENGAJUAN
                    ])->latest()->take(5)->get();

                    $notifCount = Peminjaman::whereIn('status', [
                        Peminjaman::STATUS_MENUNGGU,
                        Peminjaman::STATUS_PENGAJUAN
                    ])->count();
                @endphp

                <a class="nav-link position-relative" href="#" id="notifBtn">
                    <i class="mdi mdi-bell-outline mdi-24px"></i>

                    @if($notifCount > 0)
                        <span class="notif-badge">
                            {{ $notifCount }}
                        </span>
                    @endif
                </a>

                <div class="dropdown-menu" id="notifMenu">
                    <div class="dropdown-header p-3 fw-bold">
                        🔔 Notifikasi
                    </div>

                    @forelse($notifs as $item)
                        <a href="{{ route('peminjaman.index') }}" class="dropdown-item">
                            <span class="title">
                                {{ $item->anggota->nama_anggota ?? 'User' }}
                            </span>
                            <span class="subtitle">
                                @if($item->status == \App\Models\Peminjaman::STATUS_MENUNGGU)
                                    📥 Peminjaman:
                                @elseif($item->status == \App\Models\Peminjaman::STATUS_PENGAJUAN)
                                    🔁 Pengembalian:
                                @endif
                                {{ $item->buku->judul_buku ?? '-' }}
                            </span>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}
                            </small>
                        </a>
                        <div class="dropdown-divider-custom"></div>
                    @empty
                        <div class="dropdown-item text-center text-muted">
                            Tidak ada notifikasi
                        </div>
                    @endforelse
                </div>
            </li>

            {{-- 👤 PROFILE --}}
            <li class="nav-item nav-profile dropdown">
                @auth
                <a class="nav-link" href="#" id="profileBtn">
                    <img src="{{ asset('assetsbackend/images/faces/face1.jpg') }}" alt="Profile" />
                    <span>{{ Auth::user()->username }}</span>
                </a>

                <div class="dropdown-menu" id="profileMenu">
                    {{-- PROFILE HEADER --}}
                    <div class="profile-header">
                        <img src="{{ asset('assetsbackend/images/faces/face1.jpg') }}" alt="Profile" />
                        <div class="profile-info">
                            <span class="profile-name">{{ Auth::user()->username }}</span>
                            <span class="profile-role">
                                {{ Auth::user()->role == 'kepala' ? 'Kepala Perpustakaan' : 'Petugas' }}
                            </span>
                        </div>
                    </div>

                    {{-- LOGOUT BUTTON --}}
                    <div class="logout-section">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="mdi mdi-logout"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @endauth
            </li>

        </ul>
    </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const notifBtn = document.getElementById("notifBtn");
    const notifMenu = document.getElementById("notifMenu");

    const profileBtn = document.getElementById("profileBtn");
    const profileMenu = document.getElementById("profileMenu");

    notifBtn.addEventListener("click", function(e) {
        e.preventDefault();
        notifMenu.classList.toggle("show");
        profileMenu.classList.remove("show");
    });

    profileBtn.addEventListener("click", function(e) {
        e.preventDefault();
        profileMenu.classList.toggle("show");
        notifMenu.classList.remove("show");
    });

    document.addEventListener("click", function(e) {
        if (!e.target.closest(".nav-notif")) {
            notifMenu.classList.remove("show");
        }
        if (!e.target.closest(".nav-profile")) {
            profileMenu.classList.remove("show");
        }
    });

});
</script>
