<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiHutang extends Model
{
    use HasFactory;

    protected $table = 'transaksi_hutang';
    protected $fillable = [
        'bayar_hutang_pembelian',
        'bayar_hutang_tabung',
        'pangkalans__id',
        'barangs__id',
        'created_at',
        'updated_at',
    ];

    public function hutang_tabung()
    {
        return $this->belongsTo(Barang::class, 'barangs__id', 'id');
    }

    public function hutang_pangkalan()
    {
        return $this->belongsTo(Pangkalan::class, 'pangkalans__id', 'id');
    }
}
