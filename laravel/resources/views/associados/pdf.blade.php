@extends('adminlte::pdf')
@section('yield_title')
    Associados
@endsection

@section('title')
    Associados
@endsection

@section('content')
<div class="box-body table-responsive no-padding">
    <table class="table table-striped">
        <tbody>
            <tr>
                <td>Nome</td>
                <td>E-mail</td>
                <td>CPF</td>
                <td>Cidade</td>
                <td>Data de Nascimento</td>
                <td>Data de Criação</td>                                                    
            </tr>
            @foreach($associados as $associado)
                <tr>
                    <td>{{ $associado->user->name }}</td>
                    <td>{{ $associado->user->email }}</td>
                    <td>{{ $associado->nb_identificacao }}</td>
                    <td>{{ $associado->tx_cidade }}</td>
                    <td>{{ $associado->dt_nascimento }}</td>
                    <td>{{ $associado->user->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach                
        </tbody>
    </table>
</div>
@endsection