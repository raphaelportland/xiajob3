        <div class='featured-book-thumb'>

                <div class='featured-mini-book-thumb'>
                    <a class='' href='<?= $short_url; ?>'>
                        
                        <div class='featured_th_crop'>
                            
                            
            <img width='290' height='210' src='
            <?php
            if(isset($pitures->pics[1]->th_url)) {
                echo base_url().$pictures->pics[1]->th_url;
            } else {
                echo base_url().$pictures->pics[0]->th_url;
            } ?>' /> 
            
                            
                            
                          
                        </div>
                       
                    </a>
                </div>
                
                <div class='featured-book-content'>
                    <h2><?= $name; ?></h2>
                    <p class='lead'><?= $description; ?></p>
                    <span class="label label-info"><?= $occasion->name; ?></span>
                    
                <?php echo anchor($short_url,'Visiter ce Book <i class="icon icon-arrow-right icon-white"></i>','class="featured-visit-btn btn btn-primary"'); ?>      
                </div>      
                
                     
                
            <img class='featured-book-background' src='<?= base_url().$pictures->pics[0]->pic_url; ?>' />             
        </div> 