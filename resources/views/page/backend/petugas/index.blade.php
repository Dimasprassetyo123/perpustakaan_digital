@extends('partials.backend.app')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Data Petugas</h3>
        </div>

        <a href="{{ route('petugas.create') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">
            + Tambah Petugas
        </a>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card border-0 shadow rounded-3">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table mb-0 align-middle">

                    {{-- HEADER TABLE --}}
                    <thead style="background-color:#343a40; color:white;">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Petugas</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>

                    {{-- BODY --}}
                    <tbody>
                        @forelse ($data as $index => $d)
                        <tr class="border-bottom">

                            <td class="ps-4">{{ $index + 1 }}</td>

                            <td>
                                <div class="fw-semibold">{{ $d->nama_petugas }}</div>
                                <small class="text-muted">{{ $d->username }}</small>
                            </td>

                            <td>{{ $d->email }}</td>

                            <td>
                                @if($d->jenis_kelamin == 'Laki-laki')
                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                        Laki-laki
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                        Perempuan
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center pe-4">
                                <div class="d-flex justify-content-center gap-2">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('petugas.show', $d->id_petugas) }}"
                                        class="btn btn-sm text-white"
                                        style="background:#3498db;">
                                        <i class="mdi mdi-eye"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('petugas.edit', $d->id_petugas) }}"
                                        class="btn btn-sm text-white"
                                        style="background:#f39c12;">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('petugas.destroy', $d->id_petugas) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm text-white"
                                            style="background:#e84393;">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Data petugas belum tersedia
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection
