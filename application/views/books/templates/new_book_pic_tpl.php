<div id="myCarousel-fullscreen" class="carousel" data-interval="false">
    
    <!-- Carousel items -->
    <div class="carousel-inner">
         
    <?php // début de la boucle d'affichage des photos
    foreach ($pictures as $key => $picture) :
        if(isset($picture->comments->nb)) {  // à vérifier
            $comments_nb = $picture->comments->nb;
        } else {
            $comments_nb = 0;
        } ?>        
        
        <div class="item <?php // on active la bonne photo
        if(isset($pic_to_display) && $pic_to_display == $picture->id) echo "active";
        if(!isset($pic_to_display) && $key == 0) echo "active"; ?>">
                    
        <div class="btn-group book-social">
                           
            <?php // lien pour afficher/masquer les commentaires
            $comment_link = array(
                'id' => 'book-social-comment'.$picture->id,
                'class' => 'btn btn-large btn-inverse book-social-comment', 
                'rel' => 'popover',  
                'data-title' => 'Commentaires',
                'data-pic_id' => $picture->id,
                'data-placement' => 'top',
                'data-content' => '',
                'data-location' => site_url('comments/show_by_pic/'.$picture->id),
            ); ?>               
                            
            <?php echo anchor('','<i class="icon-comment icon-white"></i> <small>'.$comments_nb.'</small>',$comment_link); ?>
                
            <!-- lien pour partager la photo -->                                               
            <a href="#" 
            rel="tooltip" 
            data-pic_id="<?= $picture->id; ?>" 
            data-placement="top" 
            data-title="Partagez cette photo" 
            class="book-social-share btn btn-large btn-inverse"><i class="icon-share-alt icon-white"></i></a>
            
            <!-- Bouton de retour au book -->            
            <?= anchor('book/show/'.$id,'<i class="icon icon-resize-small icon-white"></i> fermer','class="btn btn-inverse btn-large"'); ?>
        </div>
            
        <!-- panneau d'affichage des commentaires -->
        <div class='black-panel' id='black-panel<?= $picture->id; ?>'>
            <a title="fermer" class="close book-social-comment pull-right black-panel-close" 
            data-pic_id="<?= $picture->id; ?>">&times;</a>
            <div id='commentaires<?= $picture->id; ?>'>                                     
                <?php 
                $com_data['pic_id'] = $picture->id;
                $com_data['comments'] = $picture->comments->comments;
                $com_data['max_comments_to_display'] = 3;
                $com_data['nb'] = $comments_nb;
                $this->load->view('comments/pic_comments_mini',$com_data); ?>                    
            </div>
        </div>
        
        
              
        <!-- affichage des fleurs -->            
        <div class='picture_flowers'>
        <?php
            //code($picture);
            $flower_data['added_flowers'] = $picture->flower_data;
            $flower_data['pic_id'] = $picture->id;
            $flower_data['forbidden_edit'] = true;
            $this->load->view('books/added_flowers',$flower_data); 
        ?>
        </div> 
            
            
        <div id='share-modal-<?= $picture->id; ?>' class="modal hide fade">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Partager cette photo</h3>
            </div>
            <div class="modal-body">
                <?php
                $social_share_data['picture_url'] = base_url().$picture->pic_url; 
                $social_share_data['picture_description'] = $picture->pic_name;
                $social_share_data['site_url'] = base_url().'index.php/book/view/'.$picture->book_id;
                ?>
            
                <?php $this->load->view('common/social-share/social-share.php',$social_share_data); ?>
            
            </div>
        </div>            
 
        <!-- La photo ! -->
        <img class='carousel_pic' src="<?= base_url().$picture->pic_url; ?>" alt="">
            
        
        <?php // si la photo a un nom ou une description
        if($picture->pic_name != '' && $picture->pic_comment != '') : ?>
            <div class="carousel-caption">
              <h4><?= $picture->pic_name; ?></h4>
              <p><?= $picture->pic_comment; ?></p>
            </div>
            <?php endif; ?>       
        </div>
    
    <?php endforeach; ?>
    </div>
    
    
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel-fullscreen" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel-fullscreen" data-slide="next">&rsaquo;</a>
</div>   


<!-- Fenêtre modale pour se connecter -->
<div id='connect-modal' class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Rejoignez-nous !</h3>
    </div>
    <div class="modal-body">
        <p>Pour utiliser cette fonctionnalité, vous devez être connecté.</p>
    </div>
    <div class="modal-footer">
        <?php echo anchor('main', 'Connectez-vous', "class='btn btn-primary'"); ?>
    </div>
</div>
