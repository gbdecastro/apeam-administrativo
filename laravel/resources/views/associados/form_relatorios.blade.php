<!-- Modal -->
<div class="modal fade" id="form_relatorios" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Gerar Relatórios de Associados</h4>
            </div>
            <div class="modal-body">
                    <!-- Nome -->
                    <div class="form-group">
                        <label for="" class="control-label">Nome:</label>
                        <input type="text" class="form-control" name="form_relatorio_name">
                    </div>
                    <!-- Município -->
                    <div class="form-group">
                        <label for="tx_name" class="control-label">Município:</label>
                        <select type="date" class="form-control select2-native" name="form_relatorio_municipio" autofocus>
                            <option value="" selected>---Selecione---</option>
                        </select>
                    </div>
                    <!-- Data Nascimento -->
                    <div class="form-group">
                        <label for="tx_name" class="control-label">Data Nascimento:</label>
                        <input type="text" class="form-control mask" name="form_relatorio_dt_nascimento">
                    </div>
                    <!-- Submit -->
                    <div class="form-group">
                        <button name="btn_gerar" v-on:click="gerarRelatorio()" class="form-control btn btn-success">
                            Gerar Relatório
                        </button>
                    </div>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>

    </div>
</div>