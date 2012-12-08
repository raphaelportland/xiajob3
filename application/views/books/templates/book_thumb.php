<!--        <div class='book-main'>
            <div class='book-thumb'>
                <a class='' href='<?= $short_url; ?>'>
                    
                    <?php //code($book->pictures); ?>
                    
                    <?php if(isset($cover_pic) && $cover_pic != '0') : ?>
                        
                    <div class='th_crop'>
                    <img width='280' height='187' src='<?= base_url().$cover->th_url; ?>' />    
                    </div>                          
                    
                    <?php elseif(isset($pictures[0])) : ?>
                        
                    <div class='th_crop'>
                    <img width='280' height='187' src='<?= base_url().$pictures[0]->th_url; ?>' />    
                    </div>                   
                    
                    <?php else: ?>
                        
                    <img src='http://placehold.it/280x187&text=Pas+encore+de+photo!' class='' />    
                    
                    <?php endif; ?>
                </a>
            </div>
            
            <div class='book-content'>
                <p class='lead'><?= $name; ?></p>
                <p><?= $description; ?></p>
                <span class="label label-info">
<?php
    if(isset($occasion->name)) {
        echo $occasion->name;
    } elseif(isset($occasion_name)) {
        echo $occasion_name;
    } else {
        echo "erreur : pas d'occasion indiquée";
    }
 
?>
                    </span>
                
                <?php if(isset($context)) : ?>
                    <br /><br />             
                <?php switch($context) :

                    case "favorites" :
                        echo anchor('social/del_fav/'.$id, 'Retirer de mes favoris', 'class="btn btn-small"');
                        break;                
                
                endswitch; ?>
                <?php endif; ?>
            </div>
        </div>
        -->       
        
             
<div class='book-container'>
        


        <div class='book-th-top'>

                <?php if(isset($cover_pic) && $cover_pic != '0') : ?>
                <img width='280' height='187' src='<?= base_url().$cover->th_url; ?>' />    
                
                <?php elseif(isset($pictures[0])) : ?>
                    
                <img width='280' height='187' src='<?= base_url().$pictures[0]->th_url; ?>' />    
                
                <?php else: ?>
                    
                <img src='http://placehold.it/280x187&text=Pas+encore+de+photo!' class='' />    
                
                <?php endif; ?>
        </div>
        <div class='book-th-name'>
            <strong><?php echo anchor('book/view/'.$id, $name); ?></strong><br />
            <?php if(isset($owner)) : ?>            
             par 
            <?php echo anchor('profile/view/'.$owner->id, $owner->username); ?>
            <?php endif; ?>
        </div>
        
        
        

            <!-- COVER -->
            <div class='cover'>
                <a class='' href='<?= site_url('book/view/'.$id); ?>'> 
                    
                <div class='book-fav-count'>
                    <i class='icon icon-white icon-star'></i> <?= $fav_count; ?>
                </div>
                
                <div class='book-occasion'>
                    <span class="label label-success"><?= $occasion_name; ?></span>               
                </div>  
                    
                <?php if(isset($cover_pic) && $cover_pic != '0') : ?>
                <img width='280' height='187' src='<?= base_url().$cover->th_url; ?>' />    
                
                <?php elseif(isset($pictures[0])) : ?>
                    
                <img width='280' height='187' src='<?= base_url().$pictures[0]->th_url; ?>' />    
                
                <?php else: ?>
                    
                <img src='http://placehold.it/280x187&text=Pas+encore+de+photo!' class='' />    
                
                <?php endif; ?>

                </a>
            </div>
            <div class='book-th-shadow'>
                <img src='<?= base_url()."public/img/thumb-bg.png"; ?>' />
            </div>
</div>