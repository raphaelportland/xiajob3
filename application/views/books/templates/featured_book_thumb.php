<?php

$main_pic = $cover->pic_url;
$second_pic = $cover->th_url;


$long_name = $name;

if(strlen($name) > 16) {
    $name = substr($name,0,16).'...';
} 

$long_desc = $description;

if(strlen($description) > 50) {
    $description = substr($description, 0, 50).'&hellip;';
}



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
                    <p class='lead'>Florbooks présente :</p>
                    <h1 title='<?= $long_name; ?>'><?= $name; ?></h1>
                    <p>par <?= anchor('profile/view/'.$owner->id, '<strong>'.$owner->username.'</strong>'); ?></p>
                    <p class='lead' title='<?= $long_desc; ?>'><?= $description; ?></p>
                    <p>Catégorie : <span class="badge badge-info"><?= $occasion_name; ?></span></p>
                    
                <?php echo anchor($short_url,'Visiter ce florbook <i class="icon-chevron-right icon-white"></i>','class="featured-visit-btn btn pull-right btn-pink"'); ?>      
                </div>      
                
                     
                
            <img class='featured-book-background' src='<?= base_url().$main_pic; ?>' />             
        </div> 