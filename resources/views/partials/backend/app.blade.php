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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assetsbackend/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assetsbackend/images/favicon.png') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">



    <style>
        /* ============================================================
           GOOGLE FONTS
        ============================================================ */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * { font-family: 'Inter', sans-serif; }

        /* ============================================================
           SIDEBAR — MODERN ELEGANT CREAM
        ============================================================ */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            z-index: 1100;
            display: flex;
            flex-direction: column;
            background: linear-gradient(160deg, #ffffff 0%, #fdf9f1 50%, #faf3e8 100%);
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.35s ease;
            overflow: hidden;
        }

        /* Decorative gradient orb */
        .sidebar::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 240px;
            height: 240px;
            background: radial-gradient(circle, rgba(218,190,150,0.25) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .sidebar::after {
            content: '';
            position: absolute;
            bottom: 60px;
            left: -60px;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(168,133,95,0.15) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* ---- HEADER ---- */
        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 18px 16px;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            flex-shrink: 0;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 11px;
            text-decoration: none;
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #dabe96, #a8855f);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(168,133,95,0.3);
            flex-shrink: 0;
            overflow: hidden;
        }

        .sidebar-brand-icon img {
            width: 26px;
            height: 26px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
        }

        .brand-name {
            font-size: 15px;
            font-weight: 800;
            color: #4a3f35;
            letter-spacing: 0.3px;
            line-height: 1.2;
        }

        .brand-sub {
            font-size: 10px;
            font-weight: 500;
            color: rgba(74,63,53,0.7);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 1px;
        }

        /* Close button — mobile only */
        .sidebar-close-btn {
            display: none;
            background: rgba(0,0,0,0.04);
            border: none;
            color: rgba(74,63,53,0.6);
            width: 32px;
            height: 32px;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, color 0.2s;
            flex-shrink: 0;
        }
        .sidebar-close-btn:hover {
            background: rgba(0,0,0,0.08);
            color: #4a3f35;
        }

        /* ---- PROFILE ---- */
        .sidebar-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 18px;
            margin: 12px 14px;
            border-radius: 14px;
            background: rgba(0,0,0,0.02);
            border: 1px solid rgba(0,0,0,0.05);
            backdrop-filter: blur(4px);
            flex-shrink: 0;
        }

        .sidebar-profile-avatar {
            position: relative;
            flex-shrink: 0;
        }

        .sidebar-profile-avatar img {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid rgba(218,190,150,0.6);
        }

        .avatar-status {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            border: 2px solid #fdf9f1;
        }
        .avatar-status.online { background: #10b981; }

        .sidebar-profile-info {
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .sidebar-profile-info .profile-name {
            font-size: 13.5px;
            font-weight: 700;
            color: #4a3f35;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-profile-info .profile-role {
            font-size: 11px;
            color: rgba(74,63,53,0.7);
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar-profile-info .profile-role i {
            font-size: 11px;
            margin-right: 3px;
        }

        /* ---- NAV WRAPPER (scrollable) ---- */
        .sidebar-nav-wrapper {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 6px 10px 10px;
        }

        .sidebar-nav-wrapper::-webkit-scrollbar { width: 4px; }
        .sidebar-nav-wrapper::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav-wrapper::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.08);
            border-radius: 4px;
        }

        /* ---- SECTION LABEL ---- */
        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-section-label {
            padding: 14px 10px 6px;
        }
        .nav-section-label span {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: rgba(74,63,53,0.5);
        }

        /* ---- NAV ITEM ---- */
        .sidebar-nav-item {
            margin-bottom: 2px;
        }

        .sidebar-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            text-decoration: none;
            color: #8b7355;
            font-size: 13.5px;
            font-weight: 600;
            position: relative;
            transition: background 0.2s ease, color 0.2s ease, transform 0.15s ease;
        }

        .sidebar-nav-link:hover {
            background: rgba(218,190,150,0.15);
            color: #4a3f35;
            transform: translateX(2px);
        }

        .sidebar-nav-item.active .sidebar-nav-link {
            background: linear-gradient(135deg, rgba(218,190,150,0.3), rgba(168,133,95,0.15));
            color: #4a3f35;
            border: 1px solid rgba(218,190,150,0.5);
            box-shadow: 0 4px 15px rgba(168,133,95,0.15);
        }

        /* Icon wrapper */
        .nav-icon-wrapper {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.04);
            transition: background 0.2s, box-shadow 0.2s;
            flex-shrink: 0;
        }

        .nav-icon-wrapper i {
            font-size: 17px;
        }

        .sidebar-nav-item.active .nav-icon-wrapper {
            background: linear-gradient(135deg, #dabe96, #a8855f);
            box-shadow: 0 4px 12px rgba(168,133,95,0.3);
            color: #fff;
        }

        .sidebar-nav-link:hover .nav-icon-wrapper {
            background: rgba(218,190,150,0.3);
            color: #4a3f35;
        }

        /* Active dot */
        .nav-active-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #dabe96;
            margin-left: auto;
            box-shadow: 0 0 6px rgba(218,190,150,0.8);
            flex-shrink: 0;
        }

        /* ---- SIDEBAR FOOTER ---- */
        .sidebar-footer {
            padding: 12px 14px 18px;
            border-top: 1px solid rgba(0,0,0,0.06);
            flex-shrink: 0;
        }

        .sidebar-logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border: 1px solid rgba(239,68,68,0.35);
            background: rgba(239,68,68,0.1);
            color: #f87171;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, color 0.2s, border-color 0.2s;
        }
        .sidebar-logout-btn:hover {
            background: rgba(239,68,68,0.22);
            color: #fca5a5;
            border-color: rgba(239,68,68,0.6);
        }
        .sidebar-logout-btn i { font-size: 16px; }

        /* ============================================================
           OVERLAY (mobile/tablet)
        ============================================================ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(2px);
            z-index: 1050;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .sidebar-overlay.active {
            display: block;
            opacity: 1;
        }

        /* ============================================================
           PAGE BODY WRAPPER
        ============================================================ */
        .page-body-wrapper {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                        width 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .main-panel {
            width: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            width: 100%;
            padding: 1.5rem;
            flex: 1;
        }

        .row {
            margin-left: 0;
            margin-right: 0;
            width: 100%;
        }
        .row>[class*="col-"] {
            padding-left: 12px;
            padding-right: 12px;
        }

        /* ============================================================
           RESPONSIVE — iPad (768px – 1024px)
        ============================================================ */
        @media (max-width: 1024px) and (min-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1100;
            }
            .sidebar.sidebar-open {
                transform: translateX(0);
                box-shadow: 6px 0 40px rgba(0,0,0,0.5);
            }
            .sidebar-close-btn {
                display: flex !important;
            }
            .page-body-wrapper {
                margin-left: 0;
                width: 100%;
            }
        }

        /* ============================================================
           RESPONSIVE — Mobile (< 768px)
        ============================================================ */
        @media (max-width: 767px) {
            .sidebar {
                width: 270px;
                transform: translateX(-100%);
                z-index: 1100;
            }
            .sidebar.sidebar-open {
                transform: translateX(0);
                box-shadow: 6px 0 40px rgba(0,0,0,0.5);
            }
            .sidebar-close-btn {
                display: flex !important;
            }
            .page-body-wrapper {
                margin-left: 0;
                width: 100%;
            }
            .content-wrapper {
                padding: 1rem;
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const sidebar       = document.getElementById("sidebar");
            const overlay       = document.getElementById("sidebarOverlay");
            const closeBtn      = document.getElementById("sidebarCloseBtn");

            // Toggle sidebar (called by navbar hamburger)
            function openSidebar() {
                sidebar.classList.add("sidebar-open");
                overlay.classList.add("active");
                document.body.style.overflow = "hidden";
            }

            function closeSidebar() {
                sidebar.classList.remove("sidebar-open");
                overlay.classList.remove("active");
                document.body.style.overflow = "";
            }

            // Close button inside sidebar
            if (closeBtn) {
                closeBtn.addEventListener("click", closeSidebar);
            }

            // Overlay click closes sidebar
            if (overlay) {
                overlay.addEventListener("click", closeSidebar);
            }

            // Expose toggle globally so navbar toggle button can call it
            window.toggleSidebar = function() {
                if (sidebar.classList.contains("sidebar-open")) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            };

        });
    </script>
    @stack('scripts')
</body>

</html>
