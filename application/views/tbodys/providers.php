<?php if (isset($providers) && is_array($providers)){ ?>
<?php $this->load->helper('security'); ?>
<tbody>
    <?php foreach($providers as $provider){ ?>

        <tr>
            <td>
                <a data-toggle="modal" data-target="#dynamicModal" href="<?php echo site_url("providers/edit/$provider->id");?>"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
            <td>
                <?php echo $provider->id; ?>
            </td>
            <td>
                <?php echo xss_clean($provider->name); ?>
            </td>
            <td>
                <?php echo xss_clean($provider->document); ?>
            </td>
        </tr>
    <?php } ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="4">
            <div class="text-center">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </td>
    </tr>
</tfoot>
<?php }?>
