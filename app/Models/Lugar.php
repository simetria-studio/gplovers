<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lugar_id',
    ];

    public function lugar()
    {
        return $this->hasOne(TipoLugar::class, 'id', 'lugar_id');
    }
}
