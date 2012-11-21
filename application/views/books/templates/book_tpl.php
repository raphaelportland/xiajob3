<?php
/**
 * Template pour les books
 * 
 */

if($this->session->userdata('user_id')) {
    // l'utilisateur est connecté
    $logged_in = 'true';
} else {
	$logged_in = 'false';
}
 
?>

 
<?php $this->load->view('books/head'); ?>

<?php $this->load->view('common/social-share/social-share-scripts'); ?>
  
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <div class='container-fluid'>
               <a class='brand'><?= $name; ?></a> 
                
                <?php echo anchor('fleurjob','découvrez florBooks <i class="icon icon-white icon-share-alt"></i>','class="btn btn-primary pull-right"'); ?>
                
                <?php echo anchor('book','Explorer d\'autres Books','class="btn"'); ?>
                
                <ul class="nav pull-left">
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">en savoir plus sur ce book...<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li class='book-description'>
                              <?php
                              
                              if(isset($description)) {
                                  echo $description;
                              } else {
                                  echo "Aucune description n'a été donnée à ce book.";
                              }
                              ?>
                          </li>
                        </ul>
                      </li>
                </ul> 
        </div>
      </div> 
    </div>
    
    <div id="myCarousel-fullscreen" class="carousel ">
      <!-- Carousel items -->
      <div class="carousel-inner">
         
    <?php $i = 0; ?>
    <?php foreach ($pictures->pics as $picture) : ?>
        
        <?php
            if(isset($picture->comments->nb)) {
                $comments_nb = $picture->comments->nb;
            } else {
                $comments_nb = 0;
            }
        
        ?>        
        
        <div class="item <?php if($i == 0) { echo "active"; $i++; } ?>">
                    
            <div class="btn-group book-social">
                <?php if($viewer_is_owner == true) : ?>
                    <?php echo anchor('book/edit/'.$id, 'Modifier mon book', 'class="btn btn-large btn-inverse"'); ?>
                <?php endif; ?>
                           
<?php
$comment_link = array(
    'id' => 'book-social-comment'.$picture->id,
    'class' => 'btn btn-large btn-inverse book-social-comment', 
    'rel' => 'popover',  
    'data-title' => 'Commentaires',
    'data-pic_id' => $picture->id,
    'data-placement' => 'top',
    'data-content' => '',
    'data-location' => site_url('comments/show_by_pic/'.$picture->id),
); 

//code($picture);
?>               
                
                
<?php echo anchor('','<i class="icon-comment icon-white"></i> <small>'.$comments_nb.'</small>',$comment_link); ?>
                                                   

<a href="#" 
rel="tooltip" 
data-pic_id="<?= $picture->id; ?>" 
data-placement="top" 
data-title="Partagez" 
class="book-social-share btn btn-large btn-inverse"><i class="icon-share-alt icon-white"></i></a>


<a href="#" 
rel="tooltip" 
data-book_id="<?= $picture->book_id; ?>" 
data-placement="top" 
data-logged_in="<?= $logged_in; ?>"
data-title="Book favori" 
data-action="<?= site_url('social/add_fav'); ?>"
class="book-social-fav btn btn-large btn-inverse">
<?php if(isset($is_fav) && $is_fav == true) : ?>
<i class="icon-star icon-color"></i>   
<?php else : ?>
<i class="icon-star icon-white"></i>
<?php endif; ?>
</a>
</div>
            
            
            <div class='black-panel' id='black-panel<?= $picture->id; ?>'>
                <div id='commentaires<?= $picture->id; ?>'> 
                    <?php 
                    $com_data['pic_id'] = $picture->id;
                    $com_data['comments'] = $picture->comments->comments;
                    $com_data['max_comments_to_display'] = 3;
                    $com_data['nb'] = $comments_nb;
                    $this->load->view('comments/pic_comments_mini',$com_data); ?>                    
                </div>
            </div>
                    
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
                <!-- <p>Photo id : <?= $picture->id; ?></p> -->
                
                <?php
                $social_share_data['picture_url'] = base_url().$picture->pic_url; 
                $social_share_data['picture_description'] = $picture->pic_name;
                $social_share_data['site_url'] = base_url().'index.php/book/view/'.$picture->book_id;
                ?>
                
                <?php $this->load->view('common/social-share/social-share.php',$social_share_data); ?>
                
              </div>
             <!--<div class="modal-footer">
              </div>-->
            </div>            
            
             
            
                       
            
            
            <img class='carousel_pic' src="<?= base_url().$picture->pic_url; ?>" alt="">
            
            <?php if($picture->pic_name != '' && $picture->pic_comment != '') : ?>
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



<div id='connect-modal' class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Rejoignez-nous !</h3>
  </div>
  <div class="modal-body">
    <p>Pour utiliser cette fonctionnalité, vous devez être connecté.</p>
  </div>
  <div class="modal-footer">
      <?php echo anchor('fleurjob', 'Connectez-vous', "class='btn btn-primary'"); ?>
  </div>
</div>

<?php $this->load->view('books/footer'); ?>