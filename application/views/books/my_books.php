<?php $this->load->view('common/social-share/social-share-scripts'); ?>


<p class='lead'>
   <i class="icon icon-book"></i> Mes Books
</p>

<?php $this->load->view('books/modal-share'); ?>


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
    
    if(isset($book->pic_nb)) {
        $nb = $book->pic_nb;    
    } else {
        $nb = 0;
    }
       
    echo("<tr>
    <th><div id='book_name_$key'>");
    if(!$book->name) $book->name = 'cliquez ici pour ajouter un nom';
    if(!$book->description) $book->description = 'cliquez ici pour ajouter une description';
    echo anchor('book/edit_book_name/'.$book->id,$book->name,'class="autosubmit-input-link" data-div_id="book_name_'.$key.'"');
    
    echo("</div></th><td><div id='book_desc_$key'>");
    
    echo anchor('book/edit_book_desc/'.$book->id,$book->description,'class="autosubmit-input-link" data-div_id="book_desc_'.$key.'"');
    
    echo("</div></td><td>$nb</td><td>"); ?>
    
    <div class="btn-group">
    <?php echo anchor("upload/index/$book->id","<i class='icon-camera'></i> Ajouter",'class="btn"'); ?>
    <?php echo anchor("book/edit/$book->id","<i class='icon-pencil'></i> Modifier",'class="btn "'); ?>
    <?php echo anchor("book/view/$book->id","<i class='icon-eye-open'></i> Voir",'target="_blank" class="btn "'); ?>
    <?php echo anchor("book/del_book/$book->id","<i class='icon-trash icon-white'></i> Supprimer",'class="btn btn-danger confirm"'); ?>   
    </div>
    </td><td>
    <?php echo anchor("book/share/$book->id","<i class='icon icon-share-alt'></i> Partager",'data-book_id="'.$book->id.'" class="btn private-link"'); ?>
        
    <?php echo("</td></tr>"); ?>
    

            <div id='share-modal-<?= $book->id; ?>' class="modal hide fade">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Partager mon book</h3>
              </div>
              <div class="modal-body">
                <!-- <p>Photo id : <?= $picture->id; ?></p> -->
                
                <?php
                $social_share_data['picture_url'] = $book->short_url; 
                $social_share_data['picture_description'] = $book->description;
                $social_share_data['site_url'] = base_url().'index.php/book/view/'.$book->id;
                $social_share_data['show_pinterest'] = false;
                ?>
                
                <?php $this->load->view('common/social-share/social-share.php',$social_share_data); ?>
                
              </div>
             <!--<div class="modal-footer">
              </div>-->
            </div>     
    
    
    
<?php } ?>       
        
    </tbody>
</table>

<?php echo anchor("book/create_book","Ajouter un book",'class="btn"'); ?>



