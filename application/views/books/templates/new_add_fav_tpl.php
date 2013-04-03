<?php //$this->load->view('books/new_head'); ?>





<div class='container'>

    <!--<img src='<?= base_url().$cover->th_url; ?>' class='img-polaroid' /> COVER-->
 
    <div class='actions'>
        <?php if($viewer_is_owner == true) echo anchor('book/edit/'.$id, '<i class="icon icon-white icon-edit"></i> Modifier','class="btn btn-primary"'); ?>          
        
        <?php // bouton ajouter ou retirer des favoris 
        if($is_your_fav == true) :
        echo anchor('social/del_fav/'.$id.'/book', '<i class="icon icon-white icon-star"></i> Retirer des favoris','class="btn btn-danger"');
        else :
        echo anchor('social/add_fav/'.$id,'<i class="icon icon-star"></i> Ajouter aux favoris','class="btn"');
        endif; ?>
    </div>
    

  

</div>