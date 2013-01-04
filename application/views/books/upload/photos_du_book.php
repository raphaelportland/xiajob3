<!-- Aperçu des photos contenues dans le book -->

<?php if(isset($book->pic_nb) && $book->pic_nb != 0) : ?>

<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        Voir les <?php echo $book->pic_nb; ?> photos de ce book
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse">
      <div class="accordion-inner">
          
        <?php foreach ($book->pictures as $key => $picture) : ?>
            <img class='img-polaroid' src='<?= base_url().$picture->th_url; ?>'/>   
        <?php endforeach; ?>
        
      </div>
    </div>
  </div>

</div>
<?php endif; ?>