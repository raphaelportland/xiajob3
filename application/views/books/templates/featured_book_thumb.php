<?php

$main_pic = $cover->pic_url;
$second_pic = $cover->th_url;

?>

        <div class='featured-book-thumb'>

                <div class='featured-mini-book-thumb'>
                    <a class='' href='<?= $short_url; ?>'>                        
                        <div class='featured_th_crop'>                           
                            <img class='img-polaroid' src='<?= base_url().$second_pic; ?>' /> 
                        </div>
                       
                    </a>
                </div>
                
                <div class='featured-book-content'>
                    <p class='lead'>florBooks présente :</p>
                    <h1><?= $name; ?></h1>
                    <p>par <?= anchor('profile/view/'.$owner->id, '<strong>'.$owner->username.'</strong>'); ?></p>
                    <p class='lead'><?= $description; ?></p>
                    <p>Catégorie : <span class="badge badge-info"><?= $occasion_name; ?></span></p>
                    
                <?php echo anchor($short_url,'Visiter ce florBook <i class="icon-chevron-right icon-white"></i>','class="featured-visit-btn btn pull-right btn-pink"'); ?>      
                </div>      
                
                     
                
            <img class='featured-book-background' src='<?= base_url().$main_pic; ?>' />             
        </div> 