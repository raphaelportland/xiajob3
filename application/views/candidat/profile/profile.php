<h1>Mon profil</h1>

<?php $this->load->view('candidat/profile/profile_submenu'); ?>

<?php if($this->session->userdata('fb_message')) : ?>
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php 
        echo $this->session->userdata('fb_message'); 
        $this->session->unset_userdata('fb_message');
    ?>
</div>    
<?php endif; ?>



<?php if($this->session->flashdata('message')) : ?>
    
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo $this->session->flashdata('message'); ?>
</div>
    
<?php endif; ?>

<?php if($this->session->flashdata('error')) : ?>
    
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Erreur : </strong><?php echo $this->session->flashdata('error'); ?>
</div>
    
<?php endif; ?>

<?php $this->load->view('candidat/profile/profile-'.$rubrique); ?>
