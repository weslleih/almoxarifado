<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Novo produto</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="inputNomeProduto" class="col-sm-2 control-label">Produto</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="inputNomeProduto" placeholder="Código">
            </div>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do produto">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Grupo</label>
            <div class="col-sm-10">
                    <select class="form-control select2">
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
            <div class="col-sm-10">
                <input type="text" class="form-control select2-new" type="hidden" id="inputGrupo" placeholder="Kg, m²">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Estoque</label>
            <div class="col-sm-5">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-arrow-down"></span></div>
                    <input type="number" class="form-control" id="inputGrupo" placeholder="Mínimo">
                </div>
            </div>
            <div class="col-sm-5">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-arrow-up"></span></div>
                    <input type="number" class="form-control" id="inputGrupo" placeholder="Máximo">
                </div>
            </div>
        </div>
         <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">CatMat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputGrupo" placeholder="">
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

