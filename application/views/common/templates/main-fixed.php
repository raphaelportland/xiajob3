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
    
<div class="container">         
<?php //$this->load->view('common/search-annonces'); ?>

 
<div class='row'> 
 
<?php $this->load->view($view); ?>

</div>

</div>

<?php $this->load->view('common/footer'); ?>