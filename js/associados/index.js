const app = new Vue({
    el: '#associados',
    created: function () {
        this.getAssociados();
    },
    data: {
        associados: [],
        dadosAssociados: [],
    },
    methods: {
        getAssociados: function () {

            $('#table_associados').DataTable().destroy();
            $('#table_associados').hide();

            $('.overlay').show();

            var url = 'associados/all';

            NProgress.start();

            axios.get(url).then(response => {
                
                //joga na lista de associados
                this.associados = response.data;

            }).then(() => {
                //Plugin Datatables
                $('#table_associados').DataTable({
                    "order": [],
                    "oLanguage": {
                      "sUrl": "js/libs/datatables_ptbr.json"
                    }
                });

                $('#table_associados').show();
                $('.overlay').hide();
            });
        },
        PreencherDadosAssociado: function (associado) {

            this.dadosAssociados = associado;

            //INICIO TAB-PESSOAIS
            
            $('input[name="name"]').val(this.dadosAssociados.user.name);

            $('input[name="tx_nome_guerra"]').val(this.dadosAssociados.tx_nome_guerra);

            $('input[name="nb_identificacao"]').val(this.dadosAssociados.nb_identificacao);

            if(this.dadosAssociados.dt_nascimento){
                var parts = this.dadosAssociados.dt_nascimento.split('-');
                var dmyDate = parts[2] + '/' + parts[1] + '/' + parts[0];  
                $('input[name="dt_nascimento"]').val(dmyDate);
            }          

            if(this.dadosAssociados.tx_graduacao)
                $('#tx_graduacao').val(this.dadosAssociados.tx_graduacao).trigger('change.select2');

            //TRATANDO ABA
            if(this.dadosAssociados.tx_nome_guerra == null || this.dadosAssociados.nb_identificacao == null || this.dadosAssociados.dt_nascimento == null || this.dadosAssociados.tx_graduacao == null){
                $('#tab-pessoais').html('Dados Pessoais <i class="fa fa-times"></i>');
                $('#tab-pessoais').css('color', '#dd4b39');  
            }else{
                $('#tab-pessoais').html('Dados Pessoais <i class="fa fa-check"></i>');
                $('#tab-pessoais').css('color', '#00a65a');                
            }      

            //FIM TAB-PESSOAIS

            //INICIO TAB-ENDERECO

            $('input[name="nb_cep"]').val(this.dadosAssociados.nb_cep);

            $('input[name="tx_logradouro"]').val(this.dadosAssociados.tx_logradouro);
            $('input[name="nb_numero"]').val(this.dadosAssociados.nb_numero);
            $('input[name="tx_complemento"]').val(this.dadosAssociados.tx_complemento);
            $('input[name="tx_cidade"]').val(this.dadosAssociados.tx_cidade);
            $('input[name="tx_bairro"]').val(this.dadosAssociados.tx_bairro);

            //TRATANDO ABA
            if(this.dadosAssociados.tx_logradouro == null || this.dadosAssociados.nb_numero == null || this.dadosAssociados.tx_cidade == null || this.dadosAssociados.tx_bairro == null){
                $('#tab-enderecos').html('Dados de Endereço <i class="fa fa-times"></i>');
                $('#tab-enderecos').css('color', '#dd4b39');  
            }else{
                $('#tab-enderecos').html('Dados de Endereço <i class="fa fa-check"></i>');
                $('#tab-enderecos').css('color', '#00a65a');                
            }                 

            //FIM TAB-ENDERECO

            //INICIO TAB-CONTATO
            $('input[name="tx_telefone"]').val(this.dadosAssociados.tx_telefone);
            $('input[name="tx_celular"]').val(this.dadosAssociados.tx_celular);
            $('input[name="tx_comercial"]').val(this.dadosAssociados.tx_comercial);

            //TRATANDO ABA
            if(this.dadosAssociados.tx_telefone == null || this.dadosAssociados.tx_celular == null){
                $('#tab-contatos').html('Dados de Contatos <i class="fa fa-times"></i>');
                $('#tab-contatos').css('color', '#dd4b39');  
            }else{
                $('#tab-contatos').html('Dados de Contatos <i class="fa fa-check"></i>');
                $('#tab-contatos').css('color', '#00a65a');                
            }              
            //FIM TAB-CONTATO    

            //INICIO TAB-PAGAMENTO

            $('input[name="tx_matricula"]').val(this.dadosAssociados.tx_matricula);
            $('input[name="tx_banco"]').val(this.dadosAssociados.tx_banco);
            $('input[name="tx_agencia"]').val(this.dadosAssociados.tx_agencia);
            $('input[name="tx_ctaBancaria"]').val(this.dadosAssociados.tx_ctaBancaria);

            //TRATANDO ABA
            if(this.dadosAssociados.tx_matricula == null){
            
                //Por Conta Bancaria
                
                //mudo checks e qual form deve aparecer
                $('form[name="consignado"]').hide();
                $('form[name="debito"]').show();
                $('#chk_debito').iCheck('check');                
                $('#chk_consignado').iCheck('uncheck');                

                //Se Matricula nula mostra error, caso tenha dados de conta ai sim faz o check
                $('#tab-pagamento').html('Dados de Pagamento <i class="fa fa-times"></i>');
                $('#tab-pagamento').css('color', '#dd4b39');  

                if(this.dadosAssociados.tx_agencia != null && this.dadosAssociados.tx_ctaBancaria != null){
                    $('#tab-pagamento').html('Dados de Pagamento <i class="fa fa-check"></i>');
                    $('#tab-pagamento').css('color', '#00a65a');                     
                }                 
            }else{

                $('form[name="consignado"]').show();
                $('form[name="debito"]').hide();
                $('#chk_debito').iCheck('uncheck');                
                $('#chk_consignado').iCheck('check');

                $('#tab-pagamento').html('Dados de Pagamento <i class="fa fa-check"></i>');
                $('#tab-pagamento').css('color', '#00a65a');                                     
            }
            //FIM TAB-PAGAMENTO

            this.aplicarMascara();
            this.getDependentes(this.dadosAssociados.dependentes);
        },
        getDadosAssociadosForm: function (){
            //INICIO TAB-PESSOAIS
            
            this.dadosAssociados.user.name = $('input[name="name"]').val();
            this.dadosAssociados.tx_nome_guerra = $('input[name="tx_nome_guerra"]').val();
            this.dadosAssociados.dt_nascimento = $('input[name="dt_nascimento"]').val();
            this.dadosAssociados.nb_identificacao = $('input[name="nb_identificacao"]').val();
            this.dadosAssociados.tx_graduacao = $('#tx_graduacao').val();

            //FIM TAB-PESSOAIS

            //INICIO TAB-ENDERECO

            this.dadosAssociados.nb_cep = $('input[name="nb_cep"]').val();

            this.dadosAssociados.tx_logradouro = $('input[name="tx_logradouro"]').val();
            this.dadosAssociados.nb_numero = $('input[name="nb_numero"]').val();
            this.dadosAssociados.tx_complemento = $('input[name="tx_complemento"]').val();
            this.dadosAssociados.tx_cidade = $('input[name="tx_cidade"]').val();
            this.dadosAssociados.tx_bairro = $('input[name="tx_bairro"]').val();            

            //FIM TAB-ENDERECO

            //INICIO TAB-CONTATO
            this.dadosAssociados.tx_telefone = $('input[name="tx_telefone"]').val();
            this.dadosAssociados.tx_celular = $('input[name="tx_celular"]').val();
            this.dadosAssociados.tx_comercial = $('input[name="tx_comercial"]').val();

            //FIM TAB-CONTATO    

            //INICIO TAB-PAGAMENTO

            this.dadosAssociados.tx_matricula = $('input[name="tx_matricula"]').val();
            this.dadosAssociados.tx_banco = $('input[name="tx_banco"]').val();
            this.dadosAssociados.tx_agencia = $('input[name="tx_agencia"]').val();
            this.dadosAssociados.tx_ctaBancaria = $('input[name="tx_ctaBancaria"]').val();            
        },
        aplicarMascara: function(){
            //associados.dados
            $('input[name="nb_identificacao"]').inputmask({mask: ['999.999.999-99', '99.999.999/9999-99']});
            $('input[name="dt_nascimento"]').inputmask({mask: '99/99/9999'});
            $('input[name="nb_cep"]').inputmask({mask: '99.999-999'});
            $('input[name="tx_telefone"]').inputmask({mask: '(99) 9999-9999'});       
            $('input[name="tx_celular"]').inputmask({mask: '(99) 9.9999-9999'});            
            $('input[name="tx_comercial"]').inputmask({mask: '(99) 9999-9999'});
        },
        getMunicipios: function(){

            $('select[name="form_relatorio_municipio"]').removeClass('select2-native');

            axios.get('associados/municipios').then((response)=>{

                var options = '<option value="">---Selecione uma Opção---</option>';

                $.each(response.data, function (inde, value) {
                    options = options + '<option value="' + value.tx_cidade + '">' + value.tx_cidade + '</option>';
                });

                $('select[name="form_relatorio_municipio"]').html(options);
                
            }).then(()=>{
                //Mascara de Data Nascimento
                $('input[name="form_relatorio_dt_nascimento"]').inputmask({mask: '99/99/9999'});

                $('select[name="form_relatorio_municipio"]').addClass('select2-native');

            }).catch(error => {
                toastr.error(error);
            });

        },
        mudarSituacao:  function(associado){
            
            if(associado.cs_situacao == 1)
                var url = 'associados/0/'+associado.id_user;
            else
                var url = 'associados/1/'+associado.id_user;
            
            axios.post(url).then((response)=>{
                if(associado.cs_situacao == 1)
                    toastr.success('Associado Desativado');
                else
                    toastr.success('Associado Ativado');
                this.getAssociados();
            }).catch(error => {
                toastr.error(error);
            });

        },
        situacaoFinanceira: function(associado){
            
            axios.post('associados/situacaoFinanceira',associado).then((response)=>{
                toastr.success('Situação Financeiro do Associado '+associado.user.name+' Atualizada');
                this.getAssociados();
            }).catch(error => {
                toastr.error(error);
            });
        },
        dadosPessoais: function(){

            if(validarDadosPessoais()){
                this.getDadosAssociadosForm();
            
                btnSpinAjax($('#btn_pessoais'),$('#btn_pessoais').html());

                var url = 'associados/dadosPessoais';

                axios.post(url,this.dadosAssociados).then((response)=>{
                    toastr.success('Dados Pessoais do Associado '+this.dadosAssociados.user.name+' atualizados');
                    $('#associados_dados').modal('hide');
                }).catch(error => {
                    toastr.error(error);
                });
                this.getAssociados();
            }
        },
        dadosEnderecos: function(){

            if(validarDadosEnderecos()){
                this.getDadosAssociadosForm();

                btnSpinAjax($('#btn_enderecos'),$('#btn_enderecos').html());
                
                var url = 'associados/dadosEnderecos';
    
                axios.post(url,this.dadosAssociados).then((response)=>{
                    toastr.success('Dados de Endereços do Associado '+this.dadosAssociados.user.name+' atualizados');
                    $('#associados_dados').modal('hide');
                }).catch(error => {
                    toastr.error(error);
                });
    
                this.getAssociados();
            }
        },
        dadosContatos: function(){

            if(this.dadosContatos()){
                this.getDadosAssociadosForm();
            
                btnSpinAjax($('#btn_contatos'),$('#btn_contatos').html());
                
                var url = 'associados/dadosContatos';
    
                axios.post(url,this.dadosAssociados).then((response)=>{
                    toastr.success('Dados de Contatos do Associado '+this.dadosAssociados.user.name+' atualizados');
                    $('#associados_dados').modal('hide');
                }).catch(error => {
                    toastr.error(error);
                });
    
                this.getAssociados();
            }
        },
        dadosPagamento: function(){

            this.getDadosAssociadosForm();
            
            btnSpinAjax($('#btn_pagamento'),$('#btn_pagamento').html());
            
            var url = 'associados/dadosPagamento';

            axios.post(url,this.dadosAssociados).then((response)=>{
                toastr.success('Dados de Pagamento do Associado '+this.dadosAssociados.user.name+' atualizados');
                $('#associados_dados').modal('hide');
            }).catch(error => {
                toastr.error(error);
            });

            this.getAssociados();
        },
        getDependentes: function(dependentes){

            $('#tab-dependentes').html('Dependentes <i class="fa fa-times"></i>');
            $('#tab-dependentes').css('color', '#dd4b39');  
        
            for (let index = 1; index < 6; index++) {
                $('input[name="dpt_nome'+index+'"]').val('');
                $('input[name="dpt_cpf'+index+'"]').val('');
                $('input[name="dpt_cpf'+index+'"]').prop("disabled",false);
                $('input[name="dpt_cpf'+index+'"]').inputmask('remove');                       
            }

            i=1;

            $.each(dependentes, function (index, value) {     
    
                $('input[name="dpt_nome'+i+'"]').val(value.name);
                $('input[name="dpt_cpf'+i+'"]').val(value.nb_identificacao);
    
                if(value.nb_identificacao != null){
                    $('input[name="dpt_cpf'+i+'"]').prop("disabled",true);
                }
                
                if(value.name == null || value.nb_identificacao == null){
                    $('#tab-dependentes').html('Dependentes <i class="fa fa-times"></i>');
                    $('#tab-dependentes').css('color', '#dd4b39');  
                }else{
                    $('#tab-dependentes').html('Dependentes <i class="fa fa-check"></i>');
                    $('#tab-dependentes').css('color', '#00a65a');                
                }            
                i++;
            });
    
            for (let index = 1; index < 6; index++) {
                $('input[name="dpt_cpf'+index+'"]').inputmask({mask: '999.999.999-99'});
            }
        },
        salvarDependente: function(numForm){
            btnSpinAjax($('button[name="dpt_salvar'+numForm+'"]'),$('button[name="dpt_salvar'+numForm+'"]').html());

            name = $('input[name="dpt_nome'+numForm+'"]').val();
            nb_identificacao = $('input[name="dpt_cpf'+numForm+'"]').val();
            id_user = this.dadosAssociados.id_user;
        
            dados = {
                name: name,
                nb_identificacao: nb_identificacao,
                id_user: id_user
            }

            $.ajax({
                url: 'associados/salvarDependente',
                type: 'post',
                data: dados
            }).done(function(){
                toastr.success('Dependente '+name+' registrado com Sucesso!');
            });
            $('#associados_dados').modal('hide');          
            this.getAssociados();
        },
        excluirDependente: function(numForm){

            btnSpinAjax($('button[name="dpt_excluir'+numForm+'"]'),$('button[name="dpt_excluir'+numForm+'"]').html());
            nb_identificacao = $('input[name="dpt_cpf'+numForm+'"]').val();

            dados = {
                nb_identificacao: nb_identificacao
            }
            $.ajax({
                url: 'associados/excluirDependente',
                type: 'delete',
                data: dados
            }).done(function(){
                toastr.success('Dependente Excluído com Sucesso!');
            });       
            $('#associados_dados').modal('hide');
            this.getAssociados();
        }        
    }

});