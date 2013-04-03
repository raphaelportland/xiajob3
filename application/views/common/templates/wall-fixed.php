<?php
/**
 * Template principal New 
 * 
 */
?>
 
<?php $this->load->view('common/head'); ?>

<?php 
if($this->session->userdata('user_id')) {
    $this->load->view('common/private-head-nav');    
} else {
    $this->load->view('common/public-head-nav');     
} 
?>
    
<!--<div class="container">    -->     
 
    <?php 
    
	if(isset($pass_data) && isset($data)) :
        $this->load->view($view, $data);
    else :
        $this->load->view($view);
    endif; 
    ?>

<!--</div>--> 

<?php $this->load->view('common/footer'); ?>