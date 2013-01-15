<?= form_open('ads/job_ad'); ?>


<!-- Expérience -->
<p class='lead'>Expérience <small class='muted'>(plusieurs choix possibles)</small></p>



<!-- Qualification -->
<p class='lead'>Qualification</p>



<!-- Divers -->
<p class='lead'>Divers</p>



<!-- Compétences -->
<p class='lead'>Compétences recherchées <small class='muted'>(optionnel)</small></p>

<?= anchor('ads/job_ad', '<i class="icon-chevron-left"></i> Retourner à l\'étape 1', 'class="btn pull-left"'); ?>

<button type='submit' class="btn btn-success pull-right" name='submit1' value="submit2">
    Suivant <i class='icon-chevron-right icon-white'></i>  
</button>
<?= form_close(); ?>

