<h1>" <?= $book->name; ?> "</h1>
<p class='lead'>Ajoutez des images à votre florBook 
    
<?php
    switch($book->pic_nb) {
        case '0' :
            echo '(aucune photo)';
            break;
            
        case '1' :
            echo '(1 photo)';
            break;
            
        default : 
            echo "($book->pic_nb photos)";
            break;
    } ?></p>

        <?php $this->load->view('books/upload/upload_view'); ?>   
        
                 
<?php echo anchor("book/edit/".$book->id, "Modifier votre book", 'class="btn btn-pink"'); ?>

<input id="maxPics" type="hidden" name="maxpic" value="<?php echo 10-$book->pic_nb; ?>"/>

<br />
<br />



<!-- Aperçu des photos contenues dans le book -->
<?php 
$data_to_send['book'] = $book;
$this->load->view('books/upload/photos_du_book', $data_to_send); 
?>