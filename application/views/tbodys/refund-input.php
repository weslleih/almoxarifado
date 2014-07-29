<?php if (isset($productinputs) && is_array($productinputs)){ ?>
<tbody>
    <?php foreach($productinputs as $productinput){ ?>
        <tr>
            <td>
                <a data-toggle="modal" data-target="#dynamicModal" href="<?php echo site_url("refund/ajaxinput/$productinput->id"); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
            <td>
                <?php echo $productinput->id; ?>
            </td>
            <td>
                <?php echo $productinput->name; ?>
            </td>
            <td>
                <?php echo convert_date($productinput->date); ?>
            </td>
            <td>
                <?php echo $productinput->quantity; ?>
            </td>
            <td>
                <?php echo "R$".number_format($productinput->value, 2, ',', '');?>
            </td>
            <td>
                <?php echo $productinput->empenho;?>
            </td>
        </tr>
    <?php } ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="7">
            <div class="text-center">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </td>
    </tr>
</tfoot>
<?php }?>
