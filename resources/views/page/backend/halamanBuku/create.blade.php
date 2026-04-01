@extends('partials.backend.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">➕ Tambah Buku</h3>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">
            <i class="mdi mdi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Ada kesalahan:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- JUDUL --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="judul_buku"
                               value="{{ old('judul_buku') }}"
                               class="form-control"
                               placeholder="Masukkan judul buku">
                    </div>

                    {{-- PENULIS --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="penulis"
                               value="{{ old('penulis') }}"
                               class="form-control"
                               placeholder="Nama penulis">
                    </div>

                    {{-- TAHUN --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="date" name="tahun_terbit"
                               value="{{ old('tahun_terbit') }}"
                               class="form-control">
                    </div>

                    {{-- STOK --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stok"
                               value="{{ old('stok') }}"
                               class="form-control"
                               placeholder="Jumlah stok">
                    </div>

                    {{-- KATEGORI --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori"
                               value="{{ old('kategori') }}"
                               class="form-control"
                               placeholder="Contoh: Novel, Sejarah">
                    </div>

                    {{-- COVER --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cover Buku</label>
                        <input type="file" name="cover" class="form-control" onchange="previewImage(event)">
                    </div>

                    {{-- PREVIEW --}}
                    <div class="col-md-6 mb-3 text-center">
                        <label class="form-label d-block">Preview</label>
                        <img id="preview" src="#"
                             style="display:none; width:120px; height:160px; object-fit:cover; border-radius:8px;">
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="col-12 mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi_buku"
                                  class="form-control"
                                  rows="4"
                                  placeholder="Deskripsi buku...">{{ old('deskripsi_buku') }}</textarea>
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="text-end">
                    <button class="btn btn-success px-4">
                        <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- SCRIPT PREVIEW IMAGE --}}
<script>
function previewImage(event) {
    const image = document.getElementById('preview');
    image.src = URL.createObjectURL(event.target.files[0]);
    image.style.display = 'block';
}
</script>

@endsection
