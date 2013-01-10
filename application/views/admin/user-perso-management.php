


<!-- Liste perso -->
<p class='lead'>Liste des utilisateurs compte perso</p>

<div class='well'><strong><?= count($users); ?></strong> utilisateurs inscrits.</div>

<table class='table table-bordered'>
    <tr><th>ID</th><th>Nom</th><th>email</th><th>action</th></tr>
    
    <?php foreach ($users as $key => $user) : ?>
      
        <tr><td><?= $user->id; ?></td>
            <td><?= anchor('profile/view/'.$user->id,$user->username) . ' (' . $user->full_name . ')'; ?></td>
            <td><?= $user->email; ?></td>
            <td>
                <?php if($user->ban_status == 0) : ?>
                
                    <?= anchor('admin/ban_user/'.$user->id, '<i class="icon-ban-circle icon-white"></i> Suspendre', 'class="btn btn-warning"'); ?> 
                
                <?php else : ?>
                    
                    <?= anchor('admin/unban_user/'.$user->id, '<i class="icon-ok-circle icon-white"></i> Réactiver', 'class="btn btn-success"'); ?>
                
                <?php endif; ?>
            </td></tr>
        
    <?php endforeach; ?>
    
    
</table>
<?php //code($users); ?>
