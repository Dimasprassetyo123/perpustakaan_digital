@extends('partials.backend.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">📖 Detail Buku</h3>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">
            <i class="mdi mdi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">

                {{-- COVER --}}
                <div class="col-md-4 text-center mb-3">
                    @if($data->cover)
                        <img src="{{ asset('storage/'.$data->cover) }}"
                             style="width:150px; height:200px; object-fit:cover; border-radius:10px;">
                    @else
                        <div class="text-muted">Tidak ada cover</div>
                    @endif
                </div>

                {{-- DETAIL --}}
                <div class="col-md-8">

                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Judul Buku</th>
                            <td>{{ $data->judul_buku }}</td>
                        </tr>

                        <tr>
                            <th>Penulis</th>
                            <td>{{ $data->penulis }}</td>
                        </tr>

                        <tr>
                            <th>Tahun Terbit</th>
                            <td>
                                {{ \Carbon\Carbon::parse($data->tahun_terbit)->format('d-m-Y') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Stok</th>
                            <td>
                                <span class="badge {{ $data->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $data->stok }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Kategori</th>
                            <td>
                                <span class="badge bg-info">
                                    {{ $data->kategori }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Deskripsi</th>
                            <td>
                                {{ $data->deskripsi_buku ?? 'Tidak ada deskripsi' }}
                            </td>
                        </tr>
                    </table>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="text-end mt-3">
                <a href="{{ route('buku.edit',$data->id_buku) }}" class="btn btn-warning">
                    <i class="mdi mdi-pencil"></i> Edit
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
