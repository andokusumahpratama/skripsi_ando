<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    protected $table = 'stok_barang';
    protected $fillable = [
        'jumlah_stok_isi',
        'jumlah_stok_kosong',
        'created_at',
        'updated_at',
        'barang_id',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');        
    }
}
