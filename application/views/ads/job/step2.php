<?= form_open('ads/job_ad'); ?>

<!-- Description -->
<p class='lead'>Description rapide du poste</p>


<!-- contrat -->
<p class='lead'>Type de contrat</p>


<!-- Rythme -->
<p class='lead'>Rythme hebdomadaire</p>


<!-- Salaire -->
<p class='lead'>Salaire de base</p>


<!-- Date -->
<p class='lead'>Date de démarrage</p>



<?= anchor('ads/job_ad/1', '<i class="icon-chevron-left"></i> Retourner à l\'étape 2', 'class="btn pull-left"'); ?>

<div class='btn-group'>
    
<button type='submit' class="btn btn-success pull-right" name='submit2' value="Voir l'annonce <i class='icon-chevron-right icon-white'></i>" />
</div>
<?= form_close(); ?>
