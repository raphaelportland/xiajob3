<?php
/**
 * Template principal
 * 
 */
?>
 
<?php $this->load->view('books/book-meta-head'); ?>

<?php 
if($this->session->userdata('user_id')) {
    $this->load->view('common/private-head-nav');    
} else {
    $this->load->view('common/public-head-nav');     
} 
?>
    
<div class="container">         
<?php //$this->load->view('common/search-annonces'); ?>

 
<!--<div class='row'> -->
 
<?php 
if(isset($pass_data) && isset($data)) :
    $this->load->view($view, $data);
else :
    $this->load->view($view);
endif; 
?>

<!--</div>-->

</div>

<?php $this->load->view('common/footer'); ?>