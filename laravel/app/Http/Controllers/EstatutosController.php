<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;

class EstatutosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllFiles()
    {
        return File::allFiles('estatutos');
    }

    public function getPage()
    {   
        $files = $this->getAllFiles();
        $response = [];
        return view('estatutos.index',compact('files','response'));
    }

    public function create(Request $request)
    {
        // getting all of the post data
        $files = $request->file('estatutos');

        // Making counting of uploaded images
        $file_count = count($files);

        // start count how many uploaded
        $uploadcount = 0;

        $response = [];

        foreach($files as $file) {
            $rules = array('file' => 'required|mimes:pdf');

            $validator = Validator::make(array('file'=> $file), $rules);

            if($validator->passes()){
                $destinationPath = 'estatutos';
                $filename = $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $uploadcount ++;
            }else{
                $filename = $file->getClientOriginalName();
                array_push($response, array('title'=> 'Error ao Enviar o arquivo '.$filename, 'content' => 'Somente Arquivos PDF!', 'tipo' => 'error'));
            }
        }

        if($uploadcount == $file_count){
            array_push($response, array('title'=> 'Arquivo '.$filename.' enviado com Sucesso!', 'content' => 'Novo Estatuto Enviado!', 'tipo' => 'sucesso'));
        }

        $files = $this->getAllFiles();
        return view('estatutos.index',compact('files','response'));
        
    }
    
    public function delete($name)
    {
        File::delete('estatutos/'.$name.'.pdf');
        return redirect('/declaracoes/estatutos');
    }

}
