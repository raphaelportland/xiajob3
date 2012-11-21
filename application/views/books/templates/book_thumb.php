        <div class='book-main'>
            <div class='book-thumb'>
                <a class='' href='<?= $short_url; ?>' target='_blank'>
                    
                    <?php if($pictures->nb > 0): ?>
                    
                    <div class='th_crop'>
                    <img width='280' height='187' src='<?= base_url().$pictures->pics[0]->th_url; ?>' />    
                    </div>
                    
                    
                    <?php else: ?>
                        
                    <img src='http://placehold.it/280x187&text=No+Pic' class='' />    
                    
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