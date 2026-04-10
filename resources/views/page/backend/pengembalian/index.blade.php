@extends('partials.backend.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">📦 Data Pengembalian Buku</h3>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table id="tablePengembalian" class="table table-hover align-middle">

                    {{-- HEADER --}}
                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th>Buku</th>
                            <th>Anggota</th>
                            <th>Tgl Pinjam</th>
                            <th>Batas Kembali</th>
                            <th>Tgl Kembali</th> {{-- 🔥 BARU --}}
                            <th>Status</th>
                            <th>Denda</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    {{-- BODY --}}
                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $item->buku->judul_buku }}</strong>
                            </td>

                            <td>{{ $item->anggota->nama_anggota }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->wajib_kembali)->format('d-m-Y') }}
                            </td>

                            {{-- 🔥 TANGGAL KEMBALI --}}
                            <td>
                                @if($item->tanggal_kembali)
                                    <span class="text-success fw-bold">
                                        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if($item->status == 'pengajuan_kembali')
                                    <span class="badge bg-warning">📩 Menunggu</span>
                                @elseif($item->status == 'dikembalikan')
                                    <span class="badge bg-success">✅ Selesai</span>
                                @elseif($item->status == 'terlambat')
                                    <span class="badge bg-danger">⏰ Terlambat</span>
                                @endif
                            </td>

                            {{-- DENDA --}}
                            <td>
                                @if($item->denda > 0)
                                    <span class="text-danger fw-bold">
                                        Rp{{ number_format($item->denda,0,',','.') }}
                                    </span>
                                @else
                                    <span class="text-success">-</span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td>

                                {{-- KONFIRMASI --}}
                                @if($item->status == 'pengajuan_kembali')
                                    @php
                                        $now = now()->startOfDay();
                                        $wajibKembali = \Carbon\Carbon::parse($item->wajib_kembali)->startOfDay();
                                        $isLate = $now->gt($wajibKembali);
                                        $hariTelat = $isLate ? abs($now->diffInDays($wajibKembali)) : 0;
                                        $estimasiDenda = $hariTelat * 2000;
                                    @endphp
                                    <form action="{{ route('pengembalian.konfirmasi', $item->id_peminjaman) }}" method="POST" class="d-inline form-konfirmasi">
                                        @csrf
                                        <button type="button" class="btn btn-sm btn-success btn-konfirmasi"
                                                data-late="{{ $isLate ? 'true' : 'false' }}" 
                                                data-hari="{{ $hariTelat }}" 
                                                data-denda="{{ $estimasiDenda }}">
                                            <i class="mdi mdi-check"></i>
                                        </button>
                                    </form>
                                @endif

                                {{-- DELETE --}}
                                @if(in_array($item->status, ['dikembalikan','terlambat']))
                                    <form action="{{ route('pengembalian.destroy', $item->id_peminjaman) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                @endif

                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                📭 Tidak ada data pengembalian
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
    $('#tablePengembalian').DataTable({
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

    // 🔹 SweetAlert Konfirmasi Denda
    $('.btn-konfirmasi').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var isLate = $(this).data('late') === true || $(this).data('late') === 'true';
        var hariTelat = $(this).data('hari');
        var denda = $(this).data('denda');

        if (isLate) {
            Swal.fire({
                title: 'Buku Terlambat!',
                html: "Keterlambatan: <b>" + hariTelat + " hari</b><br>Denda: <b style='color:red;'>Rp " + denda.toLocaleString('id-ID') + "</b><br><br>Konfirmasi penerimaan pembayaran denda ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Terima Denda',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        } else {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Terima/selesaikan pengembalian buku ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Selesaikan'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@endsection
