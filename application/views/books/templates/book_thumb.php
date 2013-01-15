<div class='book-container'>

    <!-- Le lien qui emballe la cover -->
    <a href='<?= site_url('book/show/'.$id); ?>'>
        <div class='cover'>

            <!-- le nombre de favoris -->
            <div class='book-fav-count'>
                <i class='icon icon-white icon-star'></i> <?= $fav_count; ?>
            </div>
            
            <!-- l'occasion du book -->
            <div class='book-occasion'>
                <span class="label label-success"><?= $occasion_name; ?></span>
            </div>


            <!-- La couverture du book -->
            <img class='img-polaroid' src='<?= base_url().$cover->th_url; ?>' />
        </div>
    </a>
    
    <!-- Les infos sous le book -->
    <div class='book-th-bot'>
        <div class='book-name'>
            <?php 
            
            $long_name = $name;
            
            if(strlen($name) > 21) {

                $name = substr($name,0,20).'&hellip;';
            
            } ?>
            
            
            <?php echo anchor('book/show/'.$id, $name, 'title="'.$long_name.'"'); ?>
        </div>
        
        <?php if(isset($owner)) : ?>            
        <div class='book-author'>
            par <?php echo anchor('profile/view/'.$owner->id, $owner->username); ?>
        </div>
        
        <?php endif; ?>            
    </div>
</div>