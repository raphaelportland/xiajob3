<?php
/**
 * Template publique pour la galerie des books fleuristes
 * 
 */
 
?>

<div class='row'>    
<h1>Explorer les florBooks</h1>
</div>

<?php if(isset($books->featured)) : ?>
<div class='row'>
    <div id="myCarousel-featured" class="carousel slide" data-interval="10000">
      <!-- Carousel items -->
      <div class="carousel-inner">
         
    <?php $i = 0; ?>
    <?php foreach ($books->featured as $key => $book) : ?>
        
        <div class="item <?php if($i == 0) { echo "active"; $i++; } ?>">
 
            <?php $this->load->view('books/templates/featured_book_thumb',$book); ?>
  
        </div>
    
    <?php endforeach; ?>
    
      </div>
      <!-- Carousel nav -->
      <a class="carousel-control left" href="#myCarousel-featured" data-slide="prev">&lsaquo;</a>
      <a class="carousel-control right" href="#myCarousel-featured" data-slide="next">&rsaquo;</a>
    </div>        

   
</div>
<?php endif; ?>

<div class='row'>
<?php // partie recherche de photos
// $this->load->view('books/pic_search'); 
?>
<div class='alert alert-info'>
    <strong>Recherche par fleur</strong>
    Bientôt disponible !
</div>
</div>


<?php if(isset($books->popular)) : // les books populaires ?>
<div class='row'>
    <span class='title-btn'><h2>les plus populaires</h2> <?php echo anchor('book/popular','<i class="icon-chevron-right"></i> Voir tout'); ?></span>
 
        <?php foreach ($books->popular as $key => $book) : ?>
        
        <?php $this->load->view('books/templates/book_thumb',$book); ?>
        
    <?php endforeach; ?>      
</div>

<?php endif; ?>


<div class='row section'>
    <span class='title-btn'><h2>les plus récents</h2> <?php echo anchor('book/latest','<i class="icon-chevron-right"></i> Voir tout'); ?></span>
 
        <?php foreach ($books->latest as $key => $book) : // les books récents?>       
        
        <?php $this->load->view('books/templates/book_thumb',$book); ?>
        
    <?php endforeach; ?>      
</div>