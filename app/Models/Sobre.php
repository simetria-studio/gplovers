<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sobre extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tamanho',
        'etnia',
        'peso',
        'tatuagem',
        'peitos',
        'olhos',
        'cabelo',
        'pes'
    ];
}
