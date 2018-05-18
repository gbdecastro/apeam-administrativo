@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/auth.css') }}">
    @yield('css')
@endsection

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">

                <img src="{{ asset('img/apeam.png') }}" width="100px" height="100px">

            </a>
        </div>
        <!-- /.login-logo -->

        <div class="login-box-body">
            <p class="login-box-msg">Iniciar Sessão</p>

            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="E-mail ou CPF Para Primeiro Acesso">
                    <span class="fa fa-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="fa fa-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> Manter Logado
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-success btn-block btn-flat">
                            Entrar
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <div class="auth-links">
                <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                   class="text-center"
                >Esqueci minha Senha</a>
                <br>
                @if (config('adminlte.register_url', 'register'))
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                       class="text-center"
                    >Associar-se</a>
                @endif
                <br>
                <a href="/"
                    class="text-center"
                >Menu Principal</a>              
            </div>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@endsection

@section('adminlte_js')
    <script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@endsection
