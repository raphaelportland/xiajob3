<div class="share">
     
    <div class="social-share-item social-twitter">         
        <a href="https://twitter.com/share" 
        class="twitter-share-button" 
        data-url="<?= $short_url; ?>" 
        data-text="<?= $description; ?>" 
        data-via="florBooks" 
        data-lang="fr" 
        data-size="large">Tweeter</a>        
    </div> 
     
    <!-- facebook like -->
    <div class="social-share-item social-facebook-like">     
        <fb:like href="<?= site_url('social/share_book/'.$book_id); ?>" layout="button_count" send="true" show_faces="false" width="240" height="40" action="like" colorscheme="light"></fb:like>    
    </div>
 
 
    <div class='social-share-item social-permalink'>
        <p class=''><strong>Lien direct vers ce book</strong></p>
        <div class="input-prepend">
        <span class="add-on"><i class='icon icon-share-alt'></i></span>
        <input type="text" value="<?= $short_url; ?>" class='input input-xlarge' />
        </div> 
        <p><small>URL raccourcie avec <?php echo anchor('https://bitly.com/','BitLy','target="_blank"'); ?></small></p>                
    </div> 
    
</div>