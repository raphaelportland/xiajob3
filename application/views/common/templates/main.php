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

    
<div class="container-fluid">         
<?php //$this->load->view('common/search-annonces'); ?>

 
<div class='row-fluid'> 
<?php 
if(isset($pass_data) && isset($data)) :
    $this->load->view($view, $data);
else :
    $this->load->view($view);
endif; 
?>

</div>

</div>

<?php $this->load->view('common/footer'); ?>