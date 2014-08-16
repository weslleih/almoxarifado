<div class="table-header">
    <form role="form" class="form-inline form-table-search" method="post" action="<?php echo $action;?>">
        <?php if($this->session->userdata('level') == 2) { ?>
        <a type="button" class="btn btn-success" data-toggle="modal" data-target="#dynamicModal" href="<?php echo site_url("products/add");?>">
            <span class="glyphicon glyphicon-plus"></span> Produto
        </a>
        <?php } ?>
        <div class="form-group">
            <div class="input-group">
                <input name="term" type="search" class="form-control" id="inputProduto" placeholder="Nome ou código">
                <a href="" class="input-group-addon send-sarch">
                    <span class="glyphicon glyphicon-search"></span>
                </a>
            </div>
        </div>
        <div class="form-group" id="group-filer">
            <select  name="group" class="form-control select2" data-placeholder="Filtrar por grupo">
                <option value="0">Filtrar por grupo</option>
                <?php
                if(isset($groups)){
                    foreach($groups as $group){
                        echo "<option value='$group->id'>$group->id - $group->name</option>";
                    }
                }
                ?>
            </select>
        </div>
    </form>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <?php if($this->session->userdata('level') == 2) { ?>
            <th class="las-collum"></th>
            <?php } ?>
            <th class="las-collum">
                Código
            </th>
            <th>
                Nome
            </th>
            <th>
                Grupo
            </th>
            <th class="las-collum">
                Quantidade
            </th>
            <th class="las-collum" colspan="2">
                Valor
            </th>
        </tr>
    </thead>
    <?php  include('tbodys/products.php')?>
</table>
