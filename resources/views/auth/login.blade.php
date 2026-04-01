<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f') no-repeat center center/cover;
        height: 100vh;
        margin: 0;
        position: relative;
    }

    /* overlay gelap biar tulisan kebaca */
    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 0;
    }

    .login-container {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        padding: 35px;
        border-radius: 15px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        backdrop-filter: blur(5px);
    }

    .logo {
        text-align: center;
        font-size: 45px;
    }

    .login-title {
        text-align: center;
        font-weight: bold;
        margin-top: 10px;
    }

    .login-subtitle {
        text-align: center;
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 10px;
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
        transform: scale(1.02);
    }
</style>
</head>

<body>

<div class="login-container">
    <div class="login-card">

        <div class="logo">📚</div>
        <h4 class="login-title">Perpustakaan Digital</h4>
        <p class="login-subtitle">Login sesuai role</p>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
    @csrf

    <div class="mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username">
    </div>

    <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password">
    </div>

    <div class="mb-3">
        <select name="role" class="form-select">
            <option value="">-- Pilih Role --</option>
            <option value="kepala">Kepala Perpustakaan</option>
            <option value="petugas">Petugas</option>
        </select>
    </div>

    <button type="submit" class="btn btn-login">Login</button>
</form>

    </div>
</div>

</body>
</html>
