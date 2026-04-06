@extends('partials.backend.app')

@section('content')
<style>
    .card-custom {
        border: none;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        transition: 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 2px rgba(79,70,229,0.1);
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 6px;
    }

    .btn-primary {
        background: #4f46e5;
        border: none;
        border-radius: 10px;
        padding: 8px 18px;
    }

    .btn-primary:hover {
        background: #4338ca;
    }

    .btn-light {
        border-radius: 10px;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card card-custom">

                {{-- HEADER --}}
                <div class="card-body pb-0">
                    <h5 class="fw-semibold mb-1">Edit Petugas</h5>
                    <small class="text-muted">Update informasi petugas</small>
                </div>

                <div class="card-body pt-3">
                    <form action="{{ route('petugas.update',$data->id_petugas) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Petugas</label>
                            <input type="text" name="nama_petugas"
                                value="{{ old('nama_petugas', $data->nama_petugas) }}"
                                class="form-control">
                        </div>

                        {{-- Grid --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="Laki-laki" {{ $data->jenis_kelamin=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $data->jenis_kelamin=='Perempuan'?'selected':'' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir"
                                    value="{{ $data->tanggal_lahir }}"
                                    class="form-control">
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                value="{{ $data->email }}"
                                class="form-control">
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-4">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" rows="3" class="form-control">{{ $data->alamat }}</textarea>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('petugas.index') }}" class="btn btn-light">
                                Batal
                            </a>
                            <button class="btn btn-primary">
                                Update
                            </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
