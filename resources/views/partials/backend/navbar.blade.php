<style>
.nav-profile {
    position: relative;
}

.nav-profile .dropdown-menu {
    display: none;
    position: absolute;

    top: 60px;
    right: 0;
    left: auto;

    width: 220px;
    padding: 0;

    background: #fff;
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);

    z-index: 9999;
}

.nav-profile .dropdown-menu.show {
    display: block;
}

.user-box {
    padding: 12px 16px;
}

.dropdown-item {
    padding: 10px 16px;
}
</style>

<nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">

        {{-- LOGO MOBILE --}}
        <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="#">
            <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
        </a>

        {{-- TOGGLE --}}
        <button class="navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
            <i class="mdi mdi-menu"></i>
        </button>

        {{-- RIGHT NAV --}}
        <ul class="navbar-nav navbar-nav-right ml-lg-auto">

            {{-- PROFILE --}}
            <li class="nav-item nav-profile dropdown">

                @auth
                <a class="nav-link dropdown-toggle d-flex align-items-center"
                   href="#"
                   id="profileDropdown"
                   data-toggle="dropdown"
                   aria-expanded="false">

                    <img src="{{ asset('assetsbackend/images/faces/face1.jpg') }}"
                         class="rounded-circle mr-2"
                         width="35" height="35" />

                    <span class="font-weight-bold">
                        {{ Auth::user()->username }}
                    </span>
                </a>

                {{-- DROPDOWN --}}
                <div class="dropdown-menu dropdown-menu-right custom-dropdown"
                     aria-labelledby="profileDropdown">

                    {{-- USER INFO --}}
                    <div class="px-3 py-2">
                        <div class="font-weight-bold">
                            {{ Auth::user()->username }}
                        </div>
                        <small class="text-muted">
                            {{ Auth::user()->role == 'kepala'
                                ? 'Kepala Perpustakaan'
                                : 'Petugas Perpustakaan' }}
                        </small>
                    </div>

                    <div class="dropdown-divider"></div>

                    {{-- LOGOUT --}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="dropdown-item text-danger d-flex align-items-center">
                            <i class="mdi mdi-logout mr-2"></i> Logout
                        </button>
                    </form>

                </div>
                @endauth

                @guest
                <a href="{{ route('login') }}" class="nav-link">
                    Login
                </a>
                @endguest

            </li>

        </ul>

        {{-- MOBILE TOGGLE --}}
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
                type="button"
                data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>

    </div>
</nav>
