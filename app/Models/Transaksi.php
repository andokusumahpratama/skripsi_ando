<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'penebusan_tabung',
        'kembali_tabung',
        'pembayaran',
        'created_at',
        'updated_at',
        'jual_tabung_id',
        'pangkalan_id',
    ];

    public function pangkalans()
    {
        return $this->belongsTo(Pangkalan::class, 'pangkalan_id', 'id');
    }

    public function hargaJualBarang()
    {
        return $this->belongsTo(JualTabung::class, 'jual_tabung_id', 'id');
    }
}
