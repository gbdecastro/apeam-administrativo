<!-- Modal -->
<div class="modal fade" id="form_email" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Configurando Conta</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('/perfil/primeiroAcesso') }}" class="form-inline" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="E-mail">
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
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block btn-flat">
                            Salvar
                        </button>
                    </div>                                     
                </form>
            </div>
        </div>
    </div>
</div>    