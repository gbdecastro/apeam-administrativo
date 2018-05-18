$('button[name="btn_gerar"]').click(function(){

    btnSpinAjax($(this),$(this).html());

    var nome = $('input[name="form_relatorio_name"]').val();
    var municipio = $('select[name="form_relatorio_municipio"]').val();
    var dt_nascimento = $('input[name="form_relatorio_dt_nascimento"]').val();
    
    dataForm = {
        'name'          : nome,
        'tx_cidade'     : municipio,
        'dt_nascimento' : dt_nascimento,
    }
    
    $.ajax({
        type: 'get',
        url: '/associados/relatorio',
        data: dataForm,
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