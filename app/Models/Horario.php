<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $casts = [
        'dias' => 'array'
    ];

    protected $fillable = [
        'user_id',
        'dias',
        'inicio',
        'fim',
        '24horas'
    ];
}
