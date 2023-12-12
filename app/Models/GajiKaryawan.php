<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiKaryawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_karyawan',
        'total_gaji',
        'bukti_transfer_gaji',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
