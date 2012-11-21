<div id='registration_form' class='box'>
    
<h2>Mes alertes</h2>
<p>à venir prochainement</p>

<?php echo form_open('fleurjob/register','class="form"'); ?>

<?php 






?>



<div class='hero-unit'>
    <h1>Mes alertes</h1>
    <p class='lead'>Enregistrez vos alertes pour être toujours au courant des annonces qui vous correspondent</p>
</div>

</br>


<?php echo anchor('register/ignore_register',"ignorer et passer à l'étape suivante",'class="btn btn-warning btn-large"'); ?>

<?php echo form_submit("register","valider et passer à l'étape suivante", "class='btn btn-primary btn-large pull-right'");?>

<?php echo form_close(); ?>
</div>


</div>