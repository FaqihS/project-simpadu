<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'semester',
        'lecturer_id',
        'sks',
        'academic_year',
        'code',
        'description',
    ];

    public function lecturer()
    {
        return $this->belongsTo(User::class);
    }
}
