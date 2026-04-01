@extends('partials.backend.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">📚 Data Buku</h3>
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus"></i> Tambah Buku
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th width="50">No</th>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Stok</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            {{-- COVER --}}
                            <td>
                                @if($item->cover)
                                    <img src="{{ asset('storage/'.$item->cover) }}"
                                         style="width:60px; height:80px; object-fit:cover; border-radius:5px;">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>

                            {{-- DATA --}}
                            <td>
                                <strong>{{ $item->judul_buku }}</strong>
                                <br>
                                <small class="text-muted">{{ $item->kategori }}</small>
                            </td>

                            <td>{{ $item->penulis }}</td>

                            {{-- STOK --}}
                            <td>
                                <span class="badge bg-{{ $item->stok > 0 ? 'success' : 'danger' }}">
                                    {{ $item->stok }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td>
                                {{-- DETAIL --}}
                                <a href="{{ route('buku.show',$item->id_buku) }}"
                                   class="btn btn-sm btn-info"
                                   title="Detail">
                                    <i class="mdi mdi-eye"></i>
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('buku.edit',$item->id_buku) }}"
                                   class="btn btn-sm btn-warning"
                                   title="Edit">
                                    <i class="mdi mdi-pencil"></i>
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('buku.destroy',$item->id_buku) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Yakin hapus data?')"
                                            class="btn btn-sm btn-danger"
                                            title="Hapus">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                📭 Data buku masih kosong
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
