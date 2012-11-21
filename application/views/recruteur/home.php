<?php

/**
 * Accueil recruteur
 * 
 */
?>


<div class="row-fluid">

    
<div class="span3">
    <ul class="nav nav-tabs nav-stacked">
        <li><a href=""><i class="icon-chevron-right"></i> Créer votre bureau de recrutement</a></li>
        <li><a href=""><i class="icon-chevron-right"></i> Ce qui est différent?</a></li>
        <li><a href=""><i class="icon-chevron-right"></i> Recevez des Candidatures</a></li>
        <li><a href=""><i class="icon-chevron-right"></i> Répondez en un clic</a></li>
        <li><a href=""><i class="icon-chevron-right"></i> Urgence, pensez Flash!</a></li>
    </ul>
</div>  

<div class='span9'>  
    
    <div id='offre-speciale-1'>
        <h1>Offre spéciale</h1>
        <p>Recevez 50€ de crédit</br>lors de votre</br>inscription</p>
    </div>

    <p class='lead'>"Etre patron aujourd'hui, 
        c'est être performant pour recruter une équipe 
        qui colle à l'esprit de mon entreprise"</p>
    
    <?php echo anchor('auth/register/recruteur',"Créer un compte sur FleurJob","class='btn btn-large btn-primary'"); ?>         
</div>

<ul class="thumbnails">
  <li class="span3">
    <div class="thumbnail">
      <img src="http://placehold.it/300x200" alt="">
      <h3>Créer mon bureau</h3>
      <p>Thumbnail caption...</p>
    </div>
  </li>

  <li class="span3">
    <div class="thumbnail">
      <img src="http://placehold.it/300x200" alt="">
      <h3>Déposer une annonce</h3>
      <p>Thumbnail caption...</p>
    </div>
  </li>
  
  <li class="span3">
    <div class="thumbnail">
      <img src="http://placehold.it/300x200" alt="">
      <h3>Urgence ? Flash</h3>
      <p>Thumbnail caption...</p>
    </div>
  </li>
  
  <li class="span3">
    <div class="thumbnail">
      <img src="http://placehold.it/300x200" alt="">
      <h3>Consulter la CVthèque</h3>
      <p>Thumbnail caption...</p>
    </div>
  </li>  
  
</ul>
    

    
</div>
