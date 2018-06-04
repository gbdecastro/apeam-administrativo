@extends('adminlte::master') @section('body')
    <div class="login-box">
        <div class="login-box-body">
            <div class="info-box bg-blue">
                <a href="https://apeam.net.br">
                <span class="info-box-icon">
                    <i class="fa fa-globe"></i>
                </span>

                <div class="info-box-content">
                    <h1 class="info-box-text">Site Principal</h1>
                </div>
                </a>
                <!-- /.info-box-content -->
            </div>
            <div class="info-box bg-red">
                <a href="register">
                <span class="info-box-icon">
                    <i class="fa fa-handshake "></i>
                </span>

                <div class="info-box-content">
                    <h1 class="info-box-text">Associar-se</h1>
                </div>
                </a>
                <!-- /.info-box-content -->
            </div>
            <div class="info-box bg-default">
                <a href="login">
                <span class="info-box-icon">
                    <i class="fas fa-sign-in-alt"></i>
                </span>

                <div class="info-box-content">
                    <h1 class="info-box-text">Entrar</h1>
                </div>
                </a>
                <!-- /.info-box-content -->
            </div>                          
        </div>
    </div>
@endsection