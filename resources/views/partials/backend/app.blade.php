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
    <link rel="stylesheet" href="{{ asset('assetsbackend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsbackend/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assetsbackend/images/favicon.png') }}">
</head>

<body>
    <div class="container-scroller">

        {{-- SIDEBAR --}}
        @include('partials.backend.sidebar')

        <div class="container-fluid page-body-wrapper">

            {{-- NAVBAR --}}
            @include('partials.backend.navbar')

            {{-- MAIN PANEL --}}
            <div class="main-panel">

                {{-- CONTENT (WAJIB ADA) --}}
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

</body>

</html>


