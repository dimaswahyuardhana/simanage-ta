<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jabatan';

    protected $fillable = [
        'jabatan',
        'gaji',
        'id_company' //
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_jabatan');
    }
}
