<?php
/**
 * Template publique pour la galerie des books fleuristes
 * 
 */
 
?>
    
<h2>Exploration des books</h2> 

<?php if(isset($books->featured)) : ?>
<div class='row-fluid'>

    
        <p class='lead'>A découvrir sur FlorBook !</p>
        
        
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


<?php // partie recherche de photos
$this->load->view('books/pic_search'); 
?>


<?php if(isset($books->popular)) : // les books populaires ?>
<div class='row-fluid'>
        <p class='lead'>Les books les plus populaires <?php echo anchor('book/popular','Voir tous les books populaires','class="btn"'); ?>    </p>
 
        <?php foreach ($books->popular as $key => $book) : ?>      
            
            <?php //code($book); ?> 
            
            <?php $this->load->view('books/templates/book_thumb',$book); ?>
            
        <?php endforeach; ?> 
     
       
</div>

<?php endif; ?>


<div class='row-fluid'>
        <p class='lead'>Les books les plus récents <?php echo anchor('book/latest','Voir tous les books récents','class="btn"'); ?></p>
 
        <?php foreach ($books->latest as $key => $book) : // les books récents?>       
            
            <?php $this->load->view('books/templates/book_thumb',$book); ?>
            
        <?php endforeach; ?> 
     
           
</div>