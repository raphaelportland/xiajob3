<h2>Ajouter des images</h2>
<p class='lead'>Ajoutez des images à votre book <strong>"<?= $book->book; ?>"</strong></p>
        <?php $this->load->view('candidat/book/upload_view'); ?>   
        
                 
<?php echo anchor("fleurjob/edit_profile/3", "Retour à mes books", 'class="btn"'); ?>

<br />
<br />

<?php if(isset($book->pics)) : ?>

<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        Voir les <?php echo $book->pictures->nb; ?> photos de ce book
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse">
      <div class="accordion-inner">
          
          <?php foreach ($book->pics as $key => $picture) : ?>
              
              
           <img class='img-polaroid' src='<?= base_url().$picture->th_url; ?>'/>   
          
          
          
          <?php endforeach; ?>
      </div>
    </div>
  </div>

</div>
<?php endif; ?>