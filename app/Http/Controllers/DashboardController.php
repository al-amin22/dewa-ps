<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Transaksi;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Set locale ke Bahasa Indonesia
        App::setLocale('id');

        // Default ke bulan/tahun saat ini (atau bulan sebelumnya jika diinginkan)
        $now   = Carbon::now();
        $bulan = $request->get('bulan', $now->format('m'));
        $tahun = $request->get('tahun', $now->format('Y'));

        // Ambil data transaksi & pengeluaran
        $transaksi = Transaksi::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderBy('tanggal', 'asc')
            ->get();

        $pengeluaran = Pengeluaran::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderBy('tanggal', 'asc')
            ->get();

        // Tambahkan formatting tanggal & hari (Indonesia) ke setiap item transaksi
        foreach ($transaksi as $item) {
            $dt = Carbon::parse($item->tanggal);
            $item->tanggal_formatted = $dt->translatedFormat('d F Y'); // e.g. "08 Juli 2025"
            $item->hari_formatted    = $dt->translatedFormat('l');      // e.g. "Rabu"
        }

        // Tambahkan formatting tanggal & hari ke setiap item pengeluaran
        foreach ($pengeluaran as $item) {
            $dt = Carbon::parse($item->tanggal);
            $item->tanggal_formatted = $dt->translatedFormat('d F Y');
            $item->hari_formatted    = $dt->translatedFormat('l');
        }

        // Hitung ringkasan angka
        $totalSiang           = $transaksi->sum('siang');
        $totalMalam           = $transaksi->sum('malam');
        $totalJumlah          = $transaksi->sum('jumlah');
        $totalPengeluaran     = $pengeluaran->sum('jumlah');
        $totalPendapatanBersih = $totalJumlah - $totalPengeluaran;

        $jumlahHariUnik  = $transaksi->pluck('tanggal')->unique()->count();
        $rataRataHarian = $jumlahHariUnik
            ? round($totalJumlah / $jumlahHariUnik)
            : 0;

        // Siapkan data chart (jika masih dipakai)
        $grouped         = $transaksi->groupBy('tanggal');
        $labelsPendapatan = [];
        $dataPendapatan   = [];
        foreach ($grouped as $tgl => $items) {
            $labelsPendapatan[] = Carbon::parse($tgl)->translatedFormat('d M');
            $dataPendapatan[]   = $items->sum('jumlah');
        }
        $labelsRasio = ['Siang', 'Malam'];
        $dataRasio   = [$totalSiang, $totalMalam];

        return view('dashboard', compact(
            'transaksi',
            'pengeluaran',
            'bulan',
            'tahun',
            'totalSiang',
            'totalMalam',
            'totalJumlah',
            'totalPengeluaran',
            'totalPendapatanBersih',
            'rataRataHarian',
            'labelsPendapatan',
            'dataPendapatan',
            'labelsRasio',
            'dataRasio'
        ));
    }

    public function exportPDF(Request $request)
    {
        App::setLocale('id'); // Set Bahasa Indonesia

        $bulan = $request->get('bulan', now()->format('m'));
        $tahun = $request->get('tahun', now()->format('Y'));

        $transaksi = Transaksi::where('bulan', $bulan)->where('tahun', $tahun)->get();
        $pengeluaran = Pengeluaran::where('bulan', $bulan)->where('tahun', $tahun)->get();

        // Format tanggal & hari dalam Bahasa Indonesia
        foreach ($transaksi as $item) {
            $dt = Carbon::parse($item->tanggal);
            $item->tanggal_hari = $dt->translatedFormat('l, d F Y');
        }

        foreach ($pengeluaran as $item) {
            $dt = Carbon::parse($item->tanggal);
            $item->tanggal_hari = $dt->translatedFormat('l, d F Y');
        }

        $totalPemasukan = $transaksi->sum('jumlah');
        $totalPengeluaran = $pengeluaran->sum('jumlah');
        $totalBersih = $totalPemasukan - $totalPengeluaran;

        $pdf = PDF::loadView('exports.laporan_pdf', compact(
            'transaksi',
            'pengeluaran',
            'bulan',
            'tahun',
            'totalPemasukan',
            'totalPengeluaran',
            'totalBersih'
        ))->setPaper('a4', 'portrait'); // <- Tambahkan ini

        return $pdf->download("laporan-keuangan-$bulan-$tahun.pdf");
    }
}
