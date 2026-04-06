<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Breeze Admin</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assetsbackend/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsbackend/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsbackend/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsbackend/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assetsbackend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsbackend/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assetsbackend/images/favicon.png') }}">

    <style>
        /* ===== SIDEBAR - FIXED & NO SCROLL ===== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            overflow: hidden;
            z-index: 1000;
        }

        .sidebar .nav {
            overflow-y: auto;
            overflow-x: hidden;
            max-height: calc(100vh - 120px);
        }

        /* Hilangkan scrollbar sidebar */
        .sidebar .nav::-webkit-scrollbar {
            display: none;
        }

        /* ===== PAGE BODY WRAPPER ===== */
        .page-body-wrapper {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== MAIN PANEL ===== */
        .main-panel {
            width: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* ===== CONTENT WRAPPER - FULL WIDTH ===== */
        .content-wrapper {
            width: 100%;
            padding: 1.5rem;
            flex: 1;
        }

        /* ===== ROW - FULL WIDTH ===== */
        .row {
            margin-left: 0;
            margin-right: 0;
            width: 100%;
        }

        .row > [class*="col-"] {
            padding-left: 12px;
            padding-right: 12px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .sidebar {
                margin-left: -260px;
            }
            .page-body-wrapper {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">

        {{-- SIDEBAR --}}
        @include('partials.backend.sidebar')

        <div class="page-body-wrapper">

            {{-- NAVBAR --}}
            @include('partials.backend.navbar')

            {{-- MAIN PANEL --}}
            <div class="main-panel">

                {{-- CONTENT --}}
                <div class="content-wrapper">
                    @yield('content')
                </div>

                {{-- FOOTER --}}
                @include('partials.backend.footer')

            </div>

        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('assetsbackend/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assetsbackend/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assetsbackend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assetsbackend/vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assetsbackend/vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assetsbackend/vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('assetsbackend/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('assetsbackend/vendors/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assetsbackend/vendors/flot/jquery.flot.pie.js') }}"></script>

    <script src="{{ asset('assetsbackend/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assetsbackend/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assetsbackend/js/misc.js') }}"></script>
    <script src="{{ asset('assetsbackend/js/dashboard.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const trigger = document.getElementById("profileDropdown");
            const dropdown = trigger.nextElementSibling;

            trigger.addEventListener("click", function(e) {
                e.preventDefault();
                dropdown.classList.toggle("show");
            });

            document.addEventListener("click", function(e) {
                if (!e.target.closest(".nav-profile")) {
                    dropdown.classList.remove("show");
                }
            });

        });
    </script>

</body>

</html>
