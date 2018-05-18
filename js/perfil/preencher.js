$(function () {   

    $('#btn_pessoais').click(function(){
        if(validarDadosPessoais()){
            btnSpinAjax($(this),$(this).html())
            form = $('form[name="pessoais"]').serialize();
    
            $.ajax({
                url:        'perfil/dadosPessoais',
                type:       'post',
                data:       form
            }).done(function(response){
                unMaskAll();
                loadPerfil();
            });
        }
    });

    $('#btn_enderecos').click(function(){
        if(validarDadosEnderecos()){
            btnSpinAjax($(this),$(this).html())
            form = $('form[name="enderecos"]').serialize() + '& tx_logradouro=' + $('input[name="tx_logradouro"]').val()+ '& tx_bairro=' + $('input[name="tx_bairro"]').val()+ '& tx_cidade=' + $('input[name="tx_cidade"]').val();
    
            $.ajax({
                url:        'perfil/dadosEnderecos',
                type:       'post',
                data:       form
            }).done(function(response){
                unMaskAll();
                loadPerfil();
            });
        }
    });
    
    $('#btn_contatos').click(function(){
        if(validarDadosContatos()){
            btnSpinAjax($(this),$(this).html())
            form = $('form[name="contatos"]').serialize();
    
            $.ajax({
                url:        'perfil/dadosContatos',
                type:       'post',
                data:       form
            }).done(function(response){
                unMaskAll();
                loadPerfil();
            });
        }
    });
    
    $('#btn_pagamento').click(function(){
        btnSpinAjax($(this),$(this).html())
        form = $('form[name="consignado"]').serialize() + '&' + $('form[name="debito"]').serialize();
        $.ajax({
            url:        'perfil/dadosPagamento',
            type:       'post',
            data:       form
        }).done(function(response){
            unMaskAll();
            loadPerfil();
        });
    });    

});