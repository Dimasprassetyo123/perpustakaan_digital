@extends('partials.backend.app')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- HEADER SECTION --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1 fw-bold text-primary">
                <i class="bi bi-book-half me-2"></i>Data Peminjaman
            </h4>
            <p class="text-muted mb-0">Kelola semua peminjaman buku di perpustakaan</p>
        </div>
        <div class="text-muted">
            <i class="bi bi-calendar3 me-1"></i> {{ now()->format('d F Y') }}
        </div>
    </div>

    {{-- ALERT SECTION --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-gradient-primary text-white rounded-top-4 py-3 px-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-table me-2"></i>Daftar Peminjaman Aktif
                    </h5>
                </div>
                <div class="col-auto">
                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                        <i class="bi bi-files me-1"></i> Total: {{ $data->total() }} Data
                    </span>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-dark">
                            <th class="ps-4 py-3" width="50">No</th>
                            <th width="80">Foto</th>
                            <th>Nama Anggota</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Batas Kembali</th>
                            <th>Status</th>
                            <th class="pe-4" width="280">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($data as $item)
                        <tr class="border-bottom">
                            <td class="ps-4 fw-semibold text-muted">
                                {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                            </td>

                            <td>
                                @if($item->anggota && $item->anggota->image)
                                    <img src="{{ asset('uploads/anggota/'.$item->anggota->image) }}"
                                        width="45" height="45"
                                        class="rounded-circle border border-2 border-primary object-fit-cover"
                                        style="object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-secondary bg-gradient d-flex align-items-center justify-content-center text-white"
                                        style="width: 45px; height: 45px;">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                @endif
                            </td>

                            <td class="fw-semibold">
                                {{ $item->anggota->nama_anggota ?? '-' }}
                            </td>

                            <td>
                                <span class="badge bg-info bg-opacity-10 text-dark px-3 py-2 rounded-pill">
                                    <i class="bi bi-book me-1"></i>
                                    {{ $item->buku->judul_buku ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <small class="text-muted d-block">
                                    <i class="bi bi-calendar-plus me-1"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}
                                </small>
                            </td>

                            <td>
                                <small class="{{ \Carbon\Carbon::parse($item->wajib_kembali)->isPast() ? 'text-danger fw-bold' : 'text-muted' }} d-block">
                                    <i class="bi bi-calendar-exclamation me-1"></i>
                                    {{ \Carbon\Carbon::parse($item->wajib_kembali)->format('d-m-Y') }}
                                    @if(\Carbon\Carbon::parse($item->wajib_kembali)->isPast() && $item->status == 'dipinjam')
                                        <span class="badge bg-danger ms-1">Terlambat</span>
                                    @endif
                                </small>
                            </td>

                            <td>
                                @php
                                    $statusBadge = [
                                        'menunggu' => ['bg-warning', 'clock-history', 'Menunggu'],
                                        'dipinjam' => ['bg-success', 'check-circle', 'Dipinjam'],
                                        'ditolak' => ['bg-danger', 'x-circle', 'Ditolak'],
                                        'dikembalikan' => ['bg-info', 'arrow-return-left', 'Dikembalikan']
                                    ];
                                    $badge = $statusBadge[$item->status] ?? ['bg-secondary', 'question-circle', ucfirst($item->status)];
                                @endphp
                                <span class="badge {{ $badge[0] }} rounded-pill px-3 py-2">
                                    <i class="bi bi-{{ $badge[1] }} me-1"></i>
                                    {{ $badge[2] }}
                                </span>
                            </td>

                            <td class="pe-4">
                                <div class="btn-group btn-group-sm" role="group">
                                    @if($item->status == 'menunggu')
                                        <form action="{{ route('peminjaman.terima', $item->id_peminjaman) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" title="Terima">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tolakModal{{ $item->id_peminjaman }}" title="Tolak">
                                            <i class="bi bi-x-lg"></i>
                                        </button>

                                        <!-- Modal Tolak -->
                                        <div class="modal fade" id="tolakModal{{ $item->id_peminjaman }}" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <form action="{{ route('peminjaman.tolak', $item->id_peminjaman) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-content rounded-3">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title">
                                                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                                                Konfirmasi Penolakan
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="mb-3">Anda akan menolak peminjaman dari:</p>
                                                            <div class="alert alert-light border">
                                                                <strong>{{ $item->anggota->nama_anggota ?? 'Anggota' }}</strong><br>
                                                                <small>Buku: {{ $item->buku->judul_buku ?? '-' }}</small>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label fw-semibold">Alasan Penolakan:</label>
                                                                <textarea name="alasan" class="form-control" rows="3" required placeholder="Masukkan alasan penolakan..."></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                <i class="bi bi-arrow-left me-1"></i>Batal
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="bi bi-x-circle me-1"></i>Tolak
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif

                                    <form action="{{ route('peminjaman.destroy', $item->id_peminjaman) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" data-bs-toggle="tooltip" title="Hapus">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox display-1 d-block mb-3"></i>
                                    <h5>Tidak ada data peminjaman</h5>
                                    <p class="mb-0">Belum ada peminjaman yang tercatat</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="d-flex justify-content-between align-items-center p-3 bg-light border-top">
                <div class="text-muted small">
                    <i class="bi bi-info-circle me-1"></i>
                    Menampilkan {{ $data->firstItem() ?? 0 }} - {{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} data
                </div>
                <div>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.2s ease;
    }

    .btn-group .btn {
        border-radius: 6px;
        margin: 0 2px;
    }

    .btn-group .btn:hover {
        transform: translateY(-1px);
        transition: transform 0.1s ease;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .rounded-top-4 {
        border-top-left-radius: 1rem !important;
        border-top-right-radius: 1rem !important;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    .badge {
        font-weight: 500;
    }

    .modal-content {
        border: none;
    }
</style>

<script>
    // Aktifkan tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endsection
