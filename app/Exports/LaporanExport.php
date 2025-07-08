<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LaporanExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new TransaksiSheet(),
            new PengeluaranSheet()
        ];
    }
}

class TransaksiSheet implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return \App\Models\Transaksi::all()->map(function ($item) {
            return [
                'Tanggal' => $item->tanggal,
                'Hari' => $item->hari,
                'Periode' => ucfirst($item->periode),
                'Siang' => $item->siang,
                'Malam' => $item->malam,
                'Jumlah' => $item->jumlah
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Hari',
            'Periode',
            'Pendapatan Siang',
            'Pendapatan Malam',
            'Total Pendapatan'
        ];
    }

    public function title(): string
    {
        return 'Transaksi';
    }
}

class PengeluaranSheet implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return \App\Models\Pengeluaran::all()->map(function ($item) {
            return [
                'Keterangan' => $item->keterangan,
                'Jumlah' => $item->jumlah
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Keterangan',
            'Jumlah Pengeluaran'
        ];
    }

    public function title(): string
    {
        return 'Pengeluaran';
    }
}
