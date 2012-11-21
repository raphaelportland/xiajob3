<?php
/**
 * Template publique pour la partie candidat
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
<?php $this->load->view('common/search-annonces'); ?>

 
<div class='row-fluid'> 
    <div class='span12 fj_container'>
        <div class='span8 offset4'>
            <?php $this->load->view($view); ?>            
        </div>
    </div>
</div>

<?php $this->load->view('common/footer'); ?>