<p class='lead'>Lien privé d'accès à votre book</p>

<?php if($infos->success) : ?>
    
    <p>Ceci est un lien privé d'accès à votre book. 
        Seules les personnes à qui vous transmettrez ce lien pourront avoir accès à vos photos.</p>
        
    <div class="input-prepend">
    <span class="add-on"><i class='icon icon-lock'></i></span>
    <input type="text" value="<?= $infos->private_link; ?>" class='input input-xlarge' />
    </div>    
    
    <a href="<?= $infos->private_link; ?>" target='_blank' class='btn'>Voir mon book tel qu'il apparaît</a>
    
    
<?php else : ?>
    
    <p>Vous n'avez pas l'autorisation de consulter le lien privé de ce book, probablement car vous n'en êtes
        pas le propriétaire.</p>
        
<?php endif; ?>


    


