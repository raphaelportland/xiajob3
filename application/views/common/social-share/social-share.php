<div class="share">
    
    <!-- Google+ 
    <div class="social-share-item social-plusone">
        <g:plusone size="medium"></g:plusone>
    </div>-->
     
    <!-- twitter -->
    <div class="social-share-item social-twitter">         
        <a href="https://twitter.com/share" 
        class="twitter-share-button" 
        data-url="<?= $picture_url; ?>" 
        data-text="<?= $picture_description; ?>" 
        data-via="florBooks" 
        data-lang="fr" 
        data-size="large">Tweeter</a>        
    </div> 
     
    <!-- facebook like -->
    <div class="social-share-item social-facebook-like">     
        <div class="fb-like" 
        data-href="<?= $picture_url; ?>" 
        data-send="false" 
        data-width="450" 
        data-show-faces="true"></div>    
    </div>   

     
    <!-- Pinterest -->
    <div class='social-share-item social-pinterest'>    
        <a href="http://pinterest.com/pin/create/button/?url=<?= $site_url; ?>&media=<?= $picture_url; ?>&description=<?= $picture_description; ?>" count-layout="horizontal" class="pin-it-button btn">
            <img border="0" src="<?= base_url().'public/img/pinterest-btn.png'; ?>" title="Pin It" />
        </a>          
    </div>

</div>