<!DOCTYPE html>
<html lang="en">

<head>
    <title>BookSaw - Free Book Store HTML CSS Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('assetsfrontend/css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsfrontend/icomoon/icomoon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsfrontend/css/vendor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assetsfrontend/css/style.css') }}">
    <style>
        .btn-dark:hover {
            transform: translateY(-2px);
            transition: 0.3s;
        }

        img:hover {
            transform: scale(1.03);
            transition: 0.3s;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

    {{-- navbar --}}
    @include('partials.frontend.navbar')

    {{-- content --}}
    @yield('content')

    {{-- footer --}}
    @include('partials.frontend.footer')

    <script src="{{ asset('assetsfrontend/js/jquery-1.11.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assetsfrontend/js/plugins.js') }}"></script>
    <script src="{{ asset('assetsfrontend/js/script.js') }}"></script>
    <script>
document.getElementById('searchBuku').addEventListener('keyup', function() {

    let keyword = this.value.toLowerCase();
    let items = document.querySelectorAll('.buku-item');

    items.forEach(item => {
        let judul = item.getAttribute('data-judul');

        if (judul.includes(keyword)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });

});
</script>

</body>

</html>
