<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_karyawan',
        'jenis_kelamin',
        'tanggal_lahir',
        'pendidikan',
        'created_at',
        'profile_image',
        'jabatan_id',
        'user_id',
        'updated_at',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');        
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
