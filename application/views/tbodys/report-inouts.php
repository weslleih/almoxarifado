<?php if (isset($inouts) && is_array($inouts)){; ?>
<tbody>
    <?php foreach($inouts as $inout){ ?>
        <tr>
            <td>
                <?php echo $inout->id; ?>
            </td>
            <td>
                <?php echo $inout->name; ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->before, 2, ',', ''); ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->input, 2, ',', ''); ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->infisic, 2, ',', ''); ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->inimmediate, 2, ',', ''); ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->output, 2, ',', ''); ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->outfisic, 2, ',', ''); ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->outimmediate, 2, ',', ''); ?>
            </td>
            <td>
                <?php echo "R$".number_format($inout->now, 2, ',', ''); ?>
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
