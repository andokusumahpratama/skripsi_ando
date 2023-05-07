<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory;

    protected $table = 'hutang';
    protected $fillable = [
        'hutang_pembelian',
        'hutang_tabung',
        'barangss_id',
        'pangkalan_id',
        'created_at',
        'updated_at',
    ];

    public function barang_hutang()
    {
        return $this->belongsTo(Barang::class, 'barangss_id', 'id');        
    }
}
