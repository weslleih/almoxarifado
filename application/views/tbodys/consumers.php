
<?php if (isset($consumers) && is_array($consumers)){ ?>
<?php $this->load->helper('security'); ?>
<tbody>
    <?php foreach($consumers as $consumer){ ?>
        <tr>
            <td>
                <a data-toggle="modal" data-target="#dynamicModal" href="<?php echo site_url("consumers/edit/$consumer->id");?>"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
            <td>
                <?php echo $consumer->id; ?>
            </td>
            <td>
                <?php echo xss_clean($consumer->name); ?>
            </td>
        </tr>
    <?php } ?>
</tbody>
<tfoot>
    <tr class="pagination-tr">
        <td colspan="3" class="pagination-tr">
            <div class="text-center">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </td>
    </tr>
</tfoot>
<?php }?>

