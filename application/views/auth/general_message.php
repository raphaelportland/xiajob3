<?php $this->load->view('common/head'); ?>

<?php 
if($this->session->userdata('user_id')) {
    $this->load->view('common/private-head-nav');    
} else {
    $this->load->view('common/public-head-nav');     
} 
?>
    
<div class="container">   
    
<h1>Information</h1>

<div class='alert alert-info'><?= $message; ?></div>

</div>

<?php $this->load->view('common/footer'); ?>