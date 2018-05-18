<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
    <title>Declaração de Associado</title>
</head>
<body>
    <center>
        <img src="{{ asset('img/apeam.png') }}" width="70px" height="70px">
        <b><h4>ASSOCIAÇÃO DOS PRAÇAS DO ESTADO DO AMAZONAS - APEAM</h4></b>
        <br>
        <br>
        <br>
        <b><h2>PROTOCOLO</h2></b>
        <br><br>
        <p>
            Declaramos que para os devidos fins, que o senhor(a) <i><b>{{ $nome }}</b></i>,
             portador(a) do <b>CPF: {{ $cpf }}</b> registrou o <b>PROTOCOLO Nº <i>{{ $id_protocolo }}</i></b> na Data: <b>{{ strftime('%d de %B de %Y', strtotime('today')) }}</b> junto a essa Entidade.
        </p>
    </center>
        <p class="pull-right">Manaus, {{ strftime('%d de %B de %Y', strtotime('today')) }}</p>
    <center>
        <br>
        <br>
        <br>
        <br>
        <hr class="hr-declaracoes">
        <p>APEAM - Associação dos Praças do Estado do Amazonas <br>
        <p>CNPJ - 19.0024.722/0001-04 <br>
        <p><i>Rua Presidente Arthur Bernardes, nº 12, Parque das Laranjeiras - Manaus/AM - CEP: 69.058-241</i></p>
        <small>apeam.16mb.com / Fone: (92) 99130-1190 </small>  
    </center>
</body>
</html>