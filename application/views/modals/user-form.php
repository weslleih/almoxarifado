
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
            <label for="inputNomeProduto" class="col-sm-3 control-label">Nome</label>
            <div class="col-sm-9">
                <input name="name" type="text" class="form-control" id="inputname" placeholder="Nome" autocomplete="off" <?php insert_input_value($this,"name");?>>
            </div>
        </div>
        <div class="form-group">
            <label for="inputNomeProduto" class="col-sm-3 control-label">Login</label>
            <div class="col-sm-9">
                <input name="login" type="text" class="form-control" id="inputlogin" placeholder="Login" autocomplete="off" <?php insert_input_value($this,"login");?>>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-3 control-label">Nível de Acesso</label>
            <div class="col-sm-9">
                <select name="level" class="form-control">
                    <option value="1" <?php insert_input_value($this,"level",1);?>>Consumidor</option>
                    <option value="2" <?php insert_input_value($this,"level",2);?>>Operador</option>
                    <option value="3" <?php insert_input_value($this,"level",3);?>>Administrador</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-3 control-label" >Senha</label>
            <div class="col-sm-9">
                <input name="password" type="password" class="form-control" id="inputNomeProduto" placeholder="*********" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-3 control-label">Confirmação</label>
            <div class="col-sm-9">
                <input name="password2" type="password" class="form-control" id="inputNomeProduto" placeholder="*********" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="inputGrupo" class="col-sm-3 control-label">Ativo</label>
            <div class="col-sm-9">
                <select name="active" class="form-control">
                    <option value="1" <?php insert_input_value($this,"active",1);?>>Sim</option>
                    <option value="0" <?php insert_input_value($this,"active",0);?>>Não</option>
                </select>
            </div>
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary btn-send-form">Salvar</button>
    </form>
</div>

