<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administradores extends Model
{
    // protected $fillable = [
    //     'name', 'email', 'password', 'categoria'
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    
    protected $table = 'administradores';

    protected $primaryKey = 'id_user';

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    } 

}
