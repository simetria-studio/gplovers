<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'servico_id',
    ];

    public function servico()
    {
        return $this->hasOne(TipoServico::class, 'id', 'servico_id');
    }
}
