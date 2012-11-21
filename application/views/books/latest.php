<?php
/**
 * Template publique pour la galerie des books fleuristes
 * 
 */
?>
 
<?php $this->load->view('common/head'); ?>

<?php $this->load->view('candidat/elmt/public-head-nav'); ?>        
        
<?php $this->load->view('common/florbook_subhead'); ?>
    
<div class="container-fluid">         
<?php //$this->load->view('books/search-books'); ?>
 
<div class='row-fluid'> 
        <h2>Les books les plus récents</h2>
 
        <?php foreach ($latest as $key => $book) : ?>       
            
            <?php $this->load->view('books/templates/book_thumb',$book); ?>
            
        <?php endforeach; ?> 

</div>

<?php echo anchor('book','Retourner à la page exploration des books','class="btn btn-large btn-primary clearfix"'); ?>

<?php $this->load->view('common/footer'); ?>