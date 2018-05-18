function loadPerfil(){
    //LOAD PERFIL
    $.ajax({
        url:        'perfil/carregarPerfil',
        type:       'get',
        dataType:   'json'
    }).done(function(response){
        if(response.length > 0){
            response = response[0];
            //INICIO TAB-PESSOAIS
            
            $('input[name="tx_nome_guerra"]').val(response.tx_nome_guerra);

            $('input[name="nb_identificacao"]').val(response.nb_identificacao);

            if(response.dt_nascimento){
                var parts = response.dt_nascimento.split('-');
                var dmyDate = parts[2] + '/' + parts[1] + '/' + parts[0];  
                $('input[name="dt_nascimento"]').val(dmyDate);
            }          
            
            $('#tx_graduacao').val(response.tx_graduacao).trigger('change.select2');

            //TRATANDO ABA
            if(response.tx_nome_guerra == null || response.nb_identificacao == null || response.dt_nascimento == null || response.tx_graduacao == null){
                $('#tab-pessoais').html('Dados Pessoais <i class="fa fa-times"></i>');
                $('#tab-pessoais').css('color', '#dd4b39');  
            }else{
                $('#tab-pessoais').html('Dados Pessoais <i class="fa fa-check"></i>');
                $('#tab-pessoais').css('color', '#00a65a');                
            }      

            //FIM TAB-PESSOAIS

            //INICIO TAB-ENDERECO

            $('input[name="nb_cep"]').val(response.nb_cep);

            $('input[name="tx_logradouro"]').val(response.tx_logradouro);
            $('input[name="nb_numero"]').val(response.nb_numero);
            $('input[name="tx_complemento"]').val(response.tx_complemento);
            $('input[name="tx_cidade"]').val(response.tx_cidade);
            $('input[name="tx_bairro"]').val(response.tx_bairro);

            //TRATANDO ABA
            if(response.tx_logradouro == null || response.nb_numero == null || response.tx_cidade == null || response.tx_bairro == null){
                $('#tab-enderecos').html('Dados de Endereço <i class="fa fa-times"></i>');
                $('#tab-enderecos').css('color', '#dd4b39');  
            }else{
                $('#tab-enderecos').html('Dados de Endereço <i class="fa fa-check"></i>');
                $('#tab-enderecos').css('color', '#00a65a');                
            }                 

            //FIM TAB-ENDERECO

            //INICIO TAB-CONTATO
            $('input[name="tx_telefone"]').val(response.tx_telefone);
            $('input[name="tx_celular"]').val(response.tx_celular);
            $('input[name="tx_comercial"]').val(response.tx_comercial);

            //TRATANDO ABA
            if(response.tx_telefone == null || response.tx_celular == null){
                $('#tab-contatos').html('Dados de Contatos <i class="fa fa-times"></i>');
                $('#tab-contatos').css('color', '#dd4b39');  
            }else{
                $('#tab-contatos').html('Dados de Contatos <i class="fa fa-check"></i>');
                $('#tab-contatos').css('color', '#00a65a');                
            }              
            //FIM TAB-CONTATO    

            //INICIO TAB-PAGAMENTO

            $('input[name="tx_matricula"]').val(response.tx_matricula);
            $('input[name="tx_banco"]').val(response.tx_banco);
            $('input[name="tx_agencia"]').val(response.tx_agencia);
            $('input[name="tx_ctaBancaria"]').val(response.tx_ctaBancaria);

            //TRATANDO ABA
            if(response.tx_matricula == null){
               
                //Por Conta Bancaria
                
                //mudo checks e qual form deve aparecer
                $('form[name="consignado"]').hide();
                $('form[name="debito"]').show();
                $('#chk_debito').iCheck('check');                
                $('#chk_consignado').iCheck('uncheck');                

                //Se Matricula nula mostra error, caso tenha dados de conta ai sim faz o check
                $('#tab-pagamento').html('Dados de Pagamento <i class="fa fa-times"></i>');
                $('#tab-pagamento').css('color', '#dd4b39');  

                if(response.tx_agencia != null && response.tx_ctaBancaria != null){
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
            
            //ABA DEPENDENTES
            loadDependentes();

        }else{
            //mudar todas as abas porque não tem dados
            $('#tab-pagamento').html('Dados de Pagamento <i class="fa fa-times"></i>');
            $('#tab-pagamento').css('color', '#dd4b39');  
            $('#tab-pessoais').html('Dados de Pagamento <i class="fa fa-times"></i>');
            $('#tab-pessoais').css('color', '#dd4b39');  
            $('#tab-enderecos').html('Dados de Pagamento <i class="fa fa-times"></i>');
            $('#tab-enderecos').css('color', '#dd4b39');  
            $('#tab-contatos').html('Dados de Pagamento <i class="fa fa-times"></i>');
            $('#tab-contatos').css('color', '#dd4b39');                                                           
        }
        $('input[name="nb_identificacao"]').inputmask({mask: ['999.999.999-99', '99.999.999/9999-99']});
        $('input[name="dt_nascimento"]').inputmask({mask: '99/99/9999'});
        $('input[name="nb_cep"]').inputmask({mask: '99.999-999'});
        $('input[name="tx_telefone"]').inputmask({mask: '(99) 9999-9999'});       
        $('input[name="tx_celular"]').inputmask({mask: '(99) 9.9999-9999'});            
        $('input[name="tx_comercial"]').inputmask({mask: '(99) 9999-9999'});

    });
}
function unMaskAll(){
    $('.mask').inputmask('remove');
}
function loadDependentes(){
    
    $('#tab-dependentes').html('Dependentes <i class="fa fa-times"></i>');
    $('#tab-dependentes').css('color', '#dd4b39');  

    for (let index = 1; index < 6; index++) {
        $('input[name="dpt_nome'+index+'"]').val('');
        $('input[name="dpt_cpf'+index+'"]').val('');
        $('input[name="dpt_cpf'+index+'"]').prop("disabled",false);
        $('input[name="dpt_cpf'+index+'"]').inputmask('remove');                       
    }

    $.ajax({
        url: 'perfil/carregarDependentes',
        type: 'get',
        dataType: 'json'
    }).done(function(response){
        i = 1;
        $.each(response, function (index, value) {     

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
    });

}
$(function () {

    //LOAD PERFIL
    loadPerfil();

    $('button[name="dpt_salvar1"]').click(function(){
        if(
            validarCampoForm(1,$('input[name="dpt_nome1"]'),$(this)) &&
            validarCampoForm(0,$('input[name="dpt_cpf1"]'),$(this))
        ){
            btnSpinAjax($(this),$(this).html());

            name = $('input[name="dpt_nome1"]').val();
            nb_identificacao = $('input[name="dpt_cpf1"]').val();
        
            dados = {
                name: name,
                nb_identificacao: nb_identificacao
            }
            $.ajax({
                url: 'perfil/salvarDependente',
                type: 'post',
                data: dados,
                dataType: 'json'
            }).done(function(response){
                toastr.success('Dependente '+name+' registrado com Sucesso!');
            });
            loadDependentes();
        }
    });
    $('button[name="dpt_salvar2"]').click(function(){
        if(
            validarCampoForm(1,$('input[name="dpt_nome2"]'),$(this)) &&
            validarCampoForm(0,$('input[name="dpt_cpf2"]'),$(this))
        ){
            btnSpinAjax($(this),$(this).html());

            name = $('input[name="dpt_nome2"]').val();
            nb_identificacao = $('input[name="dpt_cpf2"]').val();
        
            dados = {
                name: name,
                nb_identificacao: nb_identificacao
            }
            $.ajax({
                url: 'perfil/salvarDependente',
                type: 'post',
                data: dados,
                dataType: 'json'
            }).done(function(response){
                toastr.success('Dependente '+name+' registrado com Sucesso!');
            });
            loadDependentes();
        }
    });
    $('button[name="dpt_salvar3"]').click(function(){
        if(
            validarCampoForm(1,$('input[name="dpt_nome3"]'),$(this)) &&
            validarCampoForm(0,$('input[name="dpt_cpf3"]'),$(this))
        ){        
            btnSpinAjax($(this),$(this).html());

            name = $('input[name="dpt_nome3"]').val();
            nb_identificacao = $('input[name="dpt_cpf3"]').val();
        
            dados = {
                name: name,
                nb_identificacao: nb_identificacao
            }
            $.ajax({
                url: 'perfil/salvarDependente',
                type: 'post',
                data: dados,
                dataType: 'json'
            }).done(function(response){
                toastr.success('Dependente '+name+' registrado com Sucesso!');
            });
            loadDependentes();
        }
    });
    $('button[name="dpt_salvar4"]').click(function(){
        if(
            validarCampoForm(1,$('input[name="dpt_nome4"]'),$(this)) &&
            validarCampoForm(0,$('input[name="dpt_cpf4"]'),$(this))
        ){
            btnSpinAjax($(this),$(this).html());

            name = $('input[name="dpt_nome4"]').val();
            nb_identificacao = $('input[name="dpt_cpf4"]').val();
        
            dados = {
                name: name,
                nb_identificacao: nb_identificacao
            }
            $.ajax({
                url: 'perfil/salvarDependente',
                type: 'post',
                data: dados,
                dataType: 'json'
            }).done(function(response){
                toastr.success('Dependente '+name+' registrado com Sucesso!');
            });
            loadDependentes();
        }
    });
    $('button[name="dpt_salvar5"]').click(function(){
        if(
            validarCampoForm(1,$('input[name="dpt_nome5"]'),$(this)) &&
            validarCampoForm(0,$('input[name="dpt_cpf5"]'),$(this))
        ){
            btnSpinAjax($(this),$(this).html());

            name = $('input[name="dpt_nome5"]').val();
            nb_identificacao = $('input[name="dpt_cpf5"]').val();
        
            dados = {
                name: name,
                nb_identificacao: nb_identificacao
            }
            $.ajax({
                url: 'perfil/salvarDependente',
                type: 'post',
                data: dados,
                dataType: 'json'
            }).done(function(response){
                toastr.success('Dependente '+name+' registrado com Sucesso!');
            });
            loadDependentes();
        }
    });        
    
    $('button[name="dpt_excluir1"]').click(function(){
        nb_identificacao = $('input[name="dpt_cpf1"]').val();

        dados = {
            nb_identificacao: nb_identificacao
        }
        $.ajax({
            url: 'perfil/excluirDependente',
            type: 'delete',
            data: dados
        }).done(function(){
            toastr.success('Dependente Excluído com Sucesso!');
        });
        loadDependentes();       
    });
    $('button[name="dpt_excluir2"]').click(function(){
        nb_identificacao = $('input[name="dpt_cpf2"]').val();

        dados = {
            nb_identificacao: nb_identificacao
        }
        $.ajax({
            url: 'perfil/excluirDependente',
            type: 'delete',
            data: dados
        }).done(function(){
            toastr.success('Dependente Excluído com Sucesso!');
        }); 
        loadDependentes();      
    });
    $('button[name="dpt_excluir3"]').click(function(){
        nb_identificacao = $('input[name="dpt_cpf3"]').val();

        dados = {
            nb_identificacao: nb_identificacao
        }
        $.ajax({
            url: 'perfil/excluirDependente',
            type: 'delete',
            data: dados
        }).done(function(){
            toastr.success('Dependente Excluído com Sucesso!');
        });   
        loadDependentes();     
    });
    $('button[name="dpt_excluir4"]').click(function(){
        nb_identificacao = $('input[name="dpt_cpf4"]').val();

        dados = {
            nb_identificacao: nb_identificacao
        }
        $.ajax({
            url: 'perfil/excluirDependente',
            type: 'delete',
            data: dados
        }).done(function(){
            toastr.success('Dependente Excluído com Sucesso!');
        });       
        loadDependentes();
    });
    $('button[name="dpt_excluir5"]').click(function(){
        nb_identificacao = $('input[name="dpt_cpf5"]').val();

        dados = {
            nb_identificacao: nb_identificacao
        }
        $.ajax({
            url: 'perfil/excluirDependente',
            type: 'delete',
            data: dados
        }).done(function(){
            toastr.success('Dependente Excluído com Sucesso!');
        });   
        loadDependentes();    
    });                
    
    //config nav-tabs
    $(".nav-tabs a[data-toggle=tab]").on("click", function(e) {
        if($(this).hasClass("disabled")) {
          e.preventDefault();
          return false;
        }
    }); 

    if($('#alert_email').length){
        $('section.sidebar').hide();
    }

    //auto load iCheck tab Pagamantos
    $('#chk_consignado').iCheck('check');
    $('form[name="consignado"]').show();
    $('form[name="debito"]').hide();
    $('#chk_debito').iCheck('uncheck');

    //iChecks Dados de Pagamento
    $('#chk_consignado').on('ifChecked', function(event){
        $('form[name="consignado"]').show();
        $('form[name="debito"]').hide();
        $('form[name="debito"]').trigger('reset');
        $('#chk_debito').iCheck('uncheck');
    });

    $('#chk_consignado').on('ifUnchecked', function(event){
        $('form[name="consignado"]').hide();
        $('form[name="consignado"]').trigger('reset');
    });    

    $('#chk_debito').on('ifChecked', function(event){
        $('form[name="debito"]').show();
        $('form[name="consignado"]').hide();
        $('form[name="consignado"]').trigger('reset');
        $('#chk_consignado').iCheck('uncheck');
    });

    $('#chk_debito').on('ifUnchecked', function(event){
        $('form[name="debito"]').hide();
        $('form[name="debito"]').trigger('reset');
    });  


    //Busca Via Cep
    $('input[name="nb_cep"]').blur(function(){
        //Valida o formato do CEP.
        if($(this).inputmask('unmaskedvalue')) {
                //Preenche os campos com "..." enquanto consulta webservice.
                $('input[name="tx_logradouro"]').val("...");
                $('input[name="tx_cidade"]').val("...");
                $('input[name="tx_bairro"]').val("...");

                //Consulta o webservice viacep.com.br/

                $.ajax({
                    url: "https://viacep.com.br/ws/"+ $(this).inputmask('unmaskedvalue') +"/json/?callback=?",
                    dataType: "json"
                }).done(function (dados){
                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $('input[name="tx_logradouro"]').val(dados.logradouro);
                        $('input[name="tx_bairro"]').val(dados.bairro);
                        $('input[name="tx_cidade"]').val(dados.localidade);
                        validarCampoForm(6,$('input[name="nb_cep"]'),$('#btn_enderecos'));
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        $('input[name="tx_logradouro"]').val("...");
                        $('input[name="tx_cidade"]').val("...");
                        $('input[name="tx_bairro"]').val("...");
                        validarCampoForm(4,$('input[name="nb_cep"]'),$('#btn_enderecos'));
                    }
                });
        } //end if.
        else {
            //cep é inválido.
            $('input[name="tx_logradouro"]').val("...");
            $('input[name="tx_cidade"]').val("...");
            $('input[name="tx_bairro"]').val("...");
            validarCampoForm(4,$('input[name="nb_cep"]'),$('#btn_enderecos'));
        }        
    });

    //upload imagem do perfil
    $("#file_profile_image").hide();

    $(".foto_perfil").click(function () {
        $("#file_profile_image").trigger('click');
    });
    
    $('#file_profile_image').on('change', function () {
    
        var val = $(this).val();
        $(this).siblings('span').text(val);
    
        var extension = $(this).val().split('.').pop().toLowerCase();
    
        if ($.inArray(extension, ['png', 'jpg', 'jpeg', 'tiff', 'bmp']) == -1) {
            alert('Somente imagem no formato *png, *jpg, *jpeg, *tiff, *bmp');
        } else {
    
            var file_data = $(this).prop('files')[0];
    
    
            var form_data = new FormData();
            form_data.append('file', file_data);
    
            $.ajax({
                url: "perfil/foto", // point to server-side PHP script
                data: form_data,
                type: 'POST',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false
            }).done(function () {
                $('.foto_perfil').attr('src', $('.foto_perfil').attr('src') + '?' + Math.random());
            });
        }
    });    
    
});
