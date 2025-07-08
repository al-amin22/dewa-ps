<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class ExportController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new LaporanExport, 'laporan.xlsx');
    }
}
