
 
<div class='row-fluid'> 
        <h2>Les books les plus populaires</h2>
 
        <?php foreach ($books as $key => $book) : ?>       
            
            <?php $this->load->view('books/templates/book_thumb',$book); ?>
            
        <?php endforeach; ?> 

</div>

<?php echo anchor('book','Retourner à la page exploration des books','class="btn btn-large btn-primary clearfix"'); ?>
