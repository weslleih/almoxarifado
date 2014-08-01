<div class="table-header">
    <form role="form" class="form-inline form-table-search" method="post" action="<?php //echo $action;?>">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><span class="glyphicon glyphicon-chevron-right"></span></div>
                <input name="datebeg" type="text" class="form-control input-date" id="inputGrupo" value="<?php echo date('d/m/Y', strtotime("-1 month")); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input name="dateend" type="text" class="form-control input-date" id="inputGrupo" value="<?php echo date('d/m/Y'); ?>">
                <div class="input-group-addon"><span class="glyphicon glyphicon-chevron-left"></span></div>
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
        <div class="form-group">
                <input type="submit" class="btn btn-success" value="Enviar">
        </div>
    </form>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Grupo</th>
            <th>
                Descrição
            </th>
            <th>
                Saldo anterior
            </th>
            <th>
                Entrada
            </th>
            <th>
                Entrada física
            </th>
            <th>
                Entrada Consumo imediato
            </th>
            <th>
                Saída
            </th>
            <th>
                Saída física
            </th>
            <th>
                Saída Consumo Imediato
            </th>
            <th>
                Saldo atual
            </th>
        </tr>
    </thead>
    <?php  include('tbodys/report-inouts.php')?>
</table>
