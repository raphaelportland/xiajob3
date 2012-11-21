<?php
/**
 * Template pour les formulaires d'inscription
 * 
 */
?>
 
<?php $this->load->view('common/head'); ?>

<?php $this->load->view('common/head-nav'); ?>        
        
    <header class='subhead'>
        
<?php $this->load->view('common/specific-access'); ?>            
        
        <div class='container'>
        <h1>Fleur-Emploi.com</h1>             
        <p>Le seul site d'emploi dédié aux fleuristes</p>             
        </div>        
    </header>


    
<div class="container-fluid">

 
<div class='row-fluid'> 
    <div class='span12 fj_container'>
 
<?php $this->load->view($view); ?>

    </div>
</div>

<?php $this->load->view('common/footer'); ?>