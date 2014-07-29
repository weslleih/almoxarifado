<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">Novo produto</h4>
</div>
<div class="modal-body">
    <div class="alert alert-danger alert-dismissible hidden" role="alert">
        <ul class="errors-list"></ul>
    </div>
    <form class="form-horizontal" role="form" method="post" action="<?php echo $action;?>">
        <div class="form-group">
            <label for="inputNomeProduto" class="col-sm-2 control-label">Produto</label>
            <div class="col-sm-3">
                <input name="idproduct" type="text" class="form-control" id="inputNomeProduto" placeholder="Código" <?php insert_input_value($this,"id");?> disabled>
            </div>
            <div class="col-sm-7">
                <input name="name" type="text" class="form-control" id="inputNomeProduto" placeholder="Nome do produto" <?php insert_input_value($this,"name");?>>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Grupo</label>
            <div class="col-sm-3">
                <select name="idgroup" class="form-control select2 select2-together" placeholder="Código" required>
                <option></option>
                <?php if(isset($groups)){?>
                    <?php foreach($groups as $group){ ?>
                        <option value='<?php echo $group->id ?>' <?php insert_option_value($this,"group",$group->id)?>><?php echo $group->id ?></option>";
                    <?php } ?>
                <?php } ?>
                </select>
            </div>
            <div class="col-sm-7">
                <select class="form-control select2 select2-together" placeholder="Código" required>
                <option></option>
                <?php if(isset($groups)){ ?>
                    <?php foreach($groups as $group){ ?>
                        <option value='<?php echo $group->id ?>' <?php insert_option_value($this,"group",$group->id)?>><?php echo $group->name?></option> ";
                    <?php } ?>
                <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputUnidate" class="col-sm-2 control-label">Unidade</label>
            <div class="col-sm-10">
                <input name="unit" type="text" class="form-control select2-new" type="hidden" id="inputGrupo" placeholder="Kg, m²" <?php insert_input_value($this,"unit");?>>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Estoque</label>
            <div class="col-sm-5">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-arrow-down"></span></div>
                    <input name="mininvent" type="number" class="form-control" id="inputGrupo" placeholder="Mínimo" <?php insert_input_value($this,"mininvent");?>>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-arrow-up"></span></div>
                    <input name="maxinvent" type="number" class="form-control" id="inputGrupo" placeholder="Máximo" <?php insert_input_value($this,"maxinvent");?>>
                </div>
            </div>
        </div>
         <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">CatMat</label>
            <div class="col-sm-10">
                <input name="catmat" type="text" class="form-control" id="inputGrupo" placeholder="" <?php insert_input_value($this,"catmat");?>>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-2 control-label">Observações</label>
            <div class="col-sm-10">
                <textarea name="observation" class="form-control" rows="3"><?php insert_textarea_value($this,"observation");?></textarea>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary btn-send-form">Salvar</button>
</div>

