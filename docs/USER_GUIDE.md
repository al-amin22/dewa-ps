# User Guide

## Persiapan Awal

Sebelum menggunakan aplikasi:

1. Pastikan database sudah dikonfigurasi di file .env.
2. Pastikan migration sudah dijalankan.
3. Pastikan akun pengguna dengan role admin tersedia.

## Login

1. Buka halaman /login.
2. Masukkan email dan password.
3. Klik tombol masuk.
4. Jika kredensial benar, pengguna diarahkan ke dashboard.

Jika login gagal, pastikan email dan password sesuai.

## Dashboard

Dashboard menampilkan:

- total pemasukan
- total pengeluaran
- saldo bersih
- rata-rata harian
- daftar transaksi bulanan
- daftar pengeluaran bulanan

Anda juga dapat memilih bulan dan tahun tertentu untuk melihat data periode yang berbeda.

## Menambahkan Transaksi

1. Buka menu transaksi.
2. Klik tambah data.
3. Isi tanggal transaksi.
4. Isi nominal siang.
5. Isi nominal malam.
6. Simpan data.

Setelah disimpan, sistem akan otomatis menentukan bulan, tahun, dan nama hari.

## Mengubah Transaksi

1. Buka data transaksi yang ingin diubah.
2. Perbarui tanggal atau nominal.
3. Simpan perubahan.

## Menghapus Transaksi

1. Pilih data transaksi.
2. Klik hapus.
3. Konfirmasi jika diminta.

## Menambahkan Pengeluaran

1. Buka menu pengeluaran.
2. Klik tambah data.
3. Isi tanggal pengeluaran.
4. Isi nominal pengeluaran.
5. Isi keterangan jika diperlukan.
6. Simpan data.

## Mengubah Pengeluaran

1. Buka data pengeluaran yang ingin diperbarui.
2. Ubah tanggal, nominal, atau keterangan.
3. Simpan perubahan.

## Menghapus Pengeluaran

1. Pilih data pengeluaran.
2. Klik hapus.
3. Konfirmasi penghapusan.

## Ekspor PDF

1. Buka dashboard.
2. Pilih bulan dan tahun yang diinginkan.
3. Klik menu ekspor PDF.
4. File laporan akan diunduh secara otomatis.

Laporan PDF berisi:

- tabel pemasukan
- tabel pengeluaran
- ringkasan total pemasukan
- ringkasan total pengeluaran
- ringkasan saldo bersih

## Ekspor Excel

1. Buka dashboard atau halaman ekspor.
2. Klik ekspor Excel.
3. File laporan akan diunduh dalam format .xlsx.

File Excel berisi beberapa sheet:

- Transaksi
- Pengeluaran

## Tips Penggunaan

- gunakan tanggal yang konsisten agar filter bulanan bekerja dengan benar
- pastikan nominal diisi tanpa karakter selain angka
- lakukan ekspor setelah data bulan yang dipilih sudah lengkap

## Bantuan Masalah Umum

### Tidak bisa login

- cek email dan password
- pastikan akun aktif dan memiliki role yang sesuai

### Data tidak muncul di dashboard

- pastikan bulan dan tahun yang dipilih benar
- cek apakah data transaksi atau pengeluaran memang sudah tersimpan

### File PDF atau Excel tidak terunduh

- pastikan dependency export sudah terpasang
- pastikan tidak ada error pada server aplikasi
