<h1>Mes florBooks</h1>
<br />

<table class='table table-hover'>
    <thead>
        <tr>
            <th colspan='2'>Nom</th>
            <th>Description</th>
            <th>photos</th>
            <th>favoris</th>
            <th></th>
        </tr>

    </thead>
    <tbody>   
        
        
<?php foreach ($books as $key => $book) {
       
    echo("<tr>
    <th></th>
    <th><div id='book_name_$key'>");
    if(!$book->name) $book->name = 'cliquez ici pour ajouter un nom';
    if(!$book->description) $book->description = 'cliquez ici pour ajouter une description';
    echo anchor('book/edit_book_name/'.$book->id,$book->name,'class="autosubmit-input-link" title="Cliquez pour modifier" data-div_id="book_name_'.$key.'"');
    
    echo("</div></th><td><div id='book_desc_$key'>");
    
    echo anchor('book/edit_book_desc/'.$book->id,$book->description,'class="autosubmit-input-link" title="Cliquez pour modifier" data-div_id="book_desc_'.$key.'"');
    
    echo("</div></td><td>".count($book->pictures)."</td><td>$book->fav_count</td><td>"); ?>
    

    <div class="btn-group">
        <?php echo anchor("book/edit/$book->id","<i class='icon-edit'></i> Modifier",'class="btn "'); ?>
        <?php echo anchor("book/show/$book->id","<i class='icon-eye-open'></i> Voir",'class="btn "'); ?>

     
    <?php echo anchor("book/del_book/$book->id","<i class='icon-trash icon-white'></i>",'class="btn btn-danger confirm"'); ?>   
    </div>
    </td></tr>
    
<?php } ?>       
        
    </tbody>
</table>

<?php echo anchor("book/create_book","<i class='icon-plus icon-white'></i> Ajouter un florBook",'class="btn btn-success"'); ?>

<br /><br />

<p class='lead'>Aperçu de mes florBooks (<?= count($books); ?>)</p>
<?php foreach ($books as $key => $book) {
    $this->load->view('books/templates/book_thumb',$book);
}?>


