<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container-fluid">

    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h2 mb-0">DEWA PS</h1>
                <p class="text-muted mb-0">Laporan Keuangan</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex justify-content-end gap-2 flex-wrap">
                    <a href="{{ route('export.pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank" class="btn btn-danger">
                        <i class="fas fa-file-pdf me-1"></i> Export PDF
                    </a>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTransaksiModal">
                        <i class="fas fa-plus me-1"></i> Tambah Pemasukan
                    </button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPengeluaranModal">
                        <i class="fas fa-minus me-1"></i> Tambah Pengeluaran
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Filter Section -->
    <div class="filter-section shadow-sm">
        <h2 class="h5 mb-3">Filter Laporan</h2>
        <div class="row g-3">
            <div class="col-md-3">
                <label for="selectBulan" class="form-label">Bulan</label>
                <select class="form-select" id="selectBulan">
                    @foreach(range(1, 12) as $bulan)
                    <option value="{{ $bulan }}" {{ request('bulan', date('m')) == $bulan ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($bulan)->locale('id')->isoFormat('MMMM') }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="selectTahun" class="form-label">Tahun</label>
                <select class="form-select" id="selectTahun">
                    @foreach(range(date('Y')-1, date('Y')+1) as $tahun)
                    <option value="{{ $tahun }}" {{ request('tahun', date('Y')) == $tahun ? 'selected' : '' }}>
                        {{ $tahun }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-primary w-100" onclick="filterLaporan()">
                    <i class="fas fa-filter me-1"></i> Terapkan
                </button>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card summary-card border-primary">
                <div class="card-body">
                    <h3 class="h6 card-title text-muted">Total Pendapatan Bersih</h3>
                    <h2 class="h4">Rp {{ number_format($totalPendapatanBersih, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card summary-card border-success">
                <div class="card-body">
                    <h3 class="h6 card-title text-muted">Total Pemasukan</h3>
                    <h2 class="h4">Rp {{ number_format($totalJumlah, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card summary-card border-info">
                <div class="card-body">
                    <h3 class="h6 card-title text-muted">Rata-rata Harian</h3>
                    <h2 class="h4">Rp {{ number_format($rataRataHarian, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card summary-card border-danger">
                <div class="card-body">
                    <h3 class="h6 card-title text-muted">Total Pengeluaran</h3>
                    <h2 class="h4">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="row mt-4">
        <!-- Tabel Pemasukan -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0">Detail Pemasukan</h2>
                    <button class="btn btn-sm btn-primary" onclick="loadData()">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Hari</th>
                                    <th>Siang</th>
                                    <th>Malam</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalSiang = 0;
                                $totalMalam = 0;
                                $totalJumlah = 0;
                                @endphp
                                @forelse($transaksi as $index => $item)
                                @php
                                $totalSiang += $item->siang;
                                $totalMalam += $item->malam;
                                $totalJumlah += $item->jumlah;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->tanggal_formatted }}</td>
                                    <td>{{ $item->hari_formatted }}</td>
                                    <td>Rp {{ number_format($item->siang, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item->malam, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    <td>
                                        <button
                                            class="btn btn-warning btn-sm me-1"
                                            onclick="editTransaksi({{ $item->id }})"
                                            title="Edit">
                                            <i class="fas fa-edit fa"></i>
                                        </button>
                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="deleteTransaksi({{ $item->id }})"
                                            title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Tidak ada data pemasukan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="table-primary fw-bold">
                                    <td colspan="3" class="text-center">Total</td>
                                    <td>Rp {{ number_format($totalSiang, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalMalam, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalJumlah, 0, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pengeluaran -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0">Detail Pengeluaran</h2>
                    <button class="btn btn-sm btn-primary" onclick="loadDataPengeluaran()">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Hari</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalPengeluaran = 0;
                                @endphp
                                @forelse($pengeluaran ?? [] as $index => $item)
                                @php
                                $totalPengeluaran += $item->jumlah;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->tanggal_formatted }}</td>
                                    <td>{{ $item->hari_formatted }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    <td>
                                        <button
                                            class="btn btn-warning btn-sm me-1"
                                            onclick="editPengeluaran({{ $item->id }})"
                                            title="Edit">
                                            <i class="fas fa-edit fa"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" onclick="deletePengeluaran({{ $item->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Tidak ada data pengeluaran.</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="table-danger fw-bold">
                                    <td colspan="4" class="text-center">Total</td>
                                    <td>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik dan Tabel -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h2 class="h5 mb-0">Grafik Pendapatan Harian</h2>
                </div>
                <div class="card-body">
                    <canvas id="pendapatanChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h2 class="h5 mb-0">Rasio Siang/Malam</h2>
                </div>
                <div class="card-body">
                    <canvas id="rasioChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function filterLaporan() {
        const bulan = document.getElementById('selectBulan').value;
        const tahun = document.getElementById('selectTahun').value;

        const url = new URL(window.location.href);
        url.searchParams.set('bulan', bulan);
        url.searchParams.set('tahun', tahun);

        window.location.href = url.toString(); // redirect ke URL baru
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctxPendapatan = document.getElementById('pendapatanChart').getContext('2d');
        const ctxRasio = document.getElementById('rasioChart').getContext('2d');

        // Data untuk grafik pendapatan harian
        const dataPendapatan = {
            labels: @json($labelsPendapatan),
            datasets: [{
                label: 'Pendapatan Harian',
                data: @json($dataPendapatan),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Grafik pendapatan harian
        new Chart(ctxPendapatan, {
            type: 'line',
            data: dataPendapatan,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Data untuk grafik rasio siang/malam
        const dataRasio = {
            labels: @json($labelsRasio),
            datasets: [{
                label: 'Rasio Siang/Malam',
                data: @json($dataRasio),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Grafik rasio siang/malam
        new Chart(ctxRasio, {
            type: 'bar',
            data: dataRasio,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
@include('transaksi.modal')
@include('pengeluaran.modal')