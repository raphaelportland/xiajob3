<?php
/**
 * Template pour les formulaires d'inscription
 * 
 */
?>
 
<?php $this->load->view('common/head'); ?>

<?php $this->load->view('candidat/elmt/public-head-nav'); ?>  

 
<div class='container'>   
    
    <div class='span12'>
 
        <?php $this->load->view('candidat/registration/'.$view); ?>

    </div>
</div>

<?php $this->load->view('common/footer'); ?>