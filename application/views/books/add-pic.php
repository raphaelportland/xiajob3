<h2>"<?= $book->name; ?>"</h2>
<p class='lead'>Ajoutez des images à votre florBook <?php 

if(isset($book->pictures) && $book->pictures != null) 
{
    $pic_nb = count($book->pictures);
    
    echo "(".$pic_nb." photo";
    
    if($pic_nb > 1) echo "s";
    
    echo ")"; }
    else {
        $pic_nb = 0;
    } ?></p>

        <?php $this->load->view('books/upload_view'); ?>   
        
                 
<?php echo anchor("book/edit/".$book->id, "Modifier votre book", 'class="btn btn-primary"'); ?>

<input id="maxPics" type="hidden" name="maxpic" value="<?php echo 10-$pic_nb; ?>"/>

<br />
<br />

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