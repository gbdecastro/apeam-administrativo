<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        if(Auth::user()->categoria == 1)
            return redirect('/administradores');
        else
            return redirect('/perfil');
    }else{
        return view('welcome');
    }
});

Auth::routes();

//Perfil - Auth
Route::get('/perfil', 'PerfilController@index')->name('perfil');
Route::post('perfil/foto','PerfilController@foto');
Route::get('perfil/carregarPerfil','PerfilController@carregarPerfil');
Route::get('perfil/carregarDependentes','PerfilController@carregarDependentes');
Route::post('perfil/dadosPessoais','PerfilController@dadosPessoais');
Route::post('perfil/dadosEnderecos','PerfilController@dadosEnderecos');
Route::post('perfil/dadosContatos','PerfilController@dadosContatos');
Route::post('perfil/dadosPagamento','PerfilController@dadosPagamento');
Route::post('perfil/salvarDependente','PerfilController@salvarDependente');
Route::delete('perfil/excluirDependente','PerfilController@excluirDependente');
Route::post('perfil/primeiroAcesso','PerfilController@primeiroAcesso');

//Administradoress - admin
Route::get('/administradores','AdministradoresController@getPage');
Route::get('/administradores/all','AdministradoresController@index');
Route::get('/administradores/not', 'AdministradoresController@notAdministradores');
Route::post('/administradores', 'AdministradoresController@store');
Route::delete('/administradores/{id}', 'AdministradoresController@destroy');
Route::get('/administradores/downloadPDF','AdministradoresController@downloadPDF');

//Associados - admin
Route::get('/associados','AssociadosController@getPage');
Route::get('/associados/all','AssociadosController@index');
Route::get('/associados/downloadPDF','AssociadosController@downloadPDF');
Route::post('/associados/{situacao}/{id_user}','AssociadosController@mudarSituacao');
Route::post('/associados/dadosPessoais','AssociadosController@dadosPessoais');
Route::post('/associados/dadosEnderecos','AssociadosController@dadosEnderecos');
Route::post('/associados/dadosContatos','AssociadosController@dadosContatos');
Route::post('/associados/dadosPagamento','AssociadosController@dadosPagamento');
Route::post('/associados/situacaoFinanceira','AssociadosController@situacaoFinanceira');
Route::get('/associados/carregarDependentes','AssociadosController@carregarDependentes');
Route::post('/associados/salvarDependente','AssociadosController@salvarDependente');
Route::delete('/associados/excluirDependente','AssociadosController@excluirDependente');
Route::get('/associados/municipios','AssociadosController@getMunicipios');
Route::get('/associados/relatorio','AssociadosController@gerarRelatorio');
Route::get('/associados/possuiDependentes','AssociadosController@associadosDependentes');

//Declarações
//Associado
Route::get('/declaracoes/associado/imprimir/{id}','DeclaracoesController@imprimirAssociado');
Route::get('/declaracoes/associado/form-associado','AssociadosController@declaracoesFormAssociado');
Route::get('/declaracoes/associado',function(){
    if(Auth::user()->categoria == 0){
        return redirect()->action(
            'DeclaracoesController@imprimirAssociado', ['id' => Auth::user()->id]
        );        
    }else{
        return redirect('/declaracoes/associado/form-associado');
    }
});

//Dependente
Route::get('/declaracoes/dependentes/form-dependentes','AssociadosController@declaracoesFormDependentes');
Route::get('/dependentes/all','DeclaracoesController@getDependentes');
Route::get('/declaracoes/dependentes/imprimir','DeclaracoesController@imprimirDependente');
Route::get('/declaracoes/dependentes',function(){
    if(Auth::user()->categoria == 0){
        return redirect()->action(
            'DeclaracoesController@imprimirDependente', ['id_user' => Auth::user()->id]
        );        
    }else{
        return redirect('/declaracoes/dependentes/form-dependentes');
    }
});

//Estatutos
Route::get('/declaracoes/estatutos','EstatutosController@getPage');
Route::post('/declaracoes/estatutos','EstatutosController@create');
Route::delete('/declaracoes/estatutos/{name}','EstatutosController@delete');

//Protocolos
Route::get('/protocolos','ProtocolosController@getPage');
Route::get('/protocolos/servico/emitirProtocolo','ProtocolosController@emitirProtocoloServico');
Route::get('/protocolos/oficio/emitirProtocolo','ProtocolosController@emitirProtocoloOficio');
Route::post('/protocolos/create','ProtocolosController@create');
Route::get('/protocolos/consultar','ProtocolosController@consultarPage');
Route::post('/protocolos/consultar','ProtocolosController@consultar');
Route::post('/protocolos/consultarOficios/{id_protocolo}','ProtocolosController@consultarOficios');
Route::post('/protocolos/consultarConfirmacao/{id_protocolo}','ProtocolosController@consultarConfirmacao');
Route::get('/protocolos/consultar/imprimir','ProtocolosController@consultarImprimir');