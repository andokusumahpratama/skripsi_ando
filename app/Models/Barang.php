<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'harga_beli',
        'created_at',
        'updated_at',
    ];

    public function harga_jual()
    {
        return $this->hasMany(JualTabung::class);
    }

    public function getTotalPenebusanPerBulan($bulan)
    {
        $totalPenebusan = $this->jualTabung()->whereHas('transaksis', function ($query) use ($bulan) {
            $query->whereMonth('created_at', $bulan);
        })->sum('transaksis.jml_penebusan_tabung');

        return $totalPenebusan;
    }
}
