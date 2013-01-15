<?= form_open('ads/job_ad'); ?>

<!-- Contact -->
<p class='lead'>Personne référente de l'offre</p>
nom<br />
email<br />
téléphone<br />


<br /><br />
<!-- Ville -->
<p class='lead'>Ville</p>
<div class='alert alert-info'>Votre annonce apparaîtra dans les alertes départementales selon la ville choisie.</div>
<?php $this->load->view('geo/city_select'); ?>




<button type='submit' class="btn btn-success pull-right" name='submit0' value="submit2">
    Suivant <i class='icon-chevron-right icon-white'></i>  
</button>
<?= form_close(); ?>