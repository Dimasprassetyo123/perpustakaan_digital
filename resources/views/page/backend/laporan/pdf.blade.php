<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: sans-serif; }
        h2 { text-align: center; }
        p { text-align: center; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th { background-color: #f2f2f2; }

        th, td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Laporan Peminjaman Buku</h2>
    <p>Tanggal Cetak: {{ date('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Denda (Rp)</th>
            </tr>
        </thead>

        <tbody>
            @php $totalDenda = 0; @endphp
            @foreach ($data as $item)
                @php
                    $status = 'Dipinjam';

                    $today = \Carbon\Carbon::now()->startOfDay();
                    $batas = \Carbon\Carbon::parse($item->wajib_kembali)->startOfDay();

                    if ($item->tanggal_kembali) {
                        $kembali = \Carbon\Carbon::parse($item->tanggal_kembali)->startOfDay();

                        if ($kembali->gt($batas)) {
                            $status = 'Terlambat';
                        } else {
                            $status = 'Dikembalikan';
                        }
                    } elseif ($today->gt($batas)) {
                        $status = 'Terlambat';
                    }

                    // For the correct display text from DB
                    if ($item->status == 'ditolak') {
                        $status = 'Ditolak';
                    } elseif ($item->status == 'menunggu') {
                        $status = 'Menunggu';
                    } elseif ($item->status == 'pengajuan_kembali') {
                        $status = 'Pengajuan Kembali';
                    }

                    $totalDenda += $item->denda;
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
                    <td>{{ $status }}</td>
                    <td>{{ number_format($item->denda, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" style="text-align: right;">Total Kas Denda:</th>
                <th>Rp {{ number_format($totalDenda, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

</body>
</html>
