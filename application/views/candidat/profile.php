<h2>Mon profil</h2>

<?php $this->load->view('candidat/elmt/profile_submenu'); ?>

<?php if($this->session->flashdata('message')) : ?>
    
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <?php echo $this->session->flashdata('message'); ?>
</div>
    
<?php endif; ?>


<?php $this->load->view('candidat/profile-'.$rubrique); ?>
