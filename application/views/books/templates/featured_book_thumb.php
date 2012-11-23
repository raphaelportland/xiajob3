<?php

if(isset($cover_pic) && $cover_pic != '0') :
    
    $main_pic = $cover->pic_url;

else :
        
    $main_pic = $pictures[0]->pic_url;

endif;

$second_pic = $pictures[0]->th_url;

if(isset($cover_pic) && ($cover_pic == $pictures[0]->id) && (isset($pictures[1]))) :
    
     $second_pic = $pictures[1]->th_url;
    
endif;

?>

        <div class='featured-book-thumb'>

                <div class='featured-mini-book-thumb'>
                    <a class='' href='<?= $short_url; ?>'>
                        
                        <div class='featured_th_crop'>                           
                            <img width='290' height='210' src='<?= base_url().$second_pic; ?>' /> 
                        </div>
                       
                    </a>
                </div>
                
                <div class='featured-book-content'>
                    <h2><?= $name; ?></h2>
                    <p class='lead'><?= $description; ?></p>
                    <span class="label label-info"><?= $occasion_name; ?></span>
                    
                <?php echo anchor($short_url,'Visiter ce Book <i class="icon icon-arrow-right icon-white"></i>','class="featured-visit-btn btn btn-primary"'); ?>      
                </div>      
                
                     
                
            <img class='featured-book-background' src='<?= base_url().$main_pic; ?>' />             
        </div> 