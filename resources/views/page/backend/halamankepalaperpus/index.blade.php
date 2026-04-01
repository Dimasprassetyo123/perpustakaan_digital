@extends('partials.backend.app')
@section('content')
    <div class="content-wrapper pb-0" style="flex: 1;">
        <div class="page-header flex-wrap">
            <h3 class="mb-0"> Hi, selamat datang ! <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Di web admin
                    dashboard Kepala Perpustakaan.</span>
            </h3>
            <div class="d-flex">
                <button type="button" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="mdi mdi-email btn-icon-prepend"></i> Email </button>
                <button type="button" class="btn btn-sm bg-white btn-icon-text border ml-3">
                    <i class="mdi mdi-printer btn-icon-prepend"></i> Print </button>
                <button type="button" class="btn btn-sm ml-3 btn-success"> Add User </button>
            </div>
        </div>

        <!-- CARDS SECTION - DISPLAYED IN A ROW (LEFT TO RIGHT) -->
        <div class="row">
            <div class="col-xl-3 col-md-6 stretch-card grid-margin">
                <div class="card bg-warning">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 color-card-head">Total Petugas</p>
                                <h2 class="text-white"> $8,753.<span class="h5">00</span>
                                </h2>
                            </div>
                            <<i class="card-icon-indicator mdi mdi-account-circle bg-inverse-icon-success"></i>
                        </div>
                        <h6 class="text-white">18.33% Since last month</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 stretch-card grid-margin">
                <div class="card bg-danger">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 color-card-head">Total Anggota</p>
                                <h2 class="text-white"> $5,300.<span class="h5">00</span>
                                </h2>
                            </div>
                            <i class="card-icon-indicator mdi mdi-cube-outline bg-inverse-icon-danger"></i>
                        </div>
                        <h6 class="text-white">13.21% Since last month</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 stretch-card grid-margin">
                <div class="card bg-primary">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 color-card-head">Total Buku</p>
                                <h2 class="text-white"> $1,753.<span class="h5">00</span>
                                </h2>
                            </div>
                            <i class="card-icon-indicator mdi mdi-book-open-page-variant bg-inverse-icon-primary"></i>
                        </div>
                        <h6 class="text-white">67.98% Since last month</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 stretch-card grid-margin">
                <div class="card bg-success">
                    <div class="card-body px-3 py-4">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="color-card">
                                <p class="mb-0 color-card-head">Total Peminjaman</p>
                                <h2 class="text-white">2368</h2>
                            </div>
                            <i class="card-icon-indicator mdi mdi-clipboard-list bg-inverse-icon-success"></i>
                        </div>
                        <h6 class="text-white">20.32% Since last month</h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF CARDS SECTION -->

        <!-- TABLE PEMINJAMAN SECTION -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Peminjaman Hari Ini</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Anggota</th>
                                        <th>Nama Anggota</th>
                                        <th>Judul Buku</th>
                                        <th>Tgl Kembali</th>
                                        <th>Tgl Peminjaman</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Herman Beck</td>
                                        <td>Anak Kampung</td>
                                        <td>Maret 18, 2025</td>
                                        <td>Maret 15, 2025</td>
                                        <td>Maret 15, 2025</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1" onclick="editData(this)">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteData(this)">
                                                <i class="mdi mdi-delete"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination Info -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted small">
                                Showing 1 to 1 entries
                            </div>
                            <nav>
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function editData(btn) {
        let row = btn.closest('tr');
        let cells = row.cells;
        let anggota = cells[0].innerText;
        let namaAnggota = cells[1].innerText;
        let judulBuku = cells[2].innerText;
        let tglKembali = cells[3].innerText;
        let tglPeminjaman = cells[4].innerText;

        alert('Edit data: ' + namaAnggota + ' - ' + judulBuku);
        // Di sini Anda bisa menambahkan modal edit atau redirect ke halaman edit
    }

    function deleteData(btn) {
        if(confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            let row = btn.closest('tr');
            row.remove();
            // Update showing entries info
            let tbody = document.querySelector('tbody');
            let rowCount = tbody.rows.length;
            let showingInfo = document.querySelector('.text-muted.small');
            if(showingInfo) {
                showingInfo.innerText = 'Showing 1 to ' + rowCount + ' entries';
            }
            // Jika tidak ada data, tampilkan pesan
            if(rowCount === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>';
            }
        }
    }
</script>
@endpush
