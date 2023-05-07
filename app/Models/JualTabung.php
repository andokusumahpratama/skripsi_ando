<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JualTabung extends Model
{
    use HasFactory;

    protected $table = 'jual_tabung';
    protected $fillable = [
        'harga_jual',
        'created_at',
        'updated_at',
        'barangt_id',
    ];

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'barangt_id', 'id');        
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'jual_tabung_id', 'id');
    }
}
