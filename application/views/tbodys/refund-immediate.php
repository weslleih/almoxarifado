<?php if (isset($productimmediates) && is_array($productimmediates)){ ?>
<tbody>
    <?php foreach($productimmediates as $productimmediate){ ?>
        <tr>
            <td>
                <a data-toggle="modal" data-target="#dynamicModal" href="<?php echo site_url("refund/ajaximmediate/$productimmediate->id"); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
            <td>
                <?php echo $productimmediate->id; ?>
            </td>
            <td>
                <?php echo $productimmediate->fiscnote; ?>
            </td>
            <td>
                <?php echo convert_date($productimmediate->date); ?>
            </td>
            <td>
                <?php echo $productimmediate->quantity; ?>
            </td>
            <td>
                <?php echo "R$".number_format($productimmediate->value, 2, ',', '');?>
            </td>
            <td>
                <?php echo $productimmediate->consumer;?>
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
