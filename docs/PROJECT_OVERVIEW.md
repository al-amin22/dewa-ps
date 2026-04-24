# Project Overview

## Gambaran Umum

dewa-ps adalah aplikasi administrasi keuangan berbasis Laravel 10 yang berfokus pada pencatatan pemasukan, pencatatan pengeluaran, serta pembuatan laporan bulanan. Sistem ini dibuat untuk digunakan secara internal oleh admin agar data keuangan dapat dipantau dengan lebih rapi, konsisten, dan mudah diekspor.

## Tujuan Sistem

- mencatat pemasukan harian berdasarkan tanggal
- mencatat pengeluaran operasional berdasarkan tanggal
- menampilkan ringkasan keuangan per bulan dan tahun
- menghasilkan laporan dalam PDF dan Excel
- memudahkan pengelolaan data melalui antarmuka web

## Arsitektur Aplikasi

Proyek ini mengikuti pola MVC bawaan Laravel:

- Model menyimpan representasi data transaksi dan pengeluaran
- Controller menangani validasi, logika bisnis, dan pengambilan data
- View menampilkan dashboard, form login, dan laporan PDF

## Komponen Utama

### 1. Autentikasi

`AuthController` menangani:

- menampilkan halaman login
- proses validasi kredensial
- login berbasis session
- logout dan regenerasi session

Pengguna dengan role admin diarahkan ke dashboard utama.

### 2. Dashboard

`DashboardController` bertanggung jawab atas:

- pengambilan data transaksi dan pengeluaran berdasarkan bulan dan tahun
- formatting tanggal ke Bahasa Indonesia
- perhitungan total pemasukan
- perhitungan total pengeluaran
- perhitungan saldo bersih
- perhitungan rata-rata harian
- data grafik sederhana untuk pemasukan dan rasio siang/malam
- ekspor PDF laporan bulanan

### 3. Transaksi

`TransaksiController` menangani data pemasukan dengan field utama:

- tanggal
- hari
- siang
- malam
- jumlah
- bulan
- tahun

Saat data disimpan atau diperbarui, aplikasi otomatis mengisi bulan, tahun, dan nama hari dari tanggal yang dipilih.

### 4. Pengeluaran

`PengeluaranController` menangani data pengeluaran dengan field utama:

- tanggal
- hari
- bulan
- tahun
- keterangan
- jumlah

Seperti transaksi, data pengeluaran juga diturunkan ke bulan, tahun, dan hari agar mudah difilter.

### 5. Export Laporan

`ExportController` dan `LaporanExport` menyediakan laporan Excel dengan dua sheet:

- Transaksi
- Pengeluaran

Laporan PDF menggunakan template Blade khusus di view export.

## Alur Data

1. Admin login ke sistem.
2. Dashboard menampilkan data bulan aktif atau bulan yang dipilih.
3. Admin menambahkan transaksi pemasukan.
4. Admin menambahkan pengeluaran.
5. Sistem menghitung total dan saldo bersih.
6. Admin dapat mengunduh laporan PDF atau Excel.

## Validasi Data

Form input melakukan validasi dasar untuk menjaga konsistensi data:

- tanggal wajib diisi dan harus valid
- nominal wajib berupa angka bulat dan tidak boleh negatif
- keterangan pengeluaran bersifat opsional dengan batas panjang teks

## Sumber Tampilan

Beberapa view penting yang mendukung sistem ini:

- auth/login
- dashboard
- transaksi modal
- pengeluaran modal
- exports/laporan_pdf

## Kelebihan Implementasi

- ringkas dan mudah dipahami
- laporan langsung siap diunduh
- dukungan bahasa Indonesia pada tanggal dan hari
- struktur controller dan model sederhana untuk pemeliharaan
