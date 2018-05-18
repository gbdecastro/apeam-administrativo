<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administrativo - APEAM</title>
    <!-- Tell the browser to be responsive to screen width -->

    <link rel="shortcut icon" href="favicon.ico">
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/fontawesome-all.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
    <!-- Ng Progress -->
    <link rel="stylesheet" href="{{ asset('css/nprogress.css') }}">    
    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('js/libs/moment.js') }}"></script>

<script src="{{ asset('js/libs/nprogress.js') }}"></script>

<script src="{{ asset('js/libs/select2.js') }}"></script>

<script src="{{ asset('js/libs/toastr.js') }}"></script>
<script src="{{ asset('js/libs/toastr.config.js') }}"></script>

<script src="{{ asset('js/libs/datatables.js') }}"></script>
<script src="{{ asset('js/libs/datatables_bootstrap.js') }}"></script>

<script src="{{ asset('js/libs/chart.min.js') }}"></script>

<script src="{{ asset('js/libs/inputmarks.js') }}"></script>

<script src="{{ asset('js/validacoes/cpf.js') }}"></script>

@yield('adminlte_js')

<script src="{{ asset('js/config.js') }}"></script>
</body>
</html>