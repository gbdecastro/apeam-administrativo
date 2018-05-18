NProgress.start();

$(document).ajaxStart(function() {
    window.ajaxBusy = true;
    NProgress.start();

});

$(document).ajaxStop(function() {
    window.ajaxBusy = false;
    NProgress.done();
});

$(document).ajaxError(function(error) {
    window.ajaxBusy = false;
    NProgress.done();
});

window.onload = function () {
    NProgress.done(); 
    $('.content').fadeIn('slow');
}

//select2
$('.select2-native').select2({
    width: '100%',
    allowClear: true   
});

//select2 tag
$('.select2-tag').select2({
    width: '100%',
    allowClear: true,
    tags: true
}); 

//ajax setup for laravel
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

if($(':checkbox').length){
    $(':checkbox').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
    
}

//funcao para botao
function btnSpinAjax (btn,content){
    btn.prop('disabled',true);
    btn.html('<i class="fa fa-spinner fa-spin"></i>'+content);
    $(document).ajaxStop(function() {
        window.ajaxBusy = false;
        btn.html(content);
        btn.prop('disabled',false);
    });
    
    $(document).ajaxError(function() {
        window.ajaxBusy = false;
        btn.html(content);
        btn.prop('disabled',false);
    });    
}

//funcao para avaliacao de campos
function validarCampoForm(tipo,campo,btn){
    contentLabel = campo.prev('label').text();

    //cpf e cnpj
    if(tipo == 0){
        if(campo.val().length == 14){
            if(CPF.validate(campo.val())){
                campo.parent(0).removeClass('has-error');
                campo.parent(0).addClass('has-success');
                campo.prev('label').html('<i class="fa fa-check"></i> '+contentLabel+' ');
                btn.prop('disabled',false);
                return true;
            }else{
                campo.parent(0).removeClass('has-success');
                campo.parent(0).addClass('has-error');
                campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
                btn.prop('disabled',true);
                toastr.error('CPF Inválido');
                return false;
            }            
        }else{
            if(cnpj(campo.val())){
                campo.parent(0).removeClass('has-error');
                campo.parent(0).addClass('has-success');
                campo.prev('label').html('<i class="fa fa-check"></i> '+contentLabel+' ');
                btn.prop('disabled',false);
                return true;
            }else{
                campo.parent(0).removeClass('has-success');
                campo.parent(0).addClass('has-error');
                campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
                btn.prop('disabled',true);
                toastr.error('CNPJ Inválido');
                return false;
            }
        }
    }
    //nome    
    if(tipo == 1){
        var reg = /^[A-Za-z ]+$/;
        if(reg.test(campo.val())){
            campo.parent(0).removeClass('has-error');
            campo.parent(0).addClass('has-success');
            campo.prev('label').html('<i class="fa fa-check"></i> '+contentLabel+' ');
            btn.prop('disabled',false);
            return true;
        }else{
            campo.parent(0).removeClass('has-success');
            campo.parent(0).addClass('has-error');
            campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
            btn.prop('disabled',true);
            toastr.error('Nome Inválido');
            return false;
        }
    }
    //pdf
    if(tipo == 2){
        var pdf_extension = campo.val().split('.').pop().toLowerCase();
        if(campo[0].files.length > 0){
            if($.inArray(pdf_extension, ['pdf']) == -1){
                campo.parent(0).removeClass('has-success');
                campo.parent(0).addClass('has-error');
                campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
                btn.prop('disabled',true);
                toastr.error('Arquivo selecionado não é PDF!');
                return false;                
            }else{
                campo.parent(0).removeClass('has-error');
                campo.parent(0).addClass('has-success');
                campo.prev('label').html('<i class="fa fa-check"></i> '+contentLabel+' ');
                btn.prop('disabled',false);
                return true;
            }
        }else{
            campo.parent(0).removeClass('has-success');
            campo.parent(0).addClass('has-error');
            campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
            btn.prop('disabled',true);
            toastr.error('Não há Ofício(s)!!');
            return false;
        }        
    }
    //vazio
    if(tipo == 3){
        if (campo.val() != '') {
            campo.parent(0).removeClass('has-success');
            campo.parent(0).addClass('has-error');
            campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
            btn.prop('disabled',true);
            toastr.error('Arquivo selecionado não é PDF!');
            return false;                
        }else{
            campo.parent(0).removeClass('has-error');
            campo.parent(0).addClass('has-success');
            campo.prev('label').html('<i class="fa fa-check"></i> '+contentLabel+' ');
            btn.prop('disabled',false);
            return true;
        }
    }
    //cep invalido
    if(tipo == 4){
        campo.parent(0).addClass('has-error');
        campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
        btn.prop('disabled',true);
        toastr.error('CEP Inválido');
        return false;           
    }
    //data
    if(tipo == 5){
        var bits = campo.val().split('/');
        var d = new Date(bits[2] + '/' + bits[1] + '/' + bits[0]);
        var valido =  !!(d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[0]));        
        if(valido){
            campo.parent(0).removeClass('has-error');
            campo.parent(0).addClass('has-success');
            campo.prev('label').html('<i class="fa fa-check"></i> '+contentLabel+' ');
            btn.prop('disabled',false);
            return true;
        }else{
            campo.parent(0).removeClass('has-success');
            campo.parent(0).addClass('has-error');
            campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
            btn.prop('disabled',true);
            toastr.error('Data Inválida');
            return false;
        }
    }
    //qualquer coisa
    if(tipo == 6){
        campo.parent(0).removeClass('has-error');
        campo.parent(0).addClass('has-success');
        campo.prev('label').html('<i class="fa fa-check"></i> '+contentLabel+' ');
        btn.prop('disabled',false);
        return true;        
    }
    //numero
    if(tipo == 7){
        var reg = /^[0-9]+$/;
        if(reg.test(campo.val())){
            campo.parent(0).removeClass('has-error');
            campo.parent(0).addClass('has-success');
            campo.prev('label').html('<i class="fa fa-check"></i> '+contentLabel+' ');
            btn.prop('disabled',false);
            return true;
        }else{
            campo.parent(0).removeClass('has-success');
            campo.parent(0).addClass('has-error');
            campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
            btn.prop('disabled',true);
            toastr.error('Número Inválido');
            return false;
        }
    }
    //Texto de Numeros e letras contendo espaços
    if(tipo == 8){
        var reg = /^[A-Za-z0-9 ]+$/;
        if(reg.test(campo.val())){
            campo.parent(0).removeClass('has-error');
            campo.parent(0).addClass('has-success');
            campo.prev('label').html('<i class="fa fa-check"></i> '+contentLabel+' ');
            btn.prop('disabled',false);
            return true;
        }else{
            campo.parent(0).removeClass('has-success');
            campo.parent(0).addClass('has-error');
            campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
            btn.prop('disabled',true);
            toastr.error('Texto Inválido');
            return false;
        }
    }
    //telefone
    if(tipo == 9){
        var valor = campo.val().replace(/[()_-]/g,'');
        console.log(valor.length);
        if(valor.length == 11){
            campo.parent(0).removeClass('has-error');
            campo.parent(0).addClass('has-success');
            campo.prev('label').html('<i class="fa fa-check"></i> '+contentLabel+' ');
            btn.prop('disabled',false);
            return true;
        }else{
            campo.parent(0).removeClass('has-success');
            campo.parent(0).addClass('has-error');
            campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
            btn.prop('disabled',true);
            toastr.error('Telefone Inválido');
            return false;
        }
    }    
    //celular
    if(tipo == 10){
        var valor = campo.val().replace(/[()_-]/g,'');
        console.log(valor.length);
        if(valor.length == 13 ){
            campo.parent(0).removeClass('has-error');
            campo.parent(0).addClass('has-success');
            campo.prev('label').html('<i class="fa fa-check"></i> '+contentLabel+' ');
            btn.prop('disabled',false);
            return true;
        }else{
            campo.parent(0).removeClass('has-success');
            campo.parent(0).addClass('has-error');
            campo.prev('label').html('<i class="fa fa-times"></i> '+contentLabel+' ');
            btn.prop('disabled',true);
            toastr.error('Celular Inválido');
            return false;
        }
    }     
}
function cnpj(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, '');
    if (cnpj == '') return false;
    if (cnpj.length != 14)
        return false;
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;

    return true;
}