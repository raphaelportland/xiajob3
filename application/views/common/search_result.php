<h1>Résultats de votre recherche</h1>

<?php // partie recherche de photos
$this->load->view('books/pic_search'); ?> 


<?php

if(isset($pictures['flowers'])) : ?>
    
    
<ul class="thumbnails">
 
    
    
<?php foreach ($pictures['flowers'] as $key => $pic) : ?>
    
    <?php //code($pic); ?>
        
  <li class="span3 picture_result">
    <div class="thumbnail">
      <img src="<?= base_url().$pic->th_url; ?>" />
        <div class='result_flowers'>
            <span class="label label-inverse"><?= $pic->name_fr; ?></span>
        </div>         
      <h3><?= $pic->pic_name; ?></h3>
        <?php echo anchor($pic->book_url, 'voir le book', 'class="btn btn-mini"'); ?> 
    </div>
  </li>
  
        
    
            

        

        
    <?php endforeach; ?>
</ul>       
<?php endif; ?>

