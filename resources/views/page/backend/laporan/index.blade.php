@extends('partials.backend.app')

@section('content')
    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Laporan</h3>
            <a href="{{ route('laporan.pdf') }}" class="btn btn-primary">
                <i class="mdi mdi-printer"></i> Cetak Pdf
            </a>
        </div>

        {{-- CARD --}}
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="tablePetugas" class="table table-hover align-middle">

                        {{-- HEADER --}}
                        <thead class="table-dark">
                            <tr>
                                <th width="50">No</th>
                                <th>Nama</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        {{-- BODY --}}
                        <tbody>
                            @foreach ($data as $item)
                                @php
                                    $status = 'Dipinjam';
                                    $color = 'warning';

                                    $today = \Carbon\Carbon::now()->startOfDay();
                                    $batas = \Carbon\Carbon::parse($item->batas_kembali)->startOfDay();

                                    if ($item->tanggal_kembali) {
                                        $kembali = \Carbon\Carbon::parse($item->tanggal_kembali)->startOfDay();

                                        if ($kembali->gt($batas)) {
                                            $status = 'Terlambat';
                                            $color = 'danger';
                                        } else {
                                            $status = 'Dikembalikan';
                                            $color = 'success';
                                        }
                                    } elseif ($today->gt($batas)) {
                                        $status = 'Terlambat';
                                        $color = 'danger';
                                    }
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->anggota->nama_anggota ?? '-' }}</td>
                                    <td>{{ $item->buku->judul_buku ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                                    <td>
                                        {{ $item->tanggal_kembali
                                            ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y')
                                            : '-'
                                        }}
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $color }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
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
