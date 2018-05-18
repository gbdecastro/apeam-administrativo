@extends('adminlte::page')

@section('title', 'Protocolos')

@section('content_header')
    <h1>
        <i class="fa fa-newspaper"></i> 
        Protocolos
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-newspaper"></i> Protocolos</a></li>
    </ol>   
@endsection

@section('content')
<div class="row" id="administrador">
    <div class="col-md-12">
        <div class="box box-info">           
            <div class="box-header">
                <a href="/protocolos/consultar" class="btn btn-app btn-info pull-right">
                    <span class="fa fa-search" aria-hidden="true"></span> Consultar
                </a>
                <h3 class="box-title">Protocolos</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-danger">
                            <div class="box-header">
                                <h4 class="box-title">Tipo de Serviço</h4>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="" class="label-control obrigatorio">Selecione o Atendimento</label>
                                    <select id="tipo_atendimento" class="select2-native form-control">
                                        <option value="Ofício">Ofício</option>
                                        <option value="Serviços">Serviços</option>
                                    </select>
                                </div>                         
                            </div>
                        </div>                   
                    </div>
                    <div class="col-md-8">
                        <div id="detalhamento" class="box box-danger">
                            <div class="box-header">
                                <h4 class="box-title">Detalhamento</h4>
                            </div>
                            <div class="box-body">
                                <div id="servicos">
                                    <div class="form-group">
                                        <label for="" class="label-control obrigatorio">Associado:</label>
                                        <select class="form-control select2-native" id="associado" required autofocus>
                                            @foreach($associados as $associado)
                                                <option value="{{ $associado->id_user }}">{{ $associado->name }}</option>
                                            @endforeach
                                        </select>                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label-control obrigatorio">Serviço:</label>
                                        <select id="tipo_servico" class="select2-native form-control">
                                            <option value="Jurídico">Jurídico</option>
                                            <option value="Aluguel da Sede">Aluguel da Sede</option>
                                            <option value="Hotel de Trânsito">Hotel de Trânsito</option>
                                            <option value="Airsoft">Airsoft</option>
                                            <option value="Corte de Cabelo">Corte de Cabelo</option>                                            
                                            <option value="Administrativo">Administrativo</option>
                                            <option value="Financeiro">Financeiro</option>
                                        </select>
                                    </div>
                                    <button id="btn_imprimir_protocolo_servico" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Imprimir Protocolo</button>                                                         
                                </div>
                                <div id="oficio">
                                    <div class="form-group">
                                        <label for="" class="label-control obrigatorio">CPF:</label>
                                        <input type="text" class="form-control" id="cpf">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label-control obrigatorio">Nome:</label>
                                        <input type="text" class="form-control" id="tx_nome">
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="" class="label-control obrigatorio">Ofício:</label>
                                        <input type="file" id="file_oficio" multiple>
                                    </div>
                                    <button id="btn_imprimir_protocolo_oficio" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Imprimir Protocolo</button>                                
                                </div>
                                <div id="finalizar">
                                    <div class="form-group">
                                        <label for="" class="label-control obrigatorio">Confirmação:</label>
                                        <input type="file" id="file_confirmacao">
                                    </div>
                                    <button id="btn_salvar" class="btn btn-success pull-right"><i class="fa fa-save"></i> Salvar</button>                                
                                    <button id="btn_voltar_detalhamento" class="btn btn-default pull-left"><i class="fa fa-angle-left"></i> Detalhamento</button>
                                </div>
                            </div>
                        </div>                   
                    </div>                    
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/protocolos/index.js') }}"></script>
<script src="{{ asset('js/protocolos/validacao.js') }}"></script>
@endsection