<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
    protected $fillable = [
        'id_user',
        'cs_situacao',
        'id_administrador'
    ];

    protected $table = 'historico_pagamento';

    protected $primaryKey = ['id_user','dt_referencia','cs_situacao'];

    public $incrementing = false;

    public $timestamps = false;

    public function associado()
    {
        return $this->belongsTo('App\Associados','id_user','id_user');
    } 
}
