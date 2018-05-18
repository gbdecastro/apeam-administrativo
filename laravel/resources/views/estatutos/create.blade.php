<div id="modal_create" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4 class="modal-title">Novo Estatuto</h4>
            </div>
            <div class="modal-body">
            <form action="/declaracoes/estatutos" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="obrigatorio">Selecione um PDF</label>
                    <input type="file" name="estatutos[]" multiple>
                </div>					
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_submit_create" class="btn btn-success">Adicionar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
            </form>
        </div>
    </div>
</div>