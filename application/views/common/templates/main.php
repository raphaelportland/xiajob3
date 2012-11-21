<?php
/**
 * Template principal
 * 
 */
?>
 
<?php $this->load->view('common/head'); ?>

<?php 
if($this->session->userdata('user_id')) {
    $this->load->view('candidat/elmt/private-head-nav');    
} else {
    $this->load->view('candidat/elmt/public-head-nav');     
} 
?>        

<!--        
    <header class='subhead'>
        
<?php //$this->load->view('common/specific-access'); ?>            
        
        <div class='container'>
        <h1>FlorBook</h1>             
        <p>Révélez vos talents</p>             
        </div>        
    </header>
-->

    
<div class="container-fluid">         
<?php //$this->load->view('common/search-annonces'); ?>

 
<div class='row-fluid'> 
 
<?php $this->load->view($view); ?>

</div>

<?php $this->load->view('common/footer'); ?>