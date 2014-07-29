<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
    </button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $title;?></h4>
</div>
<div class="modal-body">
    <div class="alert alert-danger alert-dismissible hidden" role="alert">
        <ul class="errors-list"></ul>
    </div>
    <form class="form-horizontal" role="form" method="post" action="<?php echo $action;?>">
        <input name="verification" value="TRUE" class="hidden">
        <?php echo $message;?>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary btn-send-form">Salvar</button>
</div>
