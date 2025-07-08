<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEWA PS - Laporan Keuangan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 56px;
            background-color: #f8f9fa;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: 10px 10px 0 0 !important;
        }

        .table th {
            background-color: #f8f9fa;
            position: sticky;
            top: 0;
        }

        .btn-action {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .table-responsive {
                font-size: 0.9rem;
            }

            .btn-action {
                width: 35px;
                height: 35px;
            }
        }

        /* Tambahkan di bagian style */
        body {
            padding-top: 70px;
            /* Menambah padding atas untuk navbar fixed */
        }

        .dashboard-header {
            margin-top: 1.5rem;
            /* Jarak antara navbar dan konten */
            margin-bottom: 2rem;
            /* Jarak antara header dan card pertama */
        }

        .card {
            margin-bottom: 1.5rem;
            /* Jarak antar card */
        }

        /* Untuk judul section */
        .section-title {
            margin-bottom: 1rem;
            font-weight: 600;
        }

        /* Untuk filter section */
        .filter-section {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }

        /* Untuk summary cards */
        .summary-card {
            transition: transform 0.2s;
        }

        .summary-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-gamepad me-2"></i>DEWA PS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#tambahTransaksiModal">
                            <i class="fas fa-plus me-1"></i> Tambah Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#tambahPengeluaranModal">
                            <i class="fas fa-minus me-1"></i> Tambah Pengeluaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-white" style="text-decoration: none;">
                                <i class="fas fa-user me-1"></i> Logout
                            </button>
                        </form>

                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exportModal">
                            <i class="fas fa-file-excel me-1"></i> Export Excel
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Modal Export -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-file-excel me-2"></i>Export Data
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/export/excel" method="GET">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="export_bulan" class="form-label">Bulan</label>
                            <select class="form-select" id="export_bulan" name="bulan">
                                @foreach(range(1, 12) as $bulan)
                                <option value="{{ $bulan }}" {{ date('m') == $bulan ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($bulan)->isoFormat('MMMM') }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="export_tahun" class="form-label">Tahun</label>
                            <select class="form-select" id="export_tahun" name="tahun">
                                @foreach(range(date('Y')-1, date('Y')+1) as $tahun)
                                <option value="{{ $tahun }}" {{ date('Y') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Tutup
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-download me-1"></i>Export Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Other Modals -->
    @include('transaksi.modal')
    @include('pengeluaran.modal')

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Scripts -->
    <script>
        // Format angka saat input
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('change', function() {
                this.value = parseInt(this.value) || 0;
            });
        });

        // Hitung jumlah otomatis untuk transaksi
        document.getElementById('siang')?.addEventListener('change', hitungJumlah);
        document.getElementById('malam')?.addEventListener('change', hitungJumlah);

        function hitungJumlah() {
            const siang = parseInt(document.getElementById('siang').value) || 0;
            const malam = parseInt(document.getElementById('malam').value) || 0;
            document.getElementById('jumlah').value = siang + malam;
        }

        // Hitung jumlah otomatis di modal edit
        document.getElementById('edit_siang')?.addEventListener('change', hitungEditJumlah);
        document.getElementById('edit_malam')?.addEventListener('change', hitungEditJumlah);

        function hitungEditJumlah() {
            const siang = parseInt(document.getElementById('edit_siang').value) || 0;
            const malam = parseInt(document.getElementById('edit_malam').value) || 0;
            document.getElementById('edit_jumlah').value = siang + malam;
        }
    </script>

    @stack('scripts')
</body>

</html>
