<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Registrar entrada</h4>
</div>
<div class="modal-body">
    <div class="alert alert-danger alert-dismissible hidden" role="alert">
        <ul class="errors-list"></ul>
    </div>
    <form class="form-horizontal" role="form" method="post" action="<?php echo $action;?>">
        <div class="form-group">
            <label for="inputNomeProduto" class="col-sm-2 control-label">Produto</label>
            <div class="col-sm-3">
                <input name="" type="text" class="form-control" id="inputNomeProduto" placeholder="Código" disabled value="<?php echo $id ?>">
            </div>
            <div class="col-sm-7">
                <input name="" type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do produto" disabled value="<?php echo $name ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Fornecedor</label>
            <div class="col-sm-3">
                <select name="provider" class="form-control select2 select2-together">
                <?php if(isset($providers)){?>
                    <?php foreach($providers as $provider){ ?>
                        <option value='<?php echo $provider->id ?>'><?php echo $provider->id ?></option>;
                    <?php } ?>
                <?php } ?>
                </select>
            </div>
            <div class="col-sm-7">
                <select class="form-control select2 select2-together">
                <?php if(isset($providers)){ ?>
                    <?php foreach($providers as $provider){ ?>
                        <option value='<?php echo $provider->id ?>'><?php echo $provider->name?></option>;
                    <?php } ?>
                <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Data</label>
            <div class="col-sm-10">
                <input name="date" type="text" class="form-control input-date" id="inputNomeProduto" value="<?php echo date('d/m/Y'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Quantidade</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input name="quantity" type="text" pattern="[0-9]+" class="form-control numeric quantity" id="inputGrupo">
                    <div class="input-group-addon"><?php echo $unit ?></div>
                </div>
            </div>

        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Valores</label>
            <div class="col-sm-5">
                <div class="input-group">
                    <div class="input-group-addon">R$</div>
                    <input name="value" type="text" class="form-control numeric value-uni" id="inputGrupo" placeholder="00,00">
                </div>
            </div>
            <div class="col-sm-5">
                <div class="input-group">
                    <div class="input-group-addon">R$</div>
                    <input name="" type="text" class="form-control numeric value-tot" id="inputGrupo" placeholder="00,00">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Empenho</label>
            <div class="col-sm-4">
                <input name="empenho" type="text" pattern="[0-9]+" class="form-control" id="inputGrupo">
            </div>
            <label for="inputGrupo" class="col-sm-2 control-label">Data</label>
            <div class="col-sm-4">
                <input name="empenhodate" type="text" class="form-control input-date" id="inputGrupo" value="<?php echo date('d/m/Y'); ?>">
            </div>

        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Nota fiscal</label>
            <div class="col-sm-4">
                <input name="fiscnote" type="text" pattern="[0-9]+" class="form-control" id="inputGrupo">
            </div>
            <label for="inputGrupo" class="col-sm-2 control-label">Data</label>
            <div class="col-sm-4">
                <input name="fiscnotedate" type="text" class="form-control input-date" id="inputGrupo" value="<?php echo date('d/m/Y'); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Observações</label>
            <div class="col-sm-10">
                <textarea name="obs" class="form-control" rows="3"></textarea>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary btn-send-form">Salvar</button>
</div>
