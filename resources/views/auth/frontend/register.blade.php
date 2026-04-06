<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f') no-repeat center center/cover;
        height: 100vh;
        margin: 0;
        position: relative;
    }

    body::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        z-index: 0;
    }

    .login-container {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .login-card {
        background: rgba(255,255,255,0.95);
        padding: 30px;
        border-radius: 15px;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .logo {
        text-align: center;
        font-size: 40px;
    }

    .login-title {
        text-align: center;
        font-weight: bold;
        margin-top: 10px;
    }

    .form-control, .form-select {
        border-radius: 10px;
    }

    .btn-login {
        width: 100%;
        border-radius: 10px;
        background: #2c3e50;
        color: white;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: #1a252f;
    }
    </style>
</head>

<body>

<div class="login-container">
    <div class="login-card">

        <div class="logo">📝</div>
        <h4 class="login-title">Register Anggota</h4>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="alert alert-danger mt-2">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- SUCCESS --}}
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('anggota.register.post') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- NAMA --}}
            <div class="mb-3">
                <input type="text" name="nama_anggota" class="form-control" placeholder="Nama Lengkap" required>
            </div>

            {{-- USERNAME --}}
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            {{-- PASSWORD --}}
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            {{-- JENIS KELAMIN --}}
            <div class="mb-3">
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            {{-- TANGGAL LAHIR --}}
            <div class="mb-3">
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>

            {{-- ALAMAT --}}
            <div class="mb-3">
                <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" required></textarea>
            </div>

            {{-- FOTO --}}
            <div class="mb-3">
                <input type="file" name="image" class="form-control">
                <small class="text-muted">Upload foto (jpg/png, max 2MB)</small>
            </div>

            <button type="submit" class="btn btn-login">Daftar</button>

            <p class="text-center mt-3">
                Sudah punya akun? <a href="{{ route('anggota.login') }}">Login</a>
            </p>
        </form>

    </div>
</div>

</body>
</html>
