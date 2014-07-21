<div class="table-header">
    <form role="form" class="form-inline">
        <a type="button" class="btn btn-success" data-toggle="modal" data-target="#dynamicModal" href="<?php echo site_url("users/add")?>">
            <span class="glyphicon glyphicon-plus"></span> Usuário</a>
        <div class="form-group">
            <div class="input-group">
                <input type="search" class="form-control" id="inputProduto" placeholder="Nome">
                <a href="#" class="input-group-addon"><span class="glyphicon glyphicon-search"></span></a>
            </div>
        </div>
    </form>
</div>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th class="las-collum"></th>
            <th>
                Nome
            </th>
            <th>Acesso</th>
            <th>Nível</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($users)){ ?>
            <?php foreach($users as $user){ ?>
        <tr>
            <td>
                <a data-toggle="modal" data-target="#dynamicModal" href="<?php echo site_url("users/edit/$user->iduser");?>"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
            <td>
                <?php echo $user->name; ?>
            </td>
            <td>
                <?php if($user->lastlogin === null){
                    echo '---';
                }else{
                    echo date('d/m/Y',$user->lastlogin);
                }?>
            </td>
            <td><?php echo $user->level;?></td>
        </tr>
            <?php } ?>
        <?php }?>
    </tbody>
</table>
