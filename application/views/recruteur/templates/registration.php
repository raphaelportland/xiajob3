<?php
/**
 * Template pour les formulaires d'inscription
 * 
 */
?>
 
<?php $this->load->view('common/head'); ?>

<?php $this->load->view('recruteur/elmt/public-head-nav'); ?>  

 
<div class='container'>   

 
<?php $this->load->view('recruteur/registration/register-progress'); ?> 
 
<?php $this->load->view('recruteur/registration/'.$view); ?>
 


</div>

<?php $this->load->view('common/footer'); ?>