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