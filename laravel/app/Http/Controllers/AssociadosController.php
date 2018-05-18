<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Associados;
use App\User;
use App\Pagamentos;
use App\Dependentes;
use Auth;
use DB;
use PDF;
use Excel;

class AssociadosController extends Controller
{
    //Administrador
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function getPage()
    {
        return view('associados.index');
    }
    public function index()
    {
        $associados =  Associados::all();
        $count = 0;
        foreach ($associados as $associado) {
            $associados[$count]->user = $associado->user;
            $associados[$count]->dependentes = $associado->dependentes;
            $count++;
        }
        return $associados;
    }

    public function associadosDependentes()
    {
        return DB::table('associados')
                  ->join('dependentes','associados.id_user','=','dependentes.id_user')
                  ->join('users','associados.id_user','=','users.id')
                  ->select('associados.id_user','users.name')
                  ->get();
    }

    public function mudarSituacao($situacao,$id_user)
    {

        Associados::find($id_user)->update([
            'cs_situacao' => $situacao
        ]);

    }
    public function situacaoFinanceira(Request $request)
    {
        if($request->input('cs_financeiro')==0){
            Pagamentos::create([
                'id_user' => $request->input('id_user'),
                'cs_situacao' => 1,
                'id_administrador' => Auth::user()->id
            ]);
        }else{
            Pagamentos::create([
                'id_user' => $request->input('id_user'),
                'cs_situacao' => 0,
                'id_administrador' => Auth::user()->id
            ]);            
        }
    }
    public function downloadPDF()
    {
        $associados = $this->index();
        
        $pdf = PDF::loadView('associados.pdf', compact('associados'));
        return $pdf->download('associados.pdf');        
    }
    public function dadosPessoais(Request $request)
    {

        Associados::find($request->input('id_user'))->update([
            'nb_identificacao' => $request->input('nb_identificacao'),
            'tx_nome_guerra' => $request->input('tx_nome_guerra'),
            'dt_nascimento' => date('Y-m-d',strtotime($request->input('dt_nascimento'))),
            'tx_graduacao' => strtoupper($request->input('tx_graduacao'))
        ]);

        User::find($request->input('id_user'))->update(['name' => ucwords($request->input('user.name'))]);
    }
    public function dadosEnderecos(Request $request)
    {

        Associados::find($request->input('id_user'))->update([
            'nb_cep' => strtoupper($request->input('nb_cep')),
            'tx_logradouro' => strtoupper($request->input('tx_logradouro')),
            'nb_numero' => $request->input('nb_numero'),
            'tx_complemento' => strtoupper($request->input('tx_complemento')),
            'tx_cidade' => strtoupper($request->input('tx_cidade')),
            'tx_bairro' => strtoupper($request->input('tx_bairro'))  
        ]);               
    }
    public function dadosContatos(Request $request)
    {

        Associados::find($request->input('id_user'))->update([
            'tx_telefone' => $request->input('tx_telefone'),
            'tx_celular' => $request->input('tx_celular'),
            'tx_comercial' => $request->input('tx_comercial')
        ]);
    }
    public function dadosPagamento(Request $request)
    {
        Associados::find($request->input('id_user'))->update([
            'tx_agencia' => strtoupper($request->input('tx_agencia')),
            'tx_matricula' => $request->input('tx_matricula'),
            'tx_ctaBancaria' => strtoupper($request->input('tx_ctaBancaria')),
            'tx_banco' => strtoupper($request->input('tx_banco'))
        ]);
    }
    public function getMunicipios()
    {
        return Associados::select('tx_cidade')->whereNotNull('tx_cidade')->groupBy('tx_cidade')->get();
    }
    public function gerarRelatorio(Request $request)
    { 
        $nome = strtoupper($request->input('name'));
        $dt = $request->input('dt_nascimento');
        $mun = strtoupper($request->input('tx_cidade'));
        
        $where = "";
        $and = "";

        if($nome != ''){
            $where = $where .  " `Nome` LIKE '%" . $nome . "%'";
            $and = " and ";
        }

        if($dt != ''){
            $where = $where . $and . " `Data de Nascimento` = " . $dt;
            $and = " and ";
        }

        if($mun != ''){
            $where = $where . $and . " `Município` = '" . $mun."'";
        }
        
        //$associados = DB::select( DB::raw("SELECT * FROM v_associados_relatorios WHERE ".$where));        

        $associados = DB::table('v_associados_relatorios')->whereRaw($where)->get();

        $associados = collect($associados)->map(function($x){ return (array) $x; })->toArray(); 
        
		return Excel::create('Associados Relatorio', function($excel) use ($associados) {

			$excel->sheet('mySheet', function($sheet) use ($associados)

	        {

				$sheet->fromArray($associados);

	        });

		})->download('xlsx');        
    }
    public function declaracoesFormAssociado()
    {
        $associados = $this->index();
        return view('associados.declaracoes.form-associado',compact('associados'));
    }
    public function declaracoesFormDependentes()
    {
        $associados = $this->index();
        $dependentes = [];
        return view('associados.declaracoes.form-dependentes',compact('associados','dependentes'));
    }
    public function salvarDependente(Request $request)
    {
        $d = Associados::find($request->input('id_user'))->dependentes()->where('nb_identificacao',$request->input('nb_identificacao'))->count();
        if($d > 0){
            Associados::find($request->input('id_user'))->dependentes()->where('nb_identificacao',$request->input('nb_identificacao'))->update([
                'name' => strtoupper($request->input('name')),
                'nb_identificacao' => strtoupper($request->input('nb_identificacao')),
            ]);  
        }else{
            $d = new Dependentes();
            $d->id_user = $request->input('id_user');
            $d->name =  $request->input('name');
            $d->nb_identificacao = $request->input('nb_identificacao');
            $d->save();
        }
    }
    public function excluirDependente(Request $request)
    {
        return Dependentes::where('nb_identificacao',$request->input('nb_identificacao'))->delete();
    }     
}
