<?php if (isset($productoutputs) && is_array($productoutputs)){ ?>
<tbody>
    <?php foreach($productoutputs as $productoutput){ ?>
        <tr>
            <td>
                <a data-toggle="modal" data-target="#dynamicModal" href="<?php echo site_url("refund/ajaxoutput/$productoutput->id"); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
            <td>
                <?php echo $productoutput->id; ?>
            </td>
            <td>
                <?php echo $productoutput->name; ?>
            </td>
            <td>
                <?php echo convert_date($productoutput->date); ?>
            </td>
            <td>
                <?php echo $productoutput->quantity; ?>
            </td>
            <td>
                <?php echo "R$".number_format($productoutput->value, 2, ',', '');?>
            </td>
            <td>
                <?php echo $productoutput->responsible;?>
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
