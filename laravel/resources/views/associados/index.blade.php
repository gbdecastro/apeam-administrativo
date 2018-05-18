@extends('adminlte::page')

@section('title', 'Associados')

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css') }}">
@endsection

@section('content_header')
    <h1>
        <i class="fa fa-handshake"></i> 
        Associados
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-handshake"></i> Associados</a></li>
      </ol>    
@endsection

@section('content')
<div class="row" id="associados">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="overlay">
                <i class="fa fa-sync fa-spin"></i>
            </div>        
            <div class="box-header">
                <h3 class="box-title">Associados</h3>
                <button v-on:click.prevent="getMunicipios()" data-toggle="modal" data-target="#form_relatorios" class="btn btn-info pull-right">
                    <i class="fa fa-book"></i> Relatórios
                </button>                                
            </div>
            <div class="box-body">
                <table id="table_associados" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Data de Cadastro</th>
                            <th>Visualizar Dados</th>
                            <th>Financeiro</th>
                            <th>Ativo/Desativado</th>
                            <th>Mudar Situação</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="associado in associados">
                            <td>@{{ associado.user.name }}</td>
                            <td>@{{ associado.user.email }}</td>
                            <td>@{{ moment(associado.created_at).format('DD/MM/Y') }}</td>
                            <td>
                                <button v-on:click="PreencherDadosAssociado(associado)" data-toggle="modal" data-target="#associados_dados" class="btn btn-default">
                                    <i class="fa fa-address-card"></i>
                                </button>                                   
                            </td>
                            <td>
                                <button class="btn btn-success" v-on:click="situacaoFinanceira(associado)" v-if="associado.cs_financeiro == 1"> Em Dia</button>
                                <button class="btn btn-warning" v-on:click="situacaoFinanceira(associado)" v-if="associado.cs_financeiro == 0"> Inadimplente</button>
                            </td>
                            <td>
                                <button v-if="associado.cs_situacao == 1" class="btn btn-success">
                                    Ativo
                                </button>   
                                <button v-if="associado.cs_situacao == 0"  class="btn btn-danger">
                                    Inativo
                                </button>
                            </td>                           
                            <td>
                                <button v-if="associado.cs_situacao == 1" v-on:click.prevent="mudarSituacao(associado)" class="btn btn-block btn-social btn-danger btn-situacao">
                                    <i class="fa fa-eye-slash"></i> Desativar
                                </button>                                                                                         
                                <button v-if="associado.cs_situacao == 0" v-on:click.prevent="mudarSituacao(associado)" class="btn btn-block btn-social btn-success btn-situacao">
                                    <i class="fa fa-eye"></i> Ativar
                                </button>                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('associados.dados')
    @include('associados.form_relatorios')
</div>
@endsection

@section('js')
<script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('js/associados/index.js') }}"></script>
<script src="{{ asset('js/associados/cep_checkbox.js') }}"></script>
<script src="{{ asset('js/associados/relatorio.js') }}"></script>
<script src="{{ asset('js/associados/validacao.js') }}"></script>
@endsection