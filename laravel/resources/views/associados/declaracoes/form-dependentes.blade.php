@extends('adminlte::page') @section('title', 'Declaração Associado') @section('content_header')
<h1>
    <i class="fa fa-child"></i> Dependentes
</h1>
<ol class="breadcrumb">
    <li>
        <a href="#">
            <i class="fa fa-address-book"></i> Declarações</a>
    </li>
    <li class="active">
        <a href="#">
            <i class="fa fa-child"></i>Dependentes</a>
    </li>
</ol>
@endsection @section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-info">
            <div class="overlay">
                <i class="fa fa-sync fa-spin"></i>
            </div>           
            <div class="box-header with-border">
                <h3 class="box-title">
                    Filtro de Pesquisa
                </h3>
            </div>
            <div class="box-body">
                <div class="form-horizontal">
                    <!-- Associado -->
                    <div class="form-group">
                        <label for="tx_name" class="col-md-4 control-label obrigatorio">Associados:</label>
                        <div class="col-md-6">
                            <select class="form-control select2-native" name="associado" required autofocus>
                            <option value="">--Selecione uma Opção---</option>
                            </select>
                        </div>
                    </div>
                    <!-- Dependentes -->
                    <div class="form-group">
                        <label for="tx_name" class="col-md-4 control-label obrigatorio">Dependentes:</label>
                        <div class="col-md-6">
                            <select class="form-control select2-native" name="dependentes" required autofocus></select>
                        </div>
                    </div>                    
                    <!-- Submit -->
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button name="btn_imprimir" type="submit" class="btn btn-success">
                            Imprimir Declaração
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('js')
    <script src="{{asset('js/associados/declaracoes/dependentes.js')}}"></script>
@endsection