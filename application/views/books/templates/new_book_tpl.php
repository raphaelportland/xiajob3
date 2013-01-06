<?php //$this->load->view('books/new_head'); ?>





<div class='container'>

    <!--<img src='<?= base_url().$cover->th_url; ?>' class='img-polaroid' /> COVER-->
    
    <div class='basic-info'>
        <h1><?= $name; ?></h1>        
        <p class='muted'><?php if($description != '') :
        echo $description;
        else : 
        echo 'aucune description';
        endif; ?></p>
    </div>
    
    <table class='table'>
        <tr><th>Auteur</th><td><?= anchor('profile/view/'.$owner->id, $owner->username); ?></td></tr>
        <tr><th>Catégorie</th><td><span class="badge badge-success"><?= $occasion_name; ?></span></td></tr>
        <tr><th>Nombre de favoris</th><td><span class="badge badge-success"><?= $fav_count; ?></span></td></tr>
        <tr><th>Nombre de photos</th><td><?= count($pictures); ?></td></tr>
    </table>

    <div class='actions'>
        <?php if($viewer_is_owner == true) echo anchor('book/edit/'.$id, '<i class="icon icon-white icon-edit"></i> Modifier','class="btn btn-primary"'); ?>          
        
        <?php // bouton ajouter ou retirer des favoris 
        if($is_your_fav == true) :
        echo anchor('social/del_fav/'.$id.'/book', '<i class="icon icon-white icon-star"></i> Retirer des favoris','class="btn btn-danger"');
        else :
        echo anchor('social/add_fav/'.$id,'<i class="icon icon-star"></i> Ajouter aux favoris','class="btn"');
        endif; ?>
             
        <?= anchor('social/share_book/'.$id, '<i class="icon icon-share-alt"></i> Partager ce book', 'class="btn"'); ?> 
        <?= anchor('book/show/'.$id.'/diaporama', '<i class="icon icon-resize-full"></i> Voir en grand', 'class="btn"'); ?>
    </div>
    

    
    <div class='miniatures clearfix'>
        <p class='lead'>Photos</p>   
        
        <?php foreach ($pictures as $key => $pic) : ?>
            
            <?php $this->load->view('pictures/thumb', $pic); ?>

        <?php endforeach; ?>
        
    </div>

</div>