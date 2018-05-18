function validarDadosPessoais(){

    if(validarCampoForm(1,$('input[name="name"]'),$('#btn_pessoais')) &&
    validarCampoForm(1,$('input[name="tx_nome_guerra"]'),$('#btn_pessoais')) &&
    validarCampoForm(0,$('input[name="nb_identificacao"]'),$('#btn_pessoais')) &&
    validarCampoForm(5,$('input[name="dt_nascimento"]'),$('#btn_pessoais'))){
        $('#btn_pessoais').prop('disabled',false);
        return true;
    }else{
        $('#btn_pessoais').prop('disabled',true);
        return false;
    }
   
}

function validarDadosEnderecos(){

    if(
        validarCampoForm(7,$('input[name="nb_numero"]'),$('#btn_enderecos')) &&
        validarCampoForm(8,$('input[name="tx_complemento"]'),$('#btn_enderecos'))){
        $('#btn_enderecos').prop('disabled',false);
        return true;
    }else{
        $('#btn_enderecos').prop('disabled',true);
        return false;
    }
   
}

function validarDadosContatos(){

    if(
        validarCampoForm(9,$('input[name="tx_telefone"]'),$('#btn_contatos')) &&
        validarCampoForm(10,$('input[name="tx_celular"]'),$('#btn_contatos')) &&
        validarCampoForm(9,$('input[name="tx_comercial"]'),$('#btn_contatos'))){
        $('#btn_contatos').prop('disabled',false);
        return true;
    }else{
        $('#btn_contatos').prop('disabled',true);
        return false;
    }
   
}



$(document).ready(function(){
    
    //pessoais
    $('input[name="name"]').on('blur change', function(){
        validarCampoForm(1,$(this),$('#btn_pessoais'));
    });
    $('input[name="tx_nome_guerra"]').on('blur change', function(){
        validarCampoForm(1,$(this),$('#btn_pessoais'));
    });
    $('input[name="nb_identificacao"]').on('blur change', function(){
        validarCampoForm(0,$(this),$('#btn_pessoais'));
    });
    $('input[name="dt_nascimento"]').on('blur change', function(){
        validarCampoForm(5,$(this),$('#btn_pessoais'));
    });

    //enderecos
    $('input[name="nb_numero"]').on('blur change', function(){
        validarCampoForm(7,$(this),$('#btn_enderecos'));
    });
    $('input[name="tx_complemento"]').on('blur change', function(){
        validarCampoForm(8,$(this),$('#btn_enderecos'));
    });  

    //contatos
    $('input[name="tx_telefone"]').on('blur change', function(){
        validarCampoForm(9,$(this),$('#btn_contatos'));
    });
    $('input[name="tx_celular"]').on('blur change', function(){
        validarCampoForm(10,$(this),$('#btn_contatos'));
    });    
    $('input[name="tx_comercial"]').on('blur change', function(){
        validarCampoForm(9,$(this),$('#btn_contatos'));
    });    

    //dependentes
    $('input[name="dpt_nome1"]').on('blur change', function(){
        validarCampoForm(1,$(this),$('#dpt_salvar1'));
    });
    $('input[name="dpt_cpf1"]').on('blur change', function(){
        validarCampoForm(0,$(this),$('#dpt_salvar1'));
    });  
    $('input[name="dpt_nome2"]').on('blur change', function(){
        validarCampoForm(1,$(this),$('#dpt_salvar2'));
    });
    $('input[name="dpt_cpf2"]').on('blur change', function(){
        validarCampoForm(0,$(this),$('#dpt_salvar2'));
    });            
    $('input[name="dpt_nome3"]').on('blur change', function(){
        validarCampoForm(1,$(this),$('#dpt_salvar3'));
    });
    $('input[name="dpt_cpf3"]').on('blur change', function(){
        validarCampoForm(0,$(this),$('#dpt_salvar3'));
    });            
    $('input[name="dpt_nome4"]').on('blur change', function(){
        validarCampoForm(1,$(this),$('#dpt_salvar4'));
    });
    $('input[name="dpt_cpf4"]').on('blur change', function(){
        validarCampoForm(0,$(this),$('#dpt_salvar4'));
    });            
    $('input[name="dpt_nome5"]').on('blur change', function(){
        validarCampoForm(1,$(this),$('#dpt_salvar5'));
    });
    $('input[name="dpt_cpf5"]').on('blur change', function(){
        validarCampoForm(0,$(this),$('#dpt_salvar5'));
    });                        
        
});