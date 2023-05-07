<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkalan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pangkalan',
        'alamat',
        'no_hp',
        'created_at',
        'updated_at'
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'pangkalan_id', 'id');
    }

    public function hutangs()
    {
        return $this->hasMany(Hutang::class, 'pangkalan_id', 'id');
    }
}
