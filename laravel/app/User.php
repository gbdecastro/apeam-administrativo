<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'categoria'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function associado()
    {
        return $this->hasOne('App\Associados','id_user','id');
    }
    public function administrador()
    {
        return $this->hasOne('App\Administradores','id_user','id');
    }
    public function dependentes()
    {
        return $this->hasMany('App\Dependentes','id_user','id');
    }
}
