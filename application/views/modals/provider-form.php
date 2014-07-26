<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Novo fornecedor</h4>
</div>
<div class="modal-body">
    <div class="alert alert-danger alert-dismissible hidden" role="alert">
        <ul class="errors-list"></ul>
    </div>
    <form class="form-horizontal" role="form" method="post" action="<?php echo $action;?>">
        <div class="form-group">
            <label for="inputNomeProduto" class="col-sm-2 control-label">Fornecedor</label>
            <div class="col-sm-3">
                <input name="idprovider" type="text" class="form-control" id="inputNomeProduto" placeholder="Código" <?php insert_input_value($this,"idprovider");?> disabled>
            </div>
            <div class="col-sm-7">
                <input name="name" type="text" class="form-control" id="inputNomeProduto" placeholder="Nome/Razão Social" <?php insert_input_value($this,"name");?>>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">CPF/CNPJ</label>
            <div class="col-sm-10">
                <input name="document" type="text" class="form-control" id="inputNomeProduto" placeholder="00.000.000/0000-00" <?php insert_input_value($this,"document");?>>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input name="email" type="text" class="form-control" id="inputNomeProduto" placeholder="" <?php insert_input_value($this,"email");?>>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Telefone</label>
            <div class="col-sm-3">
                <input name="phone1" type="text" class="form-control" id="inputNomeProduto" placeholder="" <?php insert_input_value($this,"phone1");?>>
            </div>
            <label for="inputGrupo" class="col-sm-2 control-label">Responsável</label>
            <div class="col-sm-5">
                <input name="phone1resp" type="text" class="form-control" id="inputNomeProduto" placeholder="" <?php insert_input_value($this,"phone1resp");?>>
            </div>
        </div>
       <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Telefone</label>
            <div class="col-sm-3">
                <input name="phone2" type="text" class="form-control" id="inputNomeProduto" placeholder="" <?php insert_input_value($this,"phone2");?>>
            </div>
            <label for="inputGrupo" class="col-sm-2 control-label">Responsável</label>
            <div class="col-sm-5">
                <input name="phone2resp" type="text" class="form-control" id="inputNomeProduto" placeholder="" <?php insert_input_value($this,"phone2resp");?>>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Endereço</label>
            <div class="col-sm-10">
                <textarea name="address" type="text" class="form-control" id="inputNomeProduto" rows="4"><?php insert_textarea_value($this,"address");?></textarea>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary btn-send-form">Salvar</button>
</div>

