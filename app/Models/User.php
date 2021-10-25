<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permission',
        'plan',
        'status',
        'publish',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function data()
    {
        return $this->hasOne(Dado::class, 'user_id');
    }

    public function contato()
    {
        return $this->hasOne(Contato::class, 'user_id');
    }

    public function sobre()
    {
        return $this->hasOne(Sobre::class, 'user_id');
    }

    public function local()
    {
        return $this->hasOne(Local::class, 'user_id');
    }

    public function lugares()
    {
        return $this->hasMany(Lugar::class, 'user_id');
    }

    public function servicos()
    {
        return $this->hasMany(Servico::class, 'user_id');
    }

    public function horario()
    {
        return $this->hasOne(Horario::class, 'user_id');
    }

    public function caches()
    {
        return $this->hasMany(Cache::class, 'user_id');
    }
}
