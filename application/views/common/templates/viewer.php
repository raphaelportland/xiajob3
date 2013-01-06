<?php
/**
 * Template de la visionneuse
 * 
 */
?>
 
<?php $this->load->view('pictures/pic-meta-head'); ?>
<?php //$this->load->view('common/social-share/social-share-scripts'); ?>

<?php // affichage du menu
if($this->session->userdata('user_id')) {
    $this->load->view('candidat/elmt/private-head-nav');    
} else {
    $this->load->view('candidat/elmt/public-head-nav');     
} 
?>

<?php $this->load->view($view); ?>

<?php $this->load->view('books/footer'); ?> 