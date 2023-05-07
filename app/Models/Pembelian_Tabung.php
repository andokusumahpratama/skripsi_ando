<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian_Tabung extends Model
{
    use HasFactory;
    protected $table = 'pembelian_tabung';
    protected $fillable = [
        'barang_masuk_isi',
        'barang_keluar_kosong', 
        'tanggal_transaksi',
        'barangs_id',
        'created_at',
        'updated_at',
    ];

    public function orderBarang()
    {
        return $this->belongsTo(Barang::class, 'barangs_id', 'id');        
    }
}
