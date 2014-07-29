<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Novo Consumidor</h4>
</div>
<div class="modal-body">
    <div class="alert alert-danger alert-dismissible hidden" role="alert">
        <ul class="errors-list"></ul>
    </div>
    <form class="form-horizontal" role="form" method="post" action="<?php echo $action;?>">
        <div class="form-group">
            <label for="inputNomeProduto" class="col-sm-2 control-label">Consumidor</label>
            <div class="col-sm-3">
                <input name="idconsumer" type="text" class="form-control" id="inputNomeProduto" placeholder="Código" <?php insert_input_value($this,"idconsumer");?> disabled>
            </div>
            <div class="col-sm-7">
                <input name="name" type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do consumidor" <?php insert_input_value($this,"name");?>>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary btn-send-form">Salvar</button>
</div>

