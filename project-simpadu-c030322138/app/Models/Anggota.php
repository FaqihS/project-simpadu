<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'usia',
        'tgl_lahir',
        'alamat',
        'gender',
        'status',
        'hobi',
    ];
}
