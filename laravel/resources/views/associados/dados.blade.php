<!-- Modal -->
<div class="modal fade" id="associados_dados" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Dados do Associado</h4>
            </div>
            <div class="modal-body">
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
                                    <label class="obrigatorio">Nome Completo</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label class="obrigatorio">Nome de Guerra</label>
                                    <input type="text" class="form-control" name="tx_nome_guerra">
                                </div>                            
                                <div class="form-group">
                                    <label class="obrigatorio">CPF/CNPJ</label>
                                    <input type="text" class="form-control mask" name="nb_identificacao">
                                </div>
                                <div class="form-group">
                                    <label class="obrigatorio">Data de Nascimento</label>
                                    <input type="text" class="form-control mask" name="dt_nascimento">
                                </div>  
                                <div class="form-group">
                                    <label class="obrigatorio">Gradução</label>
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
                            <button id="btn_pessoais" v-on:click="dadosPessoais()" class="btn btn-success"> Salvar </button>                                                                                             
                        </div>
                        <div class="tab-pane" id="enderecos">                
                            <form name="enderecos">
                                <div class="form-group">
                                        <label class="obrigatorio">CEP</label>
                                        <input type="text" class="form-control mask" name="nb_cep">
                                </div>
                                <div class="form-group">
                                        <label class="obrigatorio">Logradouro</label>
                                        <input type="text" class="form-control" name="tx_logradouro" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="obrigatorio">Numero</label>
                                    <input type="text" class="form-control" name="nb_numero">
                                </div>
                                <div class="form-group">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control" name="tx_complemento">
                                </div>
                                <div class="form-group">
                                    <label class="obrigatorio">Cidade</label>
                                    <input type="text" class="form-control" name="tx_cidade" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="obrigatorio">Bairro</label>
                                    <input type="text" class="form-control" name="tx_bairro" disabled>
                                </div>
                            </form>   
                            <button id="btn_enderecos" v-on:click="dadosEnderecos()" class="btn btn-success"> Salvar </button>                                                                                                                                       
                        </div>
                        <div class="tab-pane" id="contatos">
                            <form name="contatos">
                                <div class="form-group">
                                    <label class="obrigatorio">Residencial</label>
                                    <input type="text" class="form-control mask" name="tx_telefone" data-inputmask="'mask': ['(99) 9999-9999']" data-mask>
                                </div>
                                <div class="form-group">
                                    <label class="obrigatorio">Celular</label>
                                    <input type="text" class="form-control mask" name="tx_celular" data-inputmask="'mask': ['(99) 9.9999-9999']" data-mask>
                                </div>
                                <div class="form-group">
                                    <label>Comercial</label>
                                    <input type="text" class="form-control mask" name="tx_comercial" data-inputmask="'mask': ['(99) 9999-9999']" data-mask>
                                </div>
                            </form>   
                            <button id="btn_contatos" v-on:click="dadosContatos()" class="btn btn-success"> Salvar </button>                 
                        </div>
                        <div class="tab-pane" id="pagamento">
                            <div class="form-inline">
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
                                    <label class="obrigatorio">Matrícula</label>
                                    <input type="text" class="form-control" name="tx_matricula">
                                </div>
                            </form>
                            <form name="debito">
                                <div class="form-group">
                                    <label class="obrigatorio">Banco</label>
                                    <input type="text" class="form-control" name="tx_banco">
                                </div>
                                <div class="form-group">
                                    <label class="obrigatorio">Agência <b>com dígito</b></label>
                                    <input type="text" class="form-control" name="tx_agencia">
                                </div>  
                                <div class="form-group">
                                    <label class="obrigatorio">Conta Bancária <b>com dígito</b></label>
                                    <input type="text" class="form-control" name="tx_ctaBancaria">
                                </div>                                                                                                                                             
                            </form>                                                                       
                            <button id="btn_pagamento" v-on:click="dadosPagamento()" class="btn btn-success"> Salvar </button>
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
                                                    <button name="dpt_salvar1" v-on:click.prevent="salvarDependente(1)"  class="btn btn-app btn-success"> <i class="fa fa-save"></i>Salvar</button>
                                                    <button name="dpt_excluir1"  v-on:click.prevent="excluirDependente(1)" class="btn btn-app btn-danger"> <i class="fa fa-trash"></i>Excluir</button>
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
                                                    <button name="dpt_salvar2" v-on:click.prevent="salvarDependente(2)" class="btn btn-app btn-success"> <i class="fa fa-save"></i>Salvar</button>
                                                    <button name="dpt_excluir2" v-on:click.prevent="excluirDependente(2)" class="btn btn-app btn-danger"> <i class="fa fa-trash"></i>Excluir</button>
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
                                                    <button name="dpt_salvar3" v-on:click.prevent="salvarDependente(3)" class="btn btn-app btn-success"> <i class="fa fa-save"></i>Salvar</button>
                                                    <button name="dpt_excluir3"  v-on:click.prevent="excluirDependente(3)" class="btn btn-app btn-danger"> <i class="fa fa-trash"></i>Excluir</button>
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
                                                    <button name="dpt_salvar4" v-on:click.prevent="salvarDependente(4)" class="btn btn-app btn-success"> <i class="fa fa-save"></i>Salvar</button>
                                                    <button name="dpt_excluir4"  v-on:click.prevent="excluirDependente(4)" class="btn btn-app btn-danger"> <i class="fa fa-trash"></i>Excluir</button>
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
                                                    <button name="dpt_salvar5" v-on:click.prevent="salvarDependente(5)" class="btn btn-app btn-success"> <i class="fa fa-save"></i>Salvar</button>
                                                    <button name="dpt_excluir5" v-on:click.prevent="excluirDependente(5)" class="btn btn-app btn-danger"> <i class="fa fa-trash"></i>Excluir</button>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>                
            </div>
        </div>
    </div>
</div>