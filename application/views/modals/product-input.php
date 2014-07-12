<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Registrar entrada</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="inputNomeProduto" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do produto" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Data</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="inputNomeProduto" placeholder="Nome do produto">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Quantidade</label>
            <div class="col-sm-10">
                <input type="text" pattern="[0-9]+" class="form-control" id="inputGrupo">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Documento</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputGrupo" placeholder="">
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary">Salvar</button>
</div>
