$(document).ready(function () {
    $('#table_protocolos').DataTable({    
        "order": [],
        "oLanguage": {
            "sUrl": "../js/libs/datatables_ptbr.json"
        }        
    });
    
    $('.documentos_protocolo').click(function(){
        
        btnSpinAjax($(this), $(this).html());

        id_protocolo = $(this).prop('id');

        //Ofício
        $.ajax({
            url: '/protocolos/consultarOficios/'+id_protocolo,
            type: 'post',
            dataType: 'json'
        }).done(function(response){
            object = '';
            $.each(response, function (i, entry) {
                object = object +
                '<div class="col-md-2">'+
                    '<div class="box box-success">'+
                        '<div class="box-body">'+
                            '<i class="fa fa-download"></i>'+
                            '<a href="'+entry.url+'">Ofício Nº '+(i+1)+'</a>'+
                        '</div>'+
                    '</div>'+
                '</div>';
            });          
            $('#files_oficios').html(object);  
        });

        //Confirmação
        $.ajax({
            url: '/protocolos/consultarConfirmacao/'+id_protocolo,
            type: 'post'
        }).done(function(response){
            let object = ''+
            '<div class="col-md-4">'+
                '<div class="box box-success">'+
                    '<div class="box-body">'+
                        '<i class="fa fa-download"></i>'+
                        '<a href="'+response+'">Arquivo de Confirmação</a>'+                    
                    '</div>'+
                '</div>'+
            '</div>';
            $('#file_confirmacao').html(object);           
        });

        $('#modal_documentos_protocolo').modal('show');
    });

    $('.imprimir').click(function(){
        id_protocolo = $(this).prop('id');

        btnSpinAjax($(this), $(this).html());

        dados = {
            id_protocolo: id_protocolo
        }

        $.ajax({
            url: '/protocolos/consultar/imprimir',
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
        });
    });
});
