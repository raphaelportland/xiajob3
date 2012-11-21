

<h3>Commentaires sur cette photo</h3>


<img class='img img-polaroid' src='<?= base_url().$pic->th_url; ?>'/>

<?php 


if($this->session->userdata('user_id')) : ?>

<p class='lead'>Ajouter un commentaire</p>

<?php
$commentaire = array(
    'name' => 'comment',
    'id'    => 'comment-input',
    'class' => 'comment-input input input-large',
    'value' => '', 
    'rows' => '2',
    'placeholder' => 'Votre commentaire',
);

echo form_open('comments/save_comment/'.$pic->id, 'class="form form-horizontal comment-form" id="comment-form'.$pic->id.'"'); ?>

<div class='control-group'>
    <div class='control'>
<?php echo form_textarea($commentaire); ?>
    </div>
    <br />
    <div class='control'>    
<?php echo form_submit('submit','Envoyer','class="btn btn-success"'); ?>
    </div>
</div><?php 
echo form_close(); ?>

<?php else : ?>
    
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Rejoignez-nous !</strong><br /><br />
  Vous devez être connecté pour pouvoir poster un commentaire.<br /><br />
  <?php echo anchor('fleurjob','Se connecter','class="btn btn-primary"'); ?>
</div>

<?php endif; ?>
  
<p class='lead'>Commentaires</p>
<div class='span6'>
<?php

if(isset($comments)) :

    foreach ($comments->comments as $key => $comment) : ?>
        <div class='well well-small'>
        <?php $this->load->view('comments/a_comment',$comment); ?>            
        </div>
       
    <?php endforeach; ?>

<?php
else :
    
    echo 'Aucun commentaire sur cette photo.';

endif;
?>
</div> 