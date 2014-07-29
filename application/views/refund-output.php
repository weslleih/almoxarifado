<div class="table-header">
    <form role="form" class="form-inline form-table-search" method="post" action="<?php echo $action;?>">
        <div class="form-group">
            <div class="input-group">
                <input name="term" type="search" class="form-control" id="inputProduto" placeholder="Fronecedor">
                <a href="#" class="input-group-addon"><span class="glyphicon glyphicon-search"></span></a>
            </div>
        </div>
    </form>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th class="las-collum"></th>
            <th class="las-collum">
                Código
            </th>
            <th>
                Consumidor
            </th>
            <th>
                Data
            </th>
            <th>
                Quantidae
            </th>
            <th>
                Valor
            </th>
            <th>
                Responsável
            </th>
        </tr>
    </thead>
        <?php  include('tbodys/refund-output.php')?>
</table>
