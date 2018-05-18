<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title_page')</title>
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.css') }}"> -->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">     
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
</head>

<body>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <span class="logo-mini">
                        <img src="{{ asset('img/apeam.png') }}" alt="" width="50px" height="50px">
                        Associação de Praças Estado do Amazonas
                    </span>
                    <h3 class="box-title pull-right">@yield('title')</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                   @yield('content')
                </div>
            </div>            
        </div>
    </div> 
</body>
</html>