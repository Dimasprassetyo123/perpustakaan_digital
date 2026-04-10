@extends('partials.backend.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">💳 Data Denda & Pembayaran</h3>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="mdi mdi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show">
            <i class="mdi mdi-information me-1"></i> {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table id="tableDenda" class="table table-hover align-middle">
                    
                    {{-- HEADER --}}
                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Tagihan Denda</th>
                            <th>Status Pembayaran</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    {{-- BODY --}}
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $item->anggota->nama_anggota ?? 'Unknown' }}</strong>
                            </td>
                            <td>{{ $item->buku->judul_buku ?? 'Buku Tidak Tersedia' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                            <td>{{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') : '-' }}</td>
                            {{-- NOMINAL DENDA & STATUS KEMBALI --}}
                            @php
                                $dendaTampil = $item->denda;
                                $isLive = false;
                                
                                if($dendaTampil == 0 && $item->status == 'dipinjam') {
                                    $now = now()->startOfDay();
                                    $wajib = \Carbon\Carbon::parse($item->wajib_kembali)->startOfDay();
                                    if($now->gt($wajib)) {
                                        $hariTelat = abs($now->diffInDays($wajib));
                                        $dendaTampil = $hariTelat * 2000;
                                        $isLive = true;
                                    }
                                }
                            @endphp

                            <td>
                                <span class="text-danger fw-bold">
                                    Rp {{ number_format($dendaTampil, 0, ',', '.') }}
                                    @if($isLive)
                                        <div style="font-size:10px; color:#a8855f;">(Estimasi Berjalan)</div>
                                    @endif
                                </span>
                            </td>

                            {{-- STATUS PEMBAYARAN --}}
                            <td>
                                @if($item->status_denda == 'lunas')
                                    <span class="badge bg-success">
                                        <i class="mdi mdi-check-decagram me-1"></i> Lunas
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="mdi mdi-alert-circle me-1"></i> Belum Lunas
                                    </span>
                                @endif
                                @if($isLive)
                                    <div style="font-size:10px; margin-top:4px;" class="badge bg-warning text-dark">
                                        Buku Belum Dikembalikan
                                    </div>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                @if($item->status_denda !== 'lunas')
                                    @if($isLive)
                                       <span class="text-muted" style="font-size: 11px;">
                                            Tunggu buku dikembalikan
                                       </span>
                                    @else
                                        <form action="{{ route('denda.lunasi', $item->id_peminjaman) }}" method="POST" class="form-lunasi">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-success btn-lunasi">
                                                <i class="mdi mdi-cash-check me-1"></i> Verifikasi Lunas
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <span class="text-muted"><i class="mdi mdi-check"></i> Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

{{-- DATATABLE & SWEETALERT --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#tableDenda').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        ordering: true,
        searching: true,
        paging: true,
        info: true,
        language: {
            search: "🔍 Cari Anggota/Buku:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ tagihan",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "→",
                previous: "←"
            },
            zeroRecords: "Data tidak ditemukan"
        }
    });

    // Validasi Confirm
    $('.btn-lunasi').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        
        Swal.fire({
            title: 'Verifikasi Pembayaran?',
            text: "Pastikan anggota telah membayar nominal denda secara tunai. Proses ini tidak dapat dibatalkan.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Tandai Lunas',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush
@endsection
