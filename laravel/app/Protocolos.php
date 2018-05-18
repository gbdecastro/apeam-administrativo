<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocolos extends Model
{
    protected $table = 'protocolos';
    protected $primaryKey = 'id_protocolo';

    protected $fillable = [
        'id_associado',
        'nb_identificacao',
        'id_administrador',
        'tx_servico',
        'tx_nome',
        'tx_descricao'
    ];
    
    public function oficios()
    {
        return $this->hasMany('App\Oficios','id_protocolo','id_protocolo');
    }
}
