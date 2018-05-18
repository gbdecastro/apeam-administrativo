@extends('adminlte::page') @section('title', 'Declaração Associado') @section('content_header')
<h1>
    <i class="fa fa-certificate"></i> Associado
</h1>
<ol class="breadcrumb">
    <li>
        <a href="#">
            <i class="fa fa-address-book"></i> Declarações</a>
    </li>
    <li class="active">
        <a href="#">
            <i class="fa fa-certificate"></i>Associado</a>
    </li>
</ol>
@endsection @section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Filtro de Pesquisa
                </h3>
            </div>
            <div class="box-body">
                <div class="form-horizontal">
                    <!-- Associado -->
                    <div class="form-group">
                        <label for="tx_name" class="col-md-4 control-label obrigatorio">Associados:</label>
                        <div class="col-md-6">
                            <select class="form-control select2-native" name="associado" required autofocus>
                                @foreach($associados as $associado)
                                    <option value="{{ $associado->id_user }}">{{ $associado->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button name="btn_imprimir" type="submit" class="btn btn-success">
                                Imprimir Declaração
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection @section('js')
<script>
$('button[name="btn_imprimir"]').click(function() {     
    btnSpinAjax($(this),$(this).html());

    var associado = $('select[name="associado"]').val();

    $.ajax({
        type: 'get',
        url: 'imprimir/'+associado,
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
</script>
@endsection