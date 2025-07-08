<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi massal
     */
    protected $fillable = [
        'tanggal',
        'hari',
        'siang',
        'malam',
        'jumlah',
        'bulan',
        'tahun'
    ];

    /**
     * Accessor untuk mendapatkan nama bulan
     */
    public function getNamaBulanAttribute()
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ][$this->bulan];
    }

    // Tambahkan relasi atau method lain jika diperlukan
}
