<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengeluaranController extends Controller
{
    public function index()
    {
        return Pengeluaran::orderBy('created_at', 'desc')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal'     => 'required|date',
            'jumlah'      => 'required|integer|min:0',
            'keterangan'  => 'nullable|string|max:255'
        ]);

        $tanggal = Carbon::parse($data['tanggal']);
        $data['bulan'] = $tanggal->month;
        $data['tahun'] = $tanggal->year;
        $data['hari']  = $tanggal->isoFormat('dddd');

        Pengeluaran::create($data);

        return redirect()->back()->with('success', 'Data pengeluaran berhasil disimpan');
    }

    public function show(Pengeluaran $pengeluaran)
    {
        return response()->json($pengeluaran);
    }


    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $data = $request->validate([
            'tanggal'     => 'required|date',
            'jumlah'      => 'required|integer|min:0',
            'keterangan'  => 'nullable|string|max:255',
        ]);

        $dt = Carbon::parse($data['tanggal']);
        $data['bulan'] = $dt->month;
        $data['tahun'] = $dt->year;
        $data['hari']  = $dt->isoFormat('dddd');

        $pengeluaran->update($data);

        return redirect()->back()->with('success', 'Data pengeluaran berhasil diperbarui');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->back()->with('success', 'Data pengeluaran berhasil dihapus');
    }
}
