<p class='lead'>Commentaires</p>

<div class="ajaxLoader">
    <img src='<?= base_url().'public/img/ajax-loader.gif'; ?>'/>
</div>


<div id='comments_list'>
<?php 

if(isset($comments)) :
    foreach ($comments as $key => $comment) :
        if(isset($max_comments_to_display) && ($key < $max_comments_to_display)) {
            $this->load->view('comments/a_comment',$comment);    
        } elseif(!isset($max_comments_to_display)) {
            $this->load->view('comments/a_comment',$comment); 
        }       
    endforeach;
else :
    echo '<div class="comment">Aucun commentaire sur cette photo.</div>';
endif; ?>

<?php 
if((isset($nb)) && (isset($max_comments_to_display)) && ($nb > $max_comments_to_display)) {
    echo anchor('comments/show_by_pic/'.$pic_id,'Voir les '.$nb.' commentaires','class="comments-readmore"');   
}
?>


</div>

<?php if($this->session->userdata('user_id')) : ?>

<?php
$commentaire = array(
    'name' => 'comment',
    'id'    => 'comment-input'.$pic_id,
    'class' => 'comment-input input input-large',
    'value' => '', 
    'rows' => '2',
    'placeholder' => 'Votre commentaire',
);

echo form_open('comments/save_comment/'.$pic_id, 'data-pic_id="'.$pic_id.'" class="comment-form" id="comment-form'.$pic_id.'"');
 
echo form_textarea($commentaire);

echo form_submit('submit','Envoyer','class="btn btn-success"');
echo form_close(); ?>

<?php else : ?>
     
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Rejoignez-nous !</strong><br /><br />
  Vous devez être connecté pour pouvoir poster un commentaire.<br /><br />
  <?php echo anchor('fleurjob','Se connecter','class="btn btn-primary"'); ?>
</div>

<?php endif; ?>

