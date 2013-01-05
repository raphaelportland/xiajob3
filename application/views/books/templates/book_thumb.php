<div class='book-container'>

        <div class='book-th-top'>

                <?php if(isset($cover_pic) && $cover_pic != '0') : ?>
                <img width='220' height='220' src='<?= base_url().$cover->th_url; ?>' />    
                
                <?php elseif(isset($pictures[0])) : ?>
                    
                <img width='220' height='220' src='<?= base_url().$pictures[0]->th_url; ?>' />    
                
                <?php else: ?>
                    
                <img src='http://placehold.it/220x220&text=Pas+encore+de+photo!' class='' />    
                
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
                <img width='220' height='220' src='<?= base_url().$cover->th_url; ?>' />    
                
                <?php elseif(isset($pictures[0])) : ?>
                    
                <img width='220' height='220' src='<?= base_url().$pictures[0]->th_url; ?>' />    
                
                <?php else: ?>
                    
                <img src='http://placehold.it/220x220&text=Pas+encore+de+photo!' class='' />    
                
                <?php endif; ?>

                </a>
            </div>
            <div class='book-th-shadow'>
                <img src='<?= base_url()."public/img/thumb-bg.png"; ?>' />
            </div>
</div>