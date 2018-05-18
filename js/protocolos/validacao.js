$(document).ready(function(){
    $('#cpf').on('blur change', function(){
        validarCampoForm(0,$('#cpf'),$('#btn_imprimir_protocolo_oficio'));
    });
    $('#tx_nome').on('blur change',function(){
        validarCampoForm(1,$('#tx_nome'),$('#btn_imprimir_protocolo_oficio'));
    });
    $('#file_oficio').on('change',function(){
        validarCampoForm(2,$('#file_oficio'),$('#btn_imprimir_protocolo_oficio'));
    });
    $('#file_confirmacao').on('change',function(){
        validarCampoForm(2,$('#file_confirmacao'),$('#btn_salvar'));
    });    
});