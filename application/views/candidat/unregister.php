<h2>Désinscription</h2>

<div class="alert alert-danger">
    <p class='lead'>Etes-vous sûr de vouloir vous désinscrire ?</p>
    <p>Cette action est <strong>irréversible</strong>.</p>  
    <p>Votre désinscription aura pour effet la suppression de toutes vos photos, books, commentaires, informations de profil professionnel...</p>
  
</div>



<?php echo anchor('register/unregister_confirm', 'Oui, je confirme ma désinscription.','class="btn btn-large btn-danger"'); ?>


<?php echo anchor('fleurjob', 'Non, je veux conserver mes informations', 'class="btn btn-large"');
