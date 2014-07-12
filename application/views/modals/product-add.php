<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Novo produto</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="inputNomeProduto" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do produto">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Grupo</label>
            <div class="col-sm-10">
                    <select class="form-control chosen-select">
                      <option>asdasdasd</option>
                      <option>asdasdasd</option>
                      <option>asdasdasd</option>
                      <option>asdasdasd</option>
                      <option>asdasdasdas</option>
                    </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputUnidate" class="col-sm-2 control-label">Unidade</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="inputGrupo" placeholder="Kg, m²">
            </div>
            <label for="inputPreco" class="col-sm-3 control-label">Preço unitário</label>
            <div class="col-sm-3">
                <div class="input-group">
                    <div class="input-group-addon">R$</div>
                    <input type="text" class="form-control" id="inputGrupo" placeholder="00,00">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Estoque mínimo</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="inputGrupo" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Observações</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3"></textarea>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary">Salvar</button>
</div>

