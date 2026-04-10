@extends('partials.backend.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">👨‍💼 Data Petugas</h3>
        <a href="{{ route('petugas.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus"></i> Tambah Petugas
        </a>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table id="tablePetugas" class="table table-hover align-middle">

                    {{-- HEADER --}}
                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Petugas</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    {{-- BODY --}}
                    <tbody>
                        @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $item->nama_petugas }}</strong><br>
                                <small class="text-muted">
                                    {{ $item->user->username ?? '-' }}
                                </small>
                            </td>

                            <td>{{ $item->email }}</td>

                            <td>
                                @if($item->jenis_kelamin == 'Laki-laki')
                                    <span class="badge bg-info text-dark">Laki-laki</span>
                                @else
                                    <span class="badge bg-danger">Perempuan</span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <a href="{{ route('petugas.show', $item->id_petugas) }}"
                                    class="btn btn-sm btn-info">
                                    <i class="mdi mdi-eye"></i>
                                </a>

                                <a href="{{ route('petugas.edit', $item->id_petugas) }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="mdi mdi-pencil"></i>
                                </a>

                                <form action="{{ route('petugas.destroy', $item->id_petugas) }}"
                                    method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data?')"
                                        class="btn btn-sm btn-danger">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                📭 Data petugas masih kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

{{-- 🔥 DATATABLE SCRIPT --}}
@push('scripts')
<script>
$(document).ready(function() {
    $('#tablePetugas').DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50],
        ordering: true,
        searching: true,
        paging: true,
        info: true,
        language: {
            search: "🔍 Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "→",
                previous: "←"
            },
            zeroRecords: "Data tidak ditemukan"
        }
    });
});
</script>
@endpush

@endsection
