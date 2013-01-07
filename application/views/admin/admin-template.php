<?php 

$this->load->view('common/head'); 
$this->load->view('candidat/elmt/private-head-nav');   

?>
<div class="container">  
    
<h1>Administration</h1>

<!-- Titre de la rubrique -->
<p class='lead'><?= $rubrique; ?></p>

<div class='row'>
    <div class='span3'>
        <ul class="nav nav-tabs nav-stacked">
            
            <!-- Menu d'administration -->
            <li><?= anchor('','<i class="icon icon-lock"></i> Ajouter un administrateur'); ?></li>
            <li><?= anchor('','<i class="icon icon-user"></i> Aperçu des utilisateurs'); ?></li>
            <li><?= anchor('','<i class="icon icon-book"></i> Aperçu des florBooks'); ?></li>
            <li><?= anchor('admin/featured_book','<i class="icon icon-bookmark"></i> Mettre un book à la une'); ?></li>
        </ul>    
    </div>  
    
    <div class='span9'>
        
        <!-- Contenu de la page -->
        <?php $this->load->view($view); ?>
        
    </div>  
</div>


</div>

<?php $this->load->view('common/footer'); ?>