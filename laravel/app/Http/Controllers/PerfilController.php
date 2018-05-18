<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Associados;
use App\Dependentes;
use Illuminate\Support\Facades\Hash;
use Auth;

class PerfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('perfil.index');
    }

    public function primeiroAcesso(Request $request)
    {
        $request->validate([
            'email'     => 'bail|required|unique:users|max:255',
            'password'  => 'required|min:6',
        ]);

        Auth::user()->update([
            'email' => $request->input('email'),
            'password'  => bcrypt($request->input('password'))
        ]);

        Auth::logout();

        return redirect('/');
    }

    public function carregarPerfil()
    {
        return Auth::user()->associado()->get();
    }    

    public function carregarDependentes()
    {
        return Associados::find(Auth::user()->id)->dependentes()->get();
    }

    public function salvarDependente(Request $request)
    {
        $d = Associados::find(Auth::user()->id)->dependentes()->where('nb_identificacao',$request->input('nb_identificacao'))->count();
        if($d > 0){
            Associados::find(Auth::user()->id)->dependentes()->where('nb_identificacao',$request->input('nb_identificacao'))->update([
                'name' => strtoupper($request->input('name')),
                'nb_identificacao' => strtoupper($request->input('nb_identificacao')),
            ]);  
        }else{
            $d = new Dependentes();
            $d->id_user = Auth::user()->id;
            $d->name =  $request->input('name');
            $d->nb_identificacao = $request->input('nb_identificacao');
            $d->save();
        }
    }
    
    public function excluirDependente(Request $request)
    {
        return Dependentes::where('nb_identificacao',$request->input('nb_identificacao'))->delete();
    }    

    public function foto(Request $request){
        
        $filename = hash('sha256',Auth::user()->id);
        $request->file('file')->move('img/user/',$filename.'.png');
    }
    
    public function dadosPessoais(Request $request)
    {

        $associado = Associados::find(Auth::user()->id);
        
        //usuario nao contém vinculo ainda na tabela associados
        if($associado == null){

            $newasssociado = new Associados();

            $newasssociado->tx_nome_guerra = strtoupper($request->input('tx_nome_guerra'));
            $newasssociado->nb_identificacao = $request->input('nb_identificacao');
            $newasssociado->dt_nascimento = date('Y-m-d',strtotime($request->input('dt_nascimento')));
            $newasssociado->tx_graduacao = strtoupper($request->input('tx_graduacao'));      
            
            Auth::user()->associado()->save($newasssociado); 
        
        //usuario contém vinculo na tabela associados
        }else{
            Auth::user()->associado()->update([
               'tx_nome_guerra' => strtoupper($request->input('tx_nome_guerra')),
                'nb_identificacao' => $request->input('nb_identificacao'),
                'dt_nascimento' => date('Y-m-d',strtotime($request->input('dt_nascimento'))),
                'tx_graduacao' => strtoupper($request->input('tx_graduacao'))
            ]);               
        }
        Auth::user()->save(['name' => ucwords($request->input('name'))]);
    }
    public function dadosEnderecos(Request $request)
    {

        $associado = Associados::find(Auth::user()->id);

        if($associado == null){

            $newasssociado = new Associados();

            $newasssociado->nb_cep = strtoupper($request->input('nb_cep'));
            $newasssociado->tx_logradouro = strtoupper($request->input('tx_logradouro'));
            $newasssociado->nb_numero = $request->input('nb_numero');
            $newasssociado->tx_complemento = strtoupper($request->input('tx_complemento'));        
            $newasssociado->tx_cidade = strtoupper($request->input('tx_cidade'));
            $newasssociado->tx_bairro = strtoupper($request->input('tx_bairro'));             
    
            Auth::user()->associado()->save($newasssociado);
        }else{
            Auth::user()->associado()->update([
                'nb_cep' => strtoupper($request->input('nb_cep')),
                'tx_logradouro' => strtoupper($request->input('tx_logradouro')),
                'nb_numero' => $request->input('nb_numero'),
                'tx_complemento' => strtoupper($request->input('tx_complemento')),
                'tx_cidade' => strtoupper($request->input('tx_cidade')),
                'tx_bairro' => strtoupper($request->input('tx_bairro'))  
            ]);               
        }
    }
    public function dadosContatos(Request $request)
    {

        $associado = Associados::find(Auth::user()->id);

        if($associado == null){

            $newasssociado = new Associados();
            $newasssociado->tx_telefone = $request->input('tx_telefone');
            $newasssociado->tx_celular = $request->input('tx_celular');
            $newasssociado->tx_comercial = $request->input('tx_comercial');

            Auth::user()->associado()->save($newasssociado);

        }else{
            Auth::user()->associado()->update([
                'tx_telefone' => $request->input('tx_telefone'),
                'tx_celular' => $request->input('tx_celular'),
                'tx_comercial' => $request->input('tx_comercial')
            ]);
        }
    }
    public function dadosPagamento(Request $request)
    {
        $associado = Associados::find(Auth::user()->id);

        if($associado == null){

            $newasssociado = new Associados();

            $newasssociado->tx_agencia = strtoupper($request->input('tx_agencia'));
            $newasssociado->tx_matricula = $request->input('tx_matricula');
            $newasssociado->tx_ctaBancaria = strtoupper($request->input('tx_ctaBancaria'));
            $newasssociado->tx_banco = strtoupper($request->input('tx_banco'));
            Auth::user()->associado()->save($associado);

        }else{
            Auth::user()->associado()->update([
                'tx_agencia' => strtoupper($request->input('tx_agencia')),
                'tx_matricula' => $request->input('tx_matricula'),
                'tx_ctaBancaria' => strtoupper($request->input('tx_ctaBancaria')),
                'tx_banco' => strtoupper($request->input('tx_banco'))
            ]);
        }
    }            
}
