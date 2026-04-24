# dewa-ps

dewa-ps adalah aplikasi administrasi keuangan berbasis Laravel 10 untuk mencatat pemasukan, pengeluaran, dan membuat rekap laporan bulanan dalam format web, PDF, dan Excel.

## Ringkasan

Sistem ini dirancang untuk kebutuhan operasional internal dengan alur kerja sederhana:

- login pengguna dengan kontrol akses admin
- input transaksi pemasukan harian
- input pengeluaran operasional
- ringkasan pendapatan dan pengeluaran per bulan
- ekspor laporan ke PDF dan Excel

## Fitur Utama

- autentikasi login dan logout
- middleware `auth` dan `admin` untuk membatasi akses
- dashboard ringkasan keuangan bulanan
- CRUD transaksi pemasukan
- CRUD pengeluaran
- filter data berdasarkan bulan dan tahun
- ekspor laporan ke PDF
- ekspor laporan ke Excel dengan beberapa sheet
- tampilan tanggal dan hari dalam Bahasa Indonesia

## Teknologi

- Laravel 10
- PHP 8.1+
- Eloquent ORM
- Carbon
- Laravel UI
- Laravel Sanctum
- maatwebsite/excel
- barryvdh/laravel-dompdf

## Struktur Modul

- AuthController: proses login dan logout
- DashboardController: ringkasan data, perhitungan total, dan ekspor PDF
- TransaksiController: pengelolaan transaksi pemasukan
- PengeluaranController: pengelolaan data pengeluaran
- ExportController: ekspor Excel
- LaporanExport: pembentuk file Excel multi-sheet

## Rute Penting

- /login: form login
- /: dashboard utama setelah login
- /transaksi: data transaksi pemasukan
- /pengeluaran: data pengeluaran
- /export/pdf: unduh laporan PDF
- /export/excel: unduh laporan Excel

## Cara Menjalankan

1. Salin file .env.example menjadi .env
2. Sesuaikan konfigurasi database
3. Jalankan composer install
4. Jalankan php artisan key:generate
5. Jalankan php artisan migrate
6. Jalankan php artisan serve

## Catatan Akses

- Sistem ini menggunakan pengecekan role.
- Pengguna dengan role 99 diarahkan ke dashboard admin.
- Seluruh halaman operasional dilindungi middleware `auth` dan `admin`.

## Dokumentasi Tambahan

- [Project Overview](docs/PROJECT_OVERVIEW.md)
- [User Guide](docs/USER_GUIDE.md)

## Lisensi

Proyek ini mengikuti lisensi yang digunakan oleh pemilik repositori.
