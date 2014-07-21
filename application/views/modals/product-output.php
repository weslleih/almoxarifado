<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Registrar saída</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="inputNomeProduto" class="col-sm-2 control-label">Produto</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="inputNomeProduto" placeholder="Código" disabled>
            </div>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do produto" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Consumidor</label>
            <div class="col-sm-3 option-code">
                <select class="form-control select2">
                    <option>001</option>
                    <option>002</option>
                    <option>003</option>
                    <option>004</option>
                    <option>005</option>
                </select>
            </div>
            <div class="col-sm-7 option-name">
                <select class="form-control select2">
                    <option>Consumidor 1</option>
                    <option>Consumidor 2</option>
                    <option>Consumidor 3</option>
                    <option>Consumidor 4</option>
                    <option>Consumidor 5</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Recebente</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do responsável">
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
                <div class="input-group">
                    <input type="text" pattern="[0-9]+" class="form-control" id="inputGrupo">
                    <div class="input-group-addon">M²</div>
                </div>
            </div>

        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Valores</label>
            <div class="col-sm-5">
                <div class="input-group">
                    <div class="input-group-addon">R$</div>
                    <input type="text" class="form-control" id="inputGrupo" placeholder="00,00" disabled>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="input-group">
                    <div class="input-group-addon">R$</div>
                    <input type="text" class="form-control" id="inputGrupo" placeholder="00,00" disabled>
                </div>
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
