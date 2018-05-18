<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Associados;
use App\Dependentes;
use Auth;
use PDF;

class DeclaracoesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function imprimirAssociado($id)
    {
        $associado = Associados::find($id);
        $associado->user = $associado->user()->get();

        $pdf = PDF::loadView('declaracoes.associado', compact('associado'));
        return $pdf->download('declaracao.pdf'); 
    }
    public function getDependentes(Request $request)
    {
        return Associados::find($request->input('id_user'))->dependentes()->get();
    }
    public function imprimirDependente(Request $request)
    {
        $associado = Associados::find($request->input('id_user'));
        $associado->user = $associado->user()->get();
        $associado->dependentes = $associado->dependentes()->where('nb_identificacao',$request->input('nb_identificacao'))->get();

        $pdf = PDF::loadView('declaracoes.dependente', compact('associado'));
        return $pdf->download('declaracao-dependente.pdf'); 
    }
}
