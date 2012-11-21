<?php
/**
 * Template pour les book
 * 
 */

?>

 
<?php $this->load->view('common/head'); ?>


    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <div class='container-fluid'>
                <a class='brand'><?= $owner_fullname; ?></a>
                
                <?php echo anchor('fleurjob','découvrez FleurJob <i class="icon icon-white icon-share-alt"></i>','class="btn btn-primary pull-right" target="_blank"'); ?>
                
                <!--<ul class="nav pull-left">
                  
                  <li><?php echo anchor('fleurjob', '<i class="icon-home icon-white"></i> Accueil'); ?></li>
                  <li><?php echo anchor('fleurjob/welcome/candidat','Mon espace'); ?></a></li>
                  <li><?php echo anchor('auth/register/candidat','Inscription'); ?></li>
                  <li><a href="#">About</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>--> 
        </div>
      </div>
    </div>




<div class='container-fluid'>
 <div class="page-header">
  <h1><?= $book; ?> <small><?= $description; ?></small></h1>
</div>  

<div class='container'>
    
    <div id="myCarousel" class="carousel slide">
      <!-- Carousel items -->
      <div class="carousel-inner">
          
    <?php $i = 0; ?>
    <?php foreach ($pics as $picture) : ?>
        
        <div class="item <?php if($i == 0) { echo "active"; $i++; } ?>">
            <img src="<?= base_url().$picture->pic_url; ?>" alt="">
            <div class="carousel-caption">
              <h4><?= $picture->pic_name; ?></h4>
              <p><?= $picture->pic_comment; ?></p>
            </div>
        </div>
    
    <?php endforeach; ?>
    
      </div>
      <!-- Carousel nav -->
      <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div>
    
<p><small>&copy; Les photos présentées sur cette page sont la propriété de <strong><?= $owner_fullname; ?></strong>.</small></p>
</div>        
</div>


<?php $this->load->view('common/footer'); ?>