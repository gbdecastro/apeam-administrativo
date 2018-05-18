<?php

namespace App\Http\Controllers;

use App\Administradores;
use Illuminate\Http\Request;
use App\User;
use Auth;
use PDF;

class AdministradoresController extends Controller
{
    //Administrador
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getPage()
    {
        return view('administradores.index');
    }

    public function index()
    {
        $administradores =  Administradores::all();
        $count = 0;
        foreach ($administradores as $administrador) {
            $administradores[$count]->user = $administrador->user;
            $count++;
        }
        return $administradores;
    }

    public function notAdministradores(){
        return User::doesntHave('administrador')->get();
    }

    public function store(Request $request)
    {   
        $newAdmin = new Administradores();

        //caso tenha novos campos preencher e colocar no create
        //adicionar na tabela administrador
        User::find($request->input('id_user'))->administrador()->create();

    }
    public function update(Request $request, administradores $administradores)
    {
        //
    }

    public function destroy($administrador)
    {
        if(Auth::user()->id == $administrador)
            return "nao pode auto excluir";
        else
            Administradores::find($administrador)->delete();
    }

    public function downloadPDF()
    {
        $administradores = $this->index();
        
        $pdf = PDF::loadView('administradores.pdf', compact('administradores'));
        return $pdf->download('administradores.pdf');        
    }
}
