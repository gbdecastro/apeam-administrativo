<div id="create_administrador">
	<div id="modal_create" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title">Novo Administrador</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="obrigatorio">Selecione um Usuário</label>
						<select name="not_administradores" id="not_administradores" class="select2-native"></select>				
					</div>					
				</div>
				<div class="modal-footer">
					<button type="submit" @click="createAdministrador" id="btn_submit_create" class="btn btn-success">Adicionar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>
</div>