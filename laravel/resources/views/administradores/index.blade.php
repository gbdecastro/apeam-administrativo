@extends('adminlte::page')

@section('title', 'Administradores')

@section('content_header')
    <h1>
        <i class="fa fa-users"></i> 
        Administradores
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users"></i> Administradores</a></li>
    </ol>   
@endsection

@section('content')
<div class="row" id="administrador">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="overlay">
                <i class="fa fa-sync fa-spin"></i>
            </div>            
            <div class="box-header">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_create">
                    <span class="fa fa-plus" aria-hidden="true"></span> Novo Administrador
                </button>
                <a class="btn btn-info pull-right" href="{{ action('AdministradoresController@downloadPDF') }}"><i class="fa fa-download"></i> Baixar PDF</a>                            
            </div>
            <div class="box-body">   
                <table id="table_administradores" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Data de Cadastro</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="administrador in administradores">
                            <td>@{{ administrador.user.name }}</td>
                            <td>@{{ administrador.user.email }}</td>
                            <td>@{{ moment(administrador.created_at).format('DD/MM/Y') }}</td>
                            <td>
                                <button v-on:click.prevent="deletarAdministrador(administrador)" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>                                                                                         
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('administradores.create')
</div>
@endsection

@section('js')
<script src="{{ asset('js/administradores/index.js') }}"></script>
@endsection