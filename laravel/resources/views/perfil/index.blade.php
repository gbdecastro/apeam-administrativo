@extends('adminlte::page') 

@section('css')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css') }}">
@endsection
@section('title', 'AdminLTE') @section('content_header')
<h1>
    <i class="fa fa-address-card "></i> Perfil</h1>
<ol class="breadcrumb">
    <li class="active">
        <a href="#">
            <i class="fa fa-address-card"></i> Perfil</a>
    </li>
</ol>
@endsection @section('content')
<div class="row">
    <div class="col-md-4">
        <!-- Profile Image -->
        <div class="box box-info">
            <div class="box-body box-profile">
                <input type="file" name="file_profile_image" id="file_profile_image">

                <img class="foto_perfil profile-user-img img-responsive img-circle" onerror="this.src='{{ asset('img/user.png')}}'" src="{{ asset('img/user/') }}/{{ hash('sha256',Auth::user()->id) }}.png"
                    alt="{{ ucwords(strtolower(Auth::user()->name)) }}">

                <h3 class="profile-username text-center">{{ ucwords(strtolower(Auth::user()->name)) }}</h3>

                <p class="text-muted text-center">
                    @if(Auth::user()->categoria == 1)
                        Administrador
                    @endif
                    @if(Auth::user()->categoria == 0)
                        Associado
                    @endif   
                </p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>E-mail</b>
                        <a class="pull-right">{{ Auth::user()->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Associado em</b>
                        <a class="pull-right">                            
                        {{ Auth::user()->created_at->format('d/m/Y') }}
                        </a>
                    </li>
                </ul>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-8">

        @php
            if(Auth::user()->categoria == 0){
                $nb_identificacao = Auth::user()->associado()->get();
                $nb_identificacao = ($nb_identificacao == []) ? $nb_identificacao[0]->nb_identificacao : '' ;                
            }else{
                $nb_identificacao = '';
            }
        @endphp  

        @if(Auth::user()->categoria == 0 and Auth::user()->email != $nb_identificacao)
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#pessoais" data-toggle="tab" id="tab-pessoais">Dados Pessoais </a>
                    </li>
                    <li>
                        <a href="#enderecos" data-toggle="tab" id="tab-enderecos">Dados de Endereço</a>
                    </li>
                    <li>
                        <a href="#contatos" data-toggle="tab" id="tab-contatos">Dados de Contato</a>
                    </li>                
                    <li>
                        <a href="#pagamento" data-toggle="tab" id="tab-pagamento">Dados de Pagamento</a>
                    </li>     
                    <li>
                        <a href="#dependentes" data-toggle="tab" id="tab-dependentes">Dependentes</a>
                    </li>                                    
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="pessoais">
                        <form name="pessoais" method="post">
                            <div class="form-group">
                                <label class="control-label obrigatorio">Nome Completo</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label obrigatorio">Nome de Guerra</label>
                                <input type="text" class="form-control" name="tx_nome_guerra">
                            </div>                            
                            <div class="form-group">
                                <label class="control-label obrigatorio">CPF/CNPJ</label>
                                <input type="text" class="form-control mask" name="nb_identificacao">
                            </div>
                            <div class="form-group">
                                <label class="control-label obrigatorio">Data de Nascimento</label>
                                <input type="text" class="form-control mask" name="dt_nascimento">
                            </div>  
                            <div class="form-group">
                                <label class="control-label obrigatorio">Gradução</label>
                                <select name="tx_graduacao" id="tx_graduacao" class="select2-native">
                                    <option value="AL.SD">AL SD</option>
                                    <option value="CB">CABO</option>
                                    <option value="OUTROS">OUTROS</option>
                                    <option value="SD">SOLDADO</option>
                                    <option value="1º SGT">1º SARGENTO</option>
                                    <option value="2º SGT">2º SARGENTO</option>
                                    <option value="3º SGT">3º SARGENTO</option>
                                    <option value="SO">SUB-OFICIAL</option>
                                </select>
                            </div>
                        </form>   
                        <button id="btn_pessoais" class="btn btn-success"> Salvar </button>                                                                                             
                    </div>
                    <div class="tab-pane" id="enderecos">                
                        <form name="enderecos">
                            <div class="form-group">
                                    <label class="control-label obrigatorio">CEP</label>
                                    <input type="text" class="form-control mask" name="nb_cep">
                            </div>
                            <div class="form-group">
                                    <label class="control-label obrigatorio">Logradouro</label>
                                    <input type="text" class="form-control" name="tx_logradouro" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label obrigatorio">Numero</label>
                                <input type="text" class="form-control" name="nb_numero">
                            </div>
                            <div class="form-group">
                                <label>Complemento</label>
                                <input type="text" class="form-control" name="tx_complemento">
                            </div>
                            <div class="form-group">
                                <label class="control-label obrigatorio">Cidade</label>
                                <input type="text" class="form-control" name="tx_cidade" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label obrigatorio">Bairro</label>
                                <input type="text" class="form-control" name="tx_bairro" disabled>
                            </div>
                        </form>   
                        <button id="btn_enderecos" class="btn btn-success"> Salvar </button>                                                                                                                                       
                    </div>
                    <div class="tab-pane" id="contatos">
                        <form name="contatos">
                            <div class="form-group">
                                <label>Residencial</label>
                                <input type="text" class="form-control mask" name="tx_telefone" data-inputmask="'mask': ['(99) 9999-9999']" data-mask>
                            </div>
                            <div class="form-group">
                                <label class="control-label obrigatorio">Celular</label>
                                <input type="text" class="form-control mask" name="tx_celular" data-inputmask="'mask': ['(99) 9.9999-9999']" data-mask>
                            </div>
                            <div class="form-group">
                                <label>Comercial</label>
                                <input type="text" class="form-control mask" name="tx_comercial" data-inputmask="'mask': ['(99) 9999-9999']" data-mask>
                            </div>
                        </form>   
                        <button id="btn_contatos" class="btn btn-success"> Salvar </button>                 
                    </div>
                    <div class="tab-pane" id="pagamento">
                        <div class="form-horizontal">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" id="chk_consignado"> Consignado em Folha de Pagamento para Funcionárioo do Estado 
                                </label>
                            </div>
                            <label></label>
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" id="chk_debito"> Débito Automático em Conta
                                </label>
                            </div>                        
                        </div>
                        <br>
                        <form name="consignado">
                            <div class="form-group">
                                <label class="control-label obrigatorio">Matrícula</label>
                                <input type="text" class="form-control" name="tx_matricula">
                            </div>
                        </form>
                        <form name="debito">
                            <div class="form-group">
                                <label class="control-label obrigatorio">Banco</label>
                                <input type="text" class="form-control" name="tx_banco">
                            </div>
                            <div class="form-group">
                                <label class="control-label obrigatorio">Agência <b>com dígito</b></label>
                                <input type="text" class="form-control" name="tx_agencia">
                            </div>  
                            <div class="form-group">
                                <label class="control-label obrigatorio">Conta Bancária <b>com dígito</b></label>
                                <input type="text" class="form-control" name="tx_ctaBancaria">
                            </div>                                                                                                                                             
                        </form>                                                                       
                        <button id="btn_pagamento" class="btn btn-success"> Salvar </button>
                    </div>
                    <div class="tab-pane" id="dependentes">
                        <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">1º Dependente</h3>
                                </div>                    
                                <div class="form-horizontal">
                                    <div class="box-body">                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label obrigatorio">Nome:</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" name="dpt_nome1" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label obrigatorio">CPF:</label>
                                            <div class="col-sm-10">
                                                <input class="form-control mask" name="dpt_cpf1" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ações:</label>
                                            <div class="col-sm-10">
                                                <button name="dpt_salvar1"  class="btn btn-app btn-success"> <i class="fa fa-save"></i>Salvar</button>
                                                <button name="dpt_excluir1" class="btn btn-app btn-danger"> <i class="fa fa-trash"></i>Excluir</button>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>  
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">2º Dependente</h3>
                                </div>                    
                                <div class="form-horizontal">
                                    <div class="box-body">                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label obrigatorio">Nome:</label>

                                            <div class="col-sm-10">
                                                <input class="form-control" name="dpt_nome2" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label obrigatorio">CPF:</label>
                                            <div class="col-sm-10">
                                                <input class="form-control mask" name="dpt_cpf2" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ações:</label>
                                            <div class="col-sm-10">
                                                <button name="dpt_salvar2" class="btn btn-app btn-success"> <i class="fa fa-save"></i>Salvar</button>
                                                <button name="dpt_excluir2" class="btn btn-app btn-danger"> <i class="fa fa-trash"></i>Excluir</button>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div> 
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">3º Dependente</h3>
                                </div>                    
                                <div class="form-horizontal">
                                    <div class="box-body">                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label obrigatorio">Nome:</label>

                                            <div class="col-sm-10">
                                                <input class="form-control" name="dpt_nome3" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label obrigatorio">CPF:</label>
                                            <div class="col-sm-10">
                                                <input class="form-control mask" name="dpt_cpf3" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ações:</label>
                                            <div class="col-sm-10">
                                                <button name="dpt_salvar3" class="btn btn-app btn-success"> <i class="fa fa-save"></i>Salvar</button>
                                                <button name="dpt_excluir3" class="btn btn-app btn-danger"> <i class="fa fa-trash"></i>Excluir</button>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div> 
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">4º Dependente</h3>
                                </div>                    
                                <div class="form-horizontal">
                                    <div class="box-body">                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label obrigatorio">Nome:</label>

                                            <div class="col-sm-10">
                                                <input class="form-control" name="dpt_nome4" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label obrigatorio">CPF:</label>
                                            <div class="col-sm-10">
                                                <input class="form-control mask" name="dpt_cpf4" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ações:</label>
                                            <div class="col-sm-10">
                                                <button name="dpt_salvar4" class="btn btn-app btn-success"> <i class="fa fa-save"></i>Salvar</button>
                                                <button name="dpt_excluir4" class="btn btn-app btn-danger"> <i class="fa fa-trash"></i>Excluir</button>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div> 
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">5º Dependente</h3>
                                </div>                    
                                <div class="form-horizontal">
                                    <div class="box-body">                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label obrigatorio">Nome:</label>

                                            <div class="col-sm-10">
                                                <input class="form-control" name="dpt_nome5" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label obrigatorio">CPF:</label>
                                            <div class="col-sm-10">
                                                <input class="form-control mask" name="dpt_cpf5" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Ações:</label>
                                            <div class="col-sm-10">
                                                <button name="dpt_salvar5" class="btn btn-app btn-success"> <i class="fa fa-save"></i>Salvar</button>
                                                <button name="dpt_excluir5" class="btn btn-app btn-danger"> <i class="fa fa-trash"></i>Excluir</button>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        @elseif(Auth::user()->email == $nb_identificacao)
            <div class="alert alert-danger alert-dismissible" id="alert_email">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i>{{ ucwords(strtolower(Auth::user()->name)) }}, Atenção!!!</h4>
                {{ ucwords(strtolower(Auth::user()->name)) }} esse é seu primeiro acesso, sendo obrigatório associar um E-mail à sua Conta e alteração de sua Senha, que deve conter no <b> <i>Mínimo 6 dígitos</i></b>.
                <br><br>
                <button type="button" data-toggle="modal" data-target="#form_email" class="btn btn-default">Clique Aqui para Associar!</button>
            </div>

            @include('perfil.form-email')

        @endif        
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@section('js')
    <script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('js/perfil/perfil.js') }}"></script>
    <script src="{{ asset('js/perfil/validacao.js') }}"></script>
    <script src="{{ asset('js/perfil/preencher.js') }}"></script>
@endsection