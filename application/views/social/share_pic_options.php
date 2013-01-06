<h1>Partager cette photo</h1>
<?= anchor('book/show/'.$picture->book_id.'/picture/'.$picture->id, '<i class="icon icon-chevron-left"></i> Retour à la photo','class="btn"'); ?>
<br /><br /><img src='<?= base_url().$picture->th_url; ?>' class='img-polaroid'/>

<?php $this->load->view('social/scripts'); ?>

<div class="share">
     
    <div class="social-share-item social-twitter">  
        <p class=''><strong>Sur Twitter</strong></p>       
        <a href="https://twitter.com/share" 
        class="twitter-share-button" 
        data-url="<?= $pic_url; ?>" 
        data-text="<?= 'Une belle création !'; ?>" 
        data-via="florBooks" 
        data-lang="fr" 
        data-size="large">Tweeter</a>        
    </div> 
     
    <!-- facebook like -->
    <div class="social-share-item social-facebook-like">
        <p class=''><strong>Sur facebook</strong></p>        
        <fb:like href="<?= site_url('social/share_pic/'.$picture->id); ?>" show_faces="true" send="true" width="450"
        action="like" colorscheme="light"></fb:like>            
    </div>
    
    <!-- pinterest -->
    <div class='social-share-item social-pinterest'> 
        <p class=''><strong>Sur Pinterest</strong></p>   
        <a href="http://pinterest.com/pin/create/button/?url=<?= $pic_url; ?>&media=<?= base_url().$picture->pic_url; ?>&description=<?= $picture->pic_comment; ?>" count-layout="horizontal" class="pin-it-button btn">
            <img border="0" src="<?= base_url().'public/img/pinterest-btn.png'; ?>" title="Pin It" />
        </a>          
    </div>    
    
</div>