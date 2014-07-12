<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Registrar saída</h4>
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
            <label for="inputGrupo" class="col-sm-2 control-label">Consumidor</label>
            <div class="col-sm-10">
                <select class="form-control chosen-select">
                      <option>Consumidor 1</option>
                      <option>Consumidor 2</option>
                      <option>Consumidor 3</option>
                      <option>Consumidor 4</option>
                      <option>Consumidor 5</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputNomeProduto" class="col-sm-2 control-label">Data</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="inputNomeProduto">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Quantidade</label>
            <div class="col-sm-10">
                <input type="number" pattern="^[+]?\d+([,]\d+)?$" class="form-control" id="inputGrupo" placeholder="">
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
