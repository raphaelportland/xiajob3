<h1>Partager ce book</h1>
<?= anchor('book/show/'.$book->id, '<i class="icon icon-chevron-left"></i> Retour au book','class="btn"'); ?>

<?php $this->load->view('social/scripts'); ?>

<div class="share">
     
    <div class="social-share-item social-twitter">  
        <p class=''><strong>Sur Twitter</strong></p>       
        <a href="https://twitter.com/share" 
        class="twitter-share-button" 
        data-url="<?= $book->short_url; ?>" 
        data-text="<?= 'Découvrez &laquo; '.$book->name.' &raquo;'; ?>" 
        data-via="florBooks" 
        data-lang="fr" 
        data-size="large">Tweeter</a>        
    </div> 
     
    <!-- facebook like -->
    <div class="social-share-item social-facebook-like">
        <p class=''><strong>Sur facebook</strong></p>     
    
<fb:like href="<?= site_url('book/show/'.$book->id); ?>" show_faces="true"  send="true" width="450"
  action="like" colorscheme="light"></fb:like>            
    </div>
 
 
    <div class='social-share-item social-permalink'>
        <p class=''><strong>Lien direct vers ce book</strong></p>
        <div class="input-prepend">
        <span class="add-on"><i class='icon icon-share-alt'></i></span>
        <input type="text" value="<?= $book->short_url; ?>" class='input input-xlarge' />
        </div> 
        <p><small>URL raccourcie avec <?php echo anchor('https://bitly.com/','BitLy','target="_blank"'); ?></small></p>                
    </div> 
    
</div>