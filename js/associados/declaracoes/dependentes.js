//in load
    $('select[name="dependentes"]').hide();
    $('button[name="btn_imprimir"').prop("disabled",true);

    //carregar todos os associados
    $.ajax({
        type:'get',
        dataType: 'json',
        url: '/associados/possuiDependentes',
        success :function(data) {
            options = '';
            $.each(data, function (inde, value) {
                options = options + '<option value="' + value.id_user + '">' + value.name + '</option>';
            });
            $('select[name="associado"]').append(options);
        }
    }).done(function(data){
        $('.overlay').fadeOut('slow');
    });

//fim load

//carregar os dependentes do associado escolhido
$('select[name="associado"]').on("select2:close", function(e) {
    if($('select[name="associado"]').val() != ''){
        $('.overlay').fadeIn('slow');
        $('select[name="dependentes"]').html('');
        dados = {
            'id_user': $('select[name="associado"]').val()
        }
    
        $.ajax({
            type:'get',
            dataType: 'json',
            url: '/dependentes/all',
            data: dados,
            success: function(data){
                options = '';
                $.each(data, function (inde, value) {
                    options = options + '<option value="' + value.nb_identificacao + '">' + value.name + '</option>';
                });
                $('select[name="dependentes"]').append(options);
    
                if(data.length > 0)
                    $('button[name="btn_imprimir"').prop("disabled",false);
            }
        }).done(function(){
            $('.overlay').fadeOut('slow');
        });
    }else{
        toastr.warning('Não Há Dependentes');
    }    
});

//imprimir
$('button[name="btn_imprimir"]').click(function() {     
    btnSpinAjax($(this),$(this).html());

    var associado = $('select[name="associado"]').val();
    var dependente = $('select[name="dependentes"]').val();

    dados = {
        'id_user': associado,
        'nb_identificacao': dependente
    }

    $.ajax({
        type: 'get',
        url: '/declaracoes/dependentes/imprimir',
        data: dados,
        //xhrFields is what did the trick to read the blob to pdf
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
                var blob = new Blob([response], { type: 'application/octet-stream' });                        
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
    });      
});