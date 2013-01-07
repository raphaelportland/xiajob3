<h1>florBooks les plus populaires</h1>

<?php echo anchor('book','<i class="icon-chevron-left"></i> Retourner à la page Explorer','class="btn"'); ?>

<br /><br />

<?php foreach ($books as $key => $book) : ?>       
    
    <?php $this->load->view('books/templates/book_thumb',$book); ?>
    
<?php endforeach; ?> 
