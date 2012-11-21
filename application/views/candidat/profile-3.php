<p class='lead'>
    Mes Books
</p>


<?php $this->load->view('candidat/elmt/modal-link'); ?>


<table class='table table-hover'>
    <thead>
        <tr>
            <th colspan=2>Nom</th>
            <th>photos</th>
            <th></th>
        </tr>

    </thead>
    <tbody>   
        
        
<?php foreach ($books as $key => $book) {
    
    $nb = $book->pictures->nb;   
    echo("<tr><th>$book->book</th><td>$book->description</td><td>$nb</td><td>"); ?>
    
    <div class="btn-group">
    <?php echo anchor("upload/index/$book->id","<i class='icon-camera'></i> Ajouter des photos",'class="btn"'); ?>
    <?php echo anchor("fleurjob/edit_book/$book->id","<i class='icon-pencil'></i> Modifier le book",'class="btn "'); ?>
    <?php echo anchor("fleurjob/del_book/$book->id","<i class='icon-trash icon-white'></i> Supprimer",'class="btn btn-danger confirm"'); ?>   
    </div>
    </td><td>
    <?php echo anchor("fleurjob/get_book_private/$book->id","lien privé <i class='icon icon-lock'></i>",'class="btn private-link"'); ?>
        
    <?php echo("</td></tr>");
    
}
?>       
        
    </tbody>
</table>

<?php echo anchor("fleurjob/create_book","Ajouter un book",'class="btn"'); ?>


<script src="<?= base_url(); ?>public/js/book.js"></script>
