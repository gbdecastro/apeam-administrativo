<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dependentes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nb_identificacao',
        'name'
    ];

    protected $table = 'dependentes';

    protected $primaryKey = ['id_user','nb_identificacao'];

    public $incrementing = false;

    public function associado()
    {
        return $this->belongsTo('App\Associados','id_user','id_user');
    }
}
