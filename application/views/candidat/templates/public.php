<?php
/**
 * Template publique pour la partie candidat
 * 
 */
?>
 
<?php $this->load->view('common/head'); ?>

<?php $this->load->view('candidat/elmt/public-head-nav'); ?>        

<!--        
    <header class='subhead'>
        
<?php $this->load->view('common/specific-access'); ?>            
        
        <div class='container'>
        <h1>FlorBook</h1>             
        <p>Révélez vos talents</p>             
        </div>        
    </header>
-->

    
<div class="container-fluid">         
<?php //$this->load->view('common/search-annonces'); ?>

 
<div class='row-fluid'> 
   <!-- <div class='span12 fj_container'>-->
 
<?php $this->load->view($view); ?>

   <!--</div> -->
</div>

<?php $this->load->view('common/footer'); ?>