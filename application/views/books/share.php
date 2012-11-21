<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '<?= $this->config->item('facebook_appId'); ?>', // App ID from the App Dashboard
      channelUrl : '<?= base_url(); ?>public/facebook/channel.php', // Channel File for x-domain communication
      status     : true, // check the login status upon init?
      cookie     : true, // set sessions cookies to allow your server to access the session?
      xfbml      : true  // parse XFBML tags on this page?
    });
    // Additional initialization code such as adding Event Listeners goes here
  };  

  // Load the SDK's source Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/fr_FR/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>

<!-- facebook Like Button -->
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=<?= $this->config->item('facebook_appId'); ?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<p class='lead'>Lien privé d'accès à votre book</p>

<?php if($user_is_owner) : ?>
    
    <p>Ceci est un lien privé d'accès à votre book. 
        Seules les personnes à qui vous transmettrez ce lien pourront avoir accès à vos photos.</p>
        
    <div class="input-prepend">
    <span class="add-on"><i class='icon icon-lock'></i></span>
    <input type="text" value="<?= $short_url; ?>" class='input input-xlarge' />
    </div> 
    <p><small>URL raccourcie avec <?php echo anchor('https://bitly.com/','BitLy'); ?></small></p>

    
<p class='lead'>Réseaux sociaux</p>    

<!-- facebook like -->
<div class="fb-like" data-href="<?= $short_url; ?>" data-send="true" data-width="450" data-show-faces="true"></div>

<br /><br />

<!-- Twitter share -->
<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?= $short_url; ?>" 
data-text="Découvrez mon book sur #FleurJob" data-via="fleurjob" data-lang="fr" data-size="large" 
data-related="fleurjob" data-count="none" data-hashtags="LesFleuristesOntDuTalent">Tweeter</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<br /><br /><br />
   
    <a href="<?= $short_url; ?>" target='_blank' class='btn'>Voir mon book tel qu'il apparaît</a>
    
<?php else : ?>
    
    <p>Vous n'avez pas l'autorisation de partager ce book, probablement car vous n'en êtes
        pas le propriétaire.</p>
        
<?php endif; ?>


    


