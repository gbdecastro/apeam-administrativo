<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficios extends Model
{
    protected $table = 'oficios';
    protected $primaryKey = ['id_protocolo','id_oficio'];

    protected $fillable = [
        'cs_situacao',
        'tx_documento',
        'hash_name'
    ];

    public $incrementing = false;
    
    public function protocolos()
    {
        return $this->belongsTo('App\Protocolos','id_protocolo','id_protocolo');
    }
}
