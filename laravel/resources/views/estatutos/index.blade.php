@extends('adminlte::page')

@section('title', 'Estatutos')

@section('css')
@endsection

@section('content_header')
    <h1>
        <i class="fa fa-clone"></i> 
        Estatutos
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-clone"></i> Estatutos</a></li>
      </ol>    
@endsection

@section('content')
<div class="row" id="associados">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
                @if(Auth::user()->categoria == 1)
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_create">
                        <span class="fa fa-plus" aria-hidden="true"></span> Novo Estatuto
                    </button>         
                @endif
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($response as $response)
                            @if($response['tipo'] == 'sucesso')
                                <div class="alert alert-success alert-dismissible">
                            @else
                                <div class="alert alert-danger alert-dismissible">
                            @endif
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>                            
                                <h4>{{ $response['title'] }}</h4>
                                <p>{{ $response['content'] }}</p>
                            </div>
                        @endforeach                          
                    </div>
                </div>                
                <div class="row" id="estatutos">
                    @foreach($files as $file)
                        <div class="col-md-4">
                            <object height="400px" width="100%" data="{{ URL::to('/')}}/{{ $file->getPathname() }}" type="pdf"></object>
                            <a class="btn btn-social btn-primary pull-left" target="_blank" href="{{ URL::to('/')}}/{{ $file->getPathname() }}">
                                <i class="fa fa-download">
                                </i> 
                                {{ ucwords($file->getFilename()) }}
                            </a>                                
                            @if(Auth::user()->categoria == 1)
                            <form action="{{ url('/declaracoes/estatutos/'.$file->getBasename('.pdf')) }}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-social btn-danger pull-right">
                                    <i class="fa fa-trash">
                                    </i> 
                                    Excluir
                                </button>                                  
                            </form>                                                          
                            @endif                            
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('estatutos.create')
</div>
@endsection

@section('js')
@endsection