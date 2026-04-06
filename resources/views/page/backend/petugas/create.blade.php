@extends('partials.backend.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h5 class="mb-0">Tambah Petugas</h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('petugas.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Nama -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Petugas</label>
                                <input type="text" name="nama_petugas" class="form-control" placeholder="Masukkan nama">
                            </div>

                            <!-- Username -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username login">
                            </div>

                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control">
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email">
                            </div>

                            <!-- Alamat -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" rows="3" class="form-control" placeholder="Masukkan alamat lengkap"></textarea>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('petugas.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button class="btn btn-success px-4">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
