@extends('adminlte::page')

@section('title', 'Protocolos')

@section('content_header')
    <h1>
        <i class="fa fa-search"></i> Consultar
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-newspaper"></i> Protocolos</a>
        </li>
        <li class="active">
            <a href="#">
                <i class="fa fa-search"></i>Consultar</a>
        </li>
    </ol>
@endsection

@section('content')
<div class="row" id="protocolos">
    <div class="col-md-12">
        <div class="box box-info">         
            <div class="box-header">
                <a href="/protocolos" class="btn btn-app btn-info pull-right">
                    <span class="fa fa-newspaper" aria-hidden="true"></span> Protocolos
                </a>        
                <h3 class="box-title">
                    <i class="fa fa-search"></i> Consultar Protocolos
                </h3>                                  
            </div>
            <div class="box-body">  
                <hr>                
                <table id="table_protocolos" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nº Protocolo</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Serviço</th>
                            <th>Atendente</th>
                            <th>Realizado em</th>
                            <th>Documentos</th>
                            <th>Imprimir</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($protocolos as $protocolo)
                        <tr>
                            <td>{{ $protocolo->id_protocolo }}</td>
                            <td>{{ $protocolo->name }}</td>
                            <td>{{ $protocolo->nb_identificacao }}</td>
                            @if($protocolo->tx_servico != '')
                                <td>{{ $protocolo->tx_servico }}</td>
                            @else
                                <td>Ofício(s)</td>
                            @endif
                            <td>{{ $protocolo->atendente }}</td>
                            <td>{{ $protocolo->created_at }}</td>
                            <td>
                                <button id="{{ $protocolo->id_protocolo }}" class="btn btn-default documentos_protocolo">
                                    <i class="fa fa-file-alt"></i>
                                </button>
                            </td>
                            <td>
                                <button id="{{ $protocolo->id_protocolo }}" class="btn btn-primary imprimir">
                                    <i class="fa fa-print"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('protocolos.documentos')
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/protocolos/consultar.js') }}"></script>
@endsection