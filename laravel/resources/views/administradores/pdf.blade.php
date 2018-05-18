@extends('adminlte::pdf')

@section('yield_title')
    Administradores
@endsection

@section('title')
    Administradores
@endsection

@section('content')
    <div class="box-body table-responsive no-padding">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>Nome</td>
                    <td>E-mail</td>
                    <td>Data de Criação</td>                                                    
                </tr>
                @foreach($administradores as $administrador)
                    <tr>
                        <td>{{ $administrador->user->name }}</td>
                        <td>{{ $administrador->user->email }}</td>
                        <td>{{ $administrador->user->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach                
            </tbody>
        </table>
    </div>
@endsection