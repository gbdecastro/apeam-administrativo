<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Associados extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tx_nome_guerra',
        'tx_graduacao',
        'tx_logradouro',
        'tx_complemento',
        'tx_cidade',
        'tx_bairro',
        'nb_identificacao',
        'nb_cep',
        'nb_numero',
        'dt_nascimento',
        'cs_situacao',
        'cs_financeiro',
        'tx_celular',
        'tx_telefone',
        'tx_matricula',
        'tx_banco',
        'tx_agencia',
        'tx_ctaBancaria'
    ];

    protected $table = 'associados';

    protected $primaryKey = 'id_user';

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo('App\User','id_user','id');
    } 

    public function pagamentos()
    {
        return $this->hasMany('App\Pagamentos','id_user','id_user');
    }

    public function dependentes()
    {
        return $this->hasMany('App\Dependentes','id_user','id_user');
    }

}
