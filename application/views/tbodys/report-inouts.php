<?php if (isset($inouts) && is_array($inouts)){; ?>
<tbody>
    <?php foreach($inouts as $inout){ ?>
        <tr>
            <td>
                <?php echo $inout->gid; ?>
            </td>
            <td>
                <?php echo "$inout->name: $inout->observation"; ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->befvalue, 2, ',', ''); ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->invalue, 2, ',', ''); ?>
            </td>
            <td>
                <?php echo number_format($inout->inquantity, 2, ',', ''); ?>
            </td>
            <td>
                <?php //echo $inout->; ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->outvalue, 2, ',', ''); ?>
            </td>
            <td>
                <?php echo number_format($inout->outquantity, 2, ',', ''); ?>
            </td>
            <td>
                <?php //echo $inout->name; ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->value, 2, ',', ''); ?>
            </td>
        </tr>
    <?php } ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="10">
            <div class="text-center">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </td>
    </tr>
</tfoot>
<?php }?>
