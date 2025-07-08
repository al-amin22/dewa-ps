<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;


class TransaksiController extends Controller
{
    public function index()
    {
        return Transaksi::all();
    }

    public function getByPeriode($periode)
    {
        return Transaksi::where('periode', $periode)
            ->orderBy('tanggal', 'desc')
            ->get()
            ->map(function ($item) {
                $item->tanggal = date('d/m/Y', strtotime($item->tanggal));
                return $item;
            });
    }

    // app/Http/Controllers/TransaksiController.php

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'siang' => 'required|integer|min:0',
            'malam' => 'required|integer|min:0',
            'jumlah' => 'required|integer|min:0'
        ]);

        $tanggal = Carbon::parse($data['tanggal']);
        $data['bulan'] = $tanggal->month;
        $data['tahun'] = $tanggal->year;
        $data['hari'] = $tanggal->isoFormat('dddd');

        Transaksi::create($data);

        // Redirect kembali ke dashboard dengan flash message
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function getByBulanTahun($bulan, $tahun)
    {
        return Transaksi::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderBy('tanggal', 'desc')
            ->get()
            ->map(function ($item) {
                $item->tanggal = $item->tanggal->format('d/m/Y');
                return $item;
            });
    }

    public function show(Transaksi $transaksi)
    {
        return $transaksi;
    }


    public function update(Request $request, Transaksi $transaksi)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'siang'   => 'required|integer|min:0',
            'malam'   => 'required|integer|min:0',
            'jumlah'  => 'required|integer|min:0'
        ]);

        // Parse tanggal dengan Carbon untuk dapat bulan, tahun, dan nama hari
        $dt = Carbon::parse($data['tanggal']);
        $data['bulan'] = $dt->month;
        $data['tahun'] = $dt->year;
        $data['hari'] = $dt->isoFormat('dddd');

        $transaksi->update($data);

        return redirect()->back()->with('success', 'Data Berhasil Diubah');
    }


    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
