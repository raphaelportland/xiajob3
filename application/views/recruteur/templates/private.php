<?php
/**
 * Template privé pour les recruteurs
 * 
 */
?>
 
<?php $this->load->view('common/head'); ?>

<?php $this->load->view('recruteur/elmt/private-head-nav'); ?>        
        
    <header class='subhead subhead-recruteur'>        
        
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