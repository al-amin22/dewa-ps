<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        h2 {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <h2>Laporan Keuangan Bulan {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} {{ $tahun }}</h2>

    <h3>Pemasukan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Siang</th>
                <th>Malam</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $i => $t)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $t->tanggal_hari }}</td>
                <td>Rp {{ number_format($t->siang, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($t->malam, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Pengeluaran</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengeluaran as $i => $p)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $p->tanggal_hari }}</td>
                <td>{{ $p->keterangan }}</td>
                <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Ringkasan</h3>
    <table>
        <tr>
            <th>Total Pemasukan</th>
            <td>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Pengeluaran</th>
            <td>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Bersih</th>
            <td>Rp {{ number_format($totalBersih, 0, ',', '.') }}</td>
        </tr>
    </table>
</body>

</html>
