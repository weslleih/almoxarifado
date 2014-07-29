<?php if (isset($users) && is_array($users)){ ?>
<tbody>
    <?php foreach($users as $user){ ?>
        <tr <?php if($user->active == 0){echo 'class="danger"';}?>>
            <td>
                <a data-toggle="modal" data-target="#dynamicModal" href="<?php echo site_url("users/edit/$user->id");?>"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
            <td>
                <?php echo $user->name; ?>
            </td>
            <td>
                <?php echo $user->login; ?>
            </td>
            <td>
                <?php if($user->lastlogin === null){
                    echo '---';
                }else{
                    echo date('d/m/Y H:i:s',strtotime($user->lastlogin));
                }?>
            </td>
            <td><?php echo $user->level;?></td>
        </tr>
    <?php } ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="5">
            <div class="text-center">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </td>
    </tr>
</tfoot>
<?php }?>
