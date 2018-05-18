function limparCampos() {
    $('#cpf').inputmask('remove');
    $('#cpf').val('');
    $('#tx_nome').val('');
    $('#file_oficio').val('');
    $('#file_confirmacao').val('');
    aplicarMascara();
}

function aplicarMascara() {
    $('#cpf').inputmask({
        "mask": "999.999.999-99"
    });
}

function validarCampos(){
    validarCampoForm(0,$('#cpf'),$('#btn_imprimir_protocolo_oficio'));
    validarCampoForm(1,$('#tx_nome'),$('#btn_imprimir_protocolo_oficio'));
    validarCampoForm(2,$('#file_oficio'),$('#btn_imprimir_protocolo_oficio'));
    validarCampoForm(2,$('#file_confirmacao'),$('#btn_salvar'));
    toastr.remove();
}
$(document).ready(function () {
    
    aplicarMascara();
    //hide boxs
    $('#oficio').hide();
    $('#servicos').hide();
    $('#finalizar').hide();
    $('#detalhamento').hide();

    //trigger para ja setar
    $('#tipo_atendimento').trigger('select2:close');

    //hide em tudo ao clicar no select2
    $('#tipo_atendimento').on('select2:opening', function (e) {
        $('#oficio').hide();
        $('#servicos').hide();
        $('#finalizar').hide();
        $('#detalhamento').hide();
    });

    //show necessario ao fechar select2
    $('#tipo_atendimento').on('select2:close ', function (e) {
        var tipo = $('#tipo_atendimento').val();

        if (tipo == 'Ofício') {

            $('#detalhamento').show();
            $('#oficio').show();
            $('#servicos').hide();
            $('#finalizar').hide();

        } else {
            $('#detalhamento').show();
            $('#servicos').show();
            $('#oficio').hide();
            $('#finalizar').hide();
        }
    });

    //lista de associados em ordem
    $('#associado').select2({
        width: '100%',
        allowClear: true,
        sorter: function (data) {
            /* Sort data using lowercase comparison */
            return data.sort(function (a, b) {
                a = a.text.toLowerCase();
                b = b.text.toLowerCase();
                if (a > b) {
                    return 1;
                } else if (a < b) {
                    return -1;
                }
                return 0;
            });
        }
    });

    //lista de Serviços em ordem
    $('#tipo_servico').select2({
        width: '100%',
        allowClear: true,
        sorter: function (data) {
            /* Sort data using lowercase comparison */
            return data.sort(function (a, b) {
                a = a.text.toLowerCase();
                b = b.text.toLowerCase();
                if (a > b) {
                    return 1;
                } else if (a < b) {
                    return -1;
                }
                return 0;
            });
        }
    });

    imprimiuServico = false;
    impimiuOficio = false;

    $('#btn_imprimir_protocolo_servico').click(function () {

        if (imprimiuServico) {
            $('#oficio').hide();
            $('#servicos').hide();
            $('#finalizar').show();
        } else {
            btnSpinAjax($(this), $(this).html());

            dados = {
                id_associado: $('#associado').val(),
                tx_servico: $('#tipo_servico').val()
            }

            $.ajax({
                url: '/protocolos/servico/emitirProtocolo',
                type: 'get',
                data: dados,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (response, status, xhr) {

                    var filename = "";
                    var disposition = xhr.getResponseHeader('Content-Disposition');

                    if (disposition) {
                        var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                        var matches = filenameRegex.exec(disposition);
                        if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                    }
                    var linkelem = document.createElement('a');
                    try {
                        var blob = new Blob([response], {
                            type: 'application/octet-stream'
                        });
                        if (typeof window.navigator.msSaveBlob !== 'undefined') {
                            //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                            window.navigator.msSaveBlob(blob, filename);
                        } else {
                            var URL = window.URL || window.webkitURL;
                            var downloadUrl = URL.createObjectURL(blob);

                            if (filename) {
                                // use HTML5 a[download] attribute to specify filename
                                var a = document.createElement("a");

                                // safari doesn't support this yet
                                if (typeof a.download === 'undefined') {
                                    window.location = downloadUrl;
                                } else {
                                    a.href = downloadUrl;
                                    a.download = filename;
                                    document.body.appendChild(a);
                                    a.target = "_blank";
                                    a.click();
                                }
                            } else {
                                window.location = downloadUrl;
                            }
                        }
                        imprimiuServico = true;
                    } catch (ex) {
                        console.log(ex);
                    }
                }
            }).done(function () {
                $('#oficio').hide();
                $('#servicos').hide();
                $('#finalizar').show();
            });
        }

    });

    $('#btn_imprimir_protocolo_oficio').click(function () {

        if (impimiuOficio) {
            $('#oficio').hide();
            $('#servicos').hide();
            $('#finalizar').show();
        } else {

            if(validarCampoForm(2,$('#file_oficio'),$(this))){
                btnSpinAjax($(this), $(this).html());

                dados = {
                    nb_identificacao: $('#cpf').val(),
                    tx_nome: $('#tx_nome').val()
                }
                $.ajax({
                    url: '/protocolos/oficio/emitirProtocolo',
                    type: 'get',
                    data: dados,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (response, status, xhr) {
    
                        var filename = "";
                        var disposition = xhr.getResponseHeader('Content-Disposition');
    
                        if (disposition) {
                            var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                            var matches = filenameRegex.exec(disposition);
                            if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                        }
                        var linkelem = document.createElement('a');
                        try {
                            var blob = new Blob([response], {
                                type: 'application/octet-stream'
                            });
                            if (typeof window.navigator.msSaveBlob !== 'undefined') {
                                //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                                window.navigator.msSaveBlob(blob, filename);
                            } else {
                                var URL = window.URL || window.webkitURL;
                                var downloadUrl = URL.createObjectURL(blob);
    
                                if (filename) {
                                    // use HTML5 a[download] attribute to specify filename
                                    var a = document.createElement("a");
    
                                    // safari doesn't support this yet
                                    if (typeof a.download === 'undefined') {
                                        window.location = downloadUrl;
                                    } else {
                                        a.href = downloadUrl;
                                        a.download = filename;
                                        document.body.appendChild(a);
                                        a.target = "_blank";
                                        a.click();
                                    }
                                } else {
                                    window.location = downloadUrl;
                                }
                            }
    
                        } catch (ex) {
                            console.log(ex);
                        }
                    }
                }).done(function () {
                    $('#oficio').hide();
                    $('#servicos').hide();
                    $('#finalizar').show();
                    imprimuOficio = true;
                });
            }else{
                toastr.error('Não há Ofício(s) ou Arquivo selecionado não é PDF!');
            }
        }

    });

    $('#btn_voltar_detalhamento').click(function () {

        var tipoAtendimento = $('#tipo_atendimento').val();

        if (tipoAtendimento == "Ofício") {
            $('#oficio').show();
            $('#servicos').hide();
        } else {
            $('#servicos').show();
            $('#oficio').hide();
        }

        $('#detalhamento').show();
        $('#finalizar').hide();
    });

    $('#btn_salvar').click(function () {

        btnSpinAjax($(this), $(this).html());

        var tipoAtendimento = $('#tipo_atendimento').val();

        confirmacao = $('#file_confirmacao').val();
        $('#file_confirmacao').siblings('span').text(confirmacao);

        confirmacao_extension = $('#file_confirmacao').val().split('.').pop().toLowerCase();

        if(validarCampoForm(2,$('#file_confirmacao'),$(this))){
            if (tipoAtendimento == 'Ofício') {

                var oficio = $('#file_oficio').val();
                $('#file_oficio').siblings('span').text(oficio);
    
                var oficio_extension = $('#file_oficio').val().split('.').pop().toLowerCase();
    
                if ($.inArray(oficio_extension, ['pdf']) == -1) {
                    toastr.error('O(s) Ofício(s) deve ser um arquivo *PDF');
                } else {
                    if ($.inArray(confirmacao_extension, ['pdf']) == -1) {
                        toastr.error('A confirmação do Protocolo deve ser um arquivo *PDF');
                    } else {
    
                        var form_data = new FormData();
                        form_data.append('nb_identificacao', $('#cpf').val());
                        form_data.append('tx_nome', $('#tx_nome').val());
                        $.each($('#file_oficio'), function(i, obj) {
                            $.each(obj.files,function(i,file){
                                form_data.append('file_oficio['+i+']', file);
                            });
                        });                        
                        form_data.append('file_confirmacao', $('#file_confirmacao').prop('files')[0]);
                        form_data.append('tx_tipo', 'oficio');
    
                        $.ajax({
                            url: '/protocolos/create',
                            type: 'post',
                            data: form_data,
                            contentType: false, // The content type used when sending data to the server.
                            cache: false, // To unable request pages to be cached
                            processData: false
                        }).done(function () {
                            toastr.success('Protocolo Efetuado com Sucesso');
                            limparCampos();
                            $('#detalhamento').hide();
                        });
                    }
                }
    
            } else {
                if ($.inArray(confirmacao_extension, ['pdf']) == -1) {
                    toastr.error('A confirmação do Protocolo deve ser um arquivo *PDF');
                } else {
    
                    var form_data = new FormData();
                    form_data.append('id_associado', $('#associado').val());
                    form_data.append('tx_servico', $('#tipo_servico').val());
                    form_data.append('file_confirmacao', $('#file_confirmacao').prop('files')[0]);
                    form_data.append('tx_tipo', 'servicos');
    
                    $.ajax({
                        url: '/protocolos/create',
                        type: 'post',
                        data: form_data,
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false
                    }).done(function () {
                        toastr.success('Protocolo Efetuado com Sucesso');
                        limparCampos();
                        $('#detalhamento').hide();
                        impimiuOficio = false;
                        imprimiuServico = false;
                    });
                }
            }
        }else{
            toastr.error('Não há Ofício(s) ou Arquivo selecionado não é PDF!');
        }

    });

});