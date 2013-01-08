<p class='lead'>Ajouter un administrateur</p>
    
<?php 
$new_admin = array(
    'name'  => 'new_admin',
    'id'    => 'new_admin',
    'value' => set_value('new_admin'),
    'maxlength' => 5,
    'size'  => 5,
);

echo form_open('admin/add_admin', 'class="form-inline"');

echo form_input($new_admin);
echo form_submit('submit','Ajouter', "class='btn'");

echo form_close(); 

?>


<p class='lead'>Administrateurs</p>

<table class='table table-bordered'>
    <tr><th>Infos</th><th></th></tr>
    
    <?php foreach ($admin_list as $key => $admin) : ?>
        
        <?php if($admin == '') : ?>
            
            <tr><td>
                <div class='alert'><strong>Admin id : <?= $key; ?></strong><br />
                Cet utilisateur n'existe plus.</div></td>
                <td><?= anchor('admin/del_admin/'.$key, '<i class="icon icon-white icon-trash"></i>', 'class="btn btn-danger confirm"'); ?></td>
            </tr>
            
        <?php else : ?>
        
        <tr>            
            <td>User id : <?= $key; ?><br />
            <?= anchor('profile/view/'.$admin->id, '<strong>'.$admin->username.' - '.$admin->full_name.'</strong>'); ?><br />
            <?= $admin->email; ?><br /><br />
            </td>
            <td>
                <?php if($key == $this->session->userdata('user_id')) : // notre propre ligne ?>
                <button class='btn btn-warning'><i class='icon-ban-circle icon-white'></i></button>
                <?php else : ?>
                <?= anchor('admin/del_admin/'.$admin->id, '<i class="icon icon-white icon-trash"></i>', 'class="btn btn-danger confirm"'); ?>
                <?php endif; ?>
                </td>
        </tr>
        
        <?php endif; ?>
        
    <?php endforeach; ?>
    
    
</table>
    
