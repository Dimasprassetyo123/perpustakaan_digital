@extends('partials.backend.app')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Detail Petugas</h3>
            <small class="text-muted">Informasi lengkap data petugas</small>
        </div>

        <a href="{{ route('petugas.index') }}" class="btn btn-secondary">
            <i class="mdi mdi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">

        {{-- PROFILE --}}
        <div class="col-md-4">
            <div class="card shadow border-0 rounded-4 text-center p-4">

                <img src="{{ asset('assetsbackend/images/faces/face1.jpg') }}"
                     class="rounded-circle mb-3"
                     width="120" height="120">

                <h5 class="fw-bold">{{ $data->nama_petugas }}</h5>

                <span class="badge bg-primary mb-2">
                    {{ $data->jenis_kelamin }}
                </span>

                <p class="text-muted mb-1">{{ $data->email }}</p>

                {{-- USERNAME --}}
                <p class="text-dark fw-semibold">
                    {{ $data->user->username ?? '-' }}
                </p>

            </div>
        </div>

        {{-- DETAIL --}}
        <div class="col-md-8">
            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-info text-white rounded-top-4">
                    <h5 class="mb-0">Informasi Lengkap</h5>
                </div>

                <div class="card-body">

                    {{-- NAMA --}}
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold">Nama Lengkap</div>
                        <div class="col-md-8">: {{ $data->nama_petugas }}</div>
                    </div>

                    {{-- USERNAME --}}
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold">Username</div>
                        <div class="col-md-8">
                            : {{ $data->user->username ?? '-' }}
                        </div>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold">Password</div>
                        <div class="col-md-8">
                            : ********
                            <small class="text-muted">(Disembunyikan demi keamanan)</small>
                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold">Email</div>
                        <div class="col-md-8">: {{ $data->email }}</div>
                    </div>

                    {{-- JK --}}
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold">Jenis Kelamin</div>
                        <div class="col-md-8">
                            :
                            <span class="badge bg-info text-dark">
                                {{ $data->jenis_kelamin }}
                            </span>
                        </div>
                    </div>

                    {{-- TANGGAL LAHIR --}}
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold">Tanggal Lahir</div>
                        <div class="col-md-8">
                            : {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d M Y') }}
                        </div>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold">Alamat</div>
                        <div class="col-md-8">: {{ $data->alamat }}</div>
                    </div>

                    <hr>

                    {{-- ACTION --}}
                    <div class="d-flex gap-2">
                        <a href="{{ route('petugas.edit', $data->id_petugas) }}"
                           class="btn btn-warning">
                            <i class="mdi mdi-pencil"></i> Edit
                        </a>

                        <form action="{{ route('petugas.destroy', $data->id_petugas) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                <i class="mdi mdi-delete"></i> Hapus
                            </button>
                        </form>

                        {{-- OPTIONAL RESET PASSWORD --}}
                        <button class="btn btn-dark">
                            <i class="mdi mdi-lock-reset"></i> Reset Password
                        </button>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
@endsection
