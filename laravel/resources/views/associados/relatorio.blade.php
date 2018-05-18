@extends('adminlte::pdf')
@section('yield_title')
    Associados
@endsection

@section('title')
    Associados
@endsection

@section('content')
<table class="table table-striped">
    <tbody>
        <tr>
            <td>Nome</td>
            <td>Data de Nascimento</td>
            <td>Cidade</td>
            <td>Celular</td>
            <td>Situação Financeira</td>                              
        </tr>
        @foreach($associados as $associado)
            <tr>
                <td>{{ $associado->name }}</td>
                <td>{{ $associado->dt_nascimento }}</td>
                <td>{{ $associado->tx_cidade }}</td>
                <td>{{ $associado->tx_celular }}</td>
                <td>{{ $associado->cs_financeiro }}</td>
            </tr>
        @endforeach                
    </tbody>
</table>
@endsection