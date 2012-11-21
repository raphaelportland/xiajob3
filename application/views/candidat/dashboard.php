<h2>Votre tableau de bord</h2>

<div class='row-fluid'>
<?php echo anchor('book','Explorer les books','class="btn btn-large"'); ?>

<?php echo anchor('profile/view/'.$this->session->userdata('user_id'),'Voir mon profil public','class="btn btn-large"'); ?>

<?php echo anchor('social/favorites', 'Voir mes Books favoris','class="btn btn-large"'); ?> 
 
<br /><br />
</div>

<div class='row-fluid'>  
<?php
if($user->options->profile_step != 'finished') {
    
    $this->load->view('candidat/elmt/please_finish_your_profile');
    
}
?>
 

<ul class="thumbnails">
    
<?php $this->load->view('candidat/elmt/welcome_frame'); ?> 

<?php $this->load->view('candidat/elmt/voir_profil'); ?>

<?php $this->load->view('candidat/elmt/voir_books'); ?>

<?php $this->load->view('candidat/elmt/trouver_annonce'); ?>

</ul>


</div>