<?php

namespace App\Http\Controllers;

use App\Protocolos;
use App\Oficios;
use App\Associados;
use Auth;
use PDF;
use DB;
use URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProtocolosController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        return Protocolos::all();
    }

    public function getPage()
    {
        $associados = $this->associados();
        return view('protocolos.index',compact('associados'));
    }

    private function associados()
    {
        $associados =  Associados::all('id_user');
        $count = 0;
        foreach ($associados as $associado) {
            $associados[$count]->name = $associado->user->name;
            $count++;
        }
        return $associados;        
    }

    public function emitirProtocoloServico(Request $request)
    {
        $associado = Associados::find($request->input('id_associado'));
        $associado->user = $associado->user()->get();
        $servico = $request->input('tx_servico');

        $pdf = PDF::loadView('protocolos.servico.pdf', compact('associado','servico'));
        return $pdf->download('Protocolo de Atendimento.pdf');         
    }

    public function emitirProtocoloOficio(Request $request)
    {

        $tx_nome = $request->input('tx_nome');
        $nb_identificacao = $request->input('nb_identificacao');

        $pdf = PDF::loadView('protocolos.oficio.pdf', compact('tx_nome','nb_identificacao'));
        return $pdf->download('Protocolo de Atendimento.pdf');        
    }

    public function create(Request $request)
    {
        $protocolo = new Protocolos();
        $protocolo->id_administrador = Auth::user()->id;

        if($request->input('tx_tipo') == 'oficio'){

            $protocolo->nb_identificacao = $request->input('nb_identificacao');
            $protocolo->tx_nome = ucwords($request->input('tx_nome'));
            $protocolo->save();
            foreach($request->only('file_oficio') as $files){
                foreach ($files as $file) {
                    $count = Oficios::where('id_protocolo','=',$protocolo->id_protocolo)->count();

                    $filenameConfirmacao =  hash('sha256',$protocolo->id_protocolo);

                    $oficio = new Oficios();
                    $filnameOficio = hash('sha256', $file->getClientOriginalName() . $protocolo->id_protocolo);
        
                    $oficio->id_oficio = $count+1;
                    $oficio->id_protocolo = $protocolo->id_protocolo;
                    $oficio->hash_name = $filnameOficio;

                    $file->move('arquivos_protocolos/oficios/'.$filenameConfirmacao,'/'.$filnameOficio.'.pdf');
        
                    $oficio->save();                        
                }
            }     

            $request->file('file_confirmacao')->move('arquivos_protocolos/confirmacoes/'.$filenameConfirmacao,'/confirmacao.pdf');            

        }else{
            $protocolo->id_associado = $request->input('id_associado');
            $protocolo->tx_servico = $request->input('tx_servico');
            $protocolo->save();

            $filenameConfirmacao =  hash('sha256',$protocolo->id_protocolo);

            $request->file('file_confirmacao')->move('arquivos_protocolos/confirmacoes/'.$filenameConfirmacao,'/confirmacao.pdf');
        }
    }

    public function consultarPage()
    {
        $protocolos = DB::table('v_protocolos')->get();
        return view('protocolos.consultar',compact('protocolos'));
    }

    public function consultarOficios($id_protocolo)
    {
        $oficios = Protocolos::find($id_protocolo)->oficios()->get();
        $hash_protocolo =  hash('sha256',$id_protocolo);
        $key = 0;
        foreach ($oficios as $oficio) {
            $oficios[$key]->url = URL::to('/arquivos_protocolos/oficios/'.$hash_protocolo.'/'.$oficios[$key]->hash_name.'.pdf');
            $key++;
        }

        return $oficios;
    }

    public function consultarConfirmacao($id_protocolo)
    {
        return URL::to('/arquivos_protocolos/confirmacoes/'.hash('sha256',$id_protocolo).'/confirmacao.pdf');    
    }
    

    public function consultarImprimir(Request $request)
    {
        $id_protocolo = $request->input('id_protocolo');
        $nome = DB::table('v_protocolos')->where('id_protocolo','=',$id_protocolo)->select('name')->limit(1)->get();
        $cpf = DB::table('v_protocolos')->where('id_protocolo','=',$id_protocolo)->select('nb_identificacao')->limit(1)->get();
        $telefone = DB::table('v_protocolos')->where('id_protocolo','=',$id_protocolo)->select('tx_telefone')->limit(1)->get();

        $nome = $nome->name;
        $cpf = $cpf->nb_identificacao;
        $telefone = $telefone->tx_telefone;

        $pdf = PDF::loadView('protocolos.pdf', compact('id_protocolo','nome','cpf', 'telefone'));
        return $pdf->download('Protocolo '.$id_protocolo.'.pdf');   
    }
}
