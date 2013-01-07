<?php 
$script_info['app_id'] = $app_id;

$this->load->view('common/social-share/social-share-scripts',$script_info); ?>

<h1>Mes florBooks</h1>
<br />


<?php $this->load->view('books/modal-share'); ?>


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
    
    //code($book);
       
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
    <?php //echo anchor("book/add_pics/$book->id","<i class='icon-camera'></i> Ajouter des photos",'class="btn"'); ?>
    <?php echo anchor("book/edit/$book->id","<i class='icon-edit'></i> Modifier",'class="btn "'); ?>
    <?php echo anchor("book/show/$book->id","<i class='icon-eye-open'></i> Voir",'class="btn "'); ?>
    <?php //echo anchor("social/share/book/$book->id","<i class='icon icon-share-alt'></i> Partager",'data-book_id="'.$book->id.'" class="btn private-link"'); ?>    
    <?php echo anchor("book/del_book/$book->id","<i class='icon-trash icon-white'></i>",'class="btn btn-danger confirm"'); ?>   
    </div>
    </td></tr>

            <div id='share-modal-<?= $book->id; ?>' class="modal hide fade">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Partager mon florBook</h3>
              </div>
              <div class="modal-body">
                
                <?php /*
                $social_share_data['picture_url'] = $book->short_url;
                $social_share_data['short_url'] = $book->short_url;
                $social_share_data['picture_description'] = $book->description;
                $social_share_data['site_url'] = base_url().'index.php/book/view/'.$book->id;
                $social_share_data['show_pinterest'] = false;
                */ ?>
                
                <?php //$this->load->view('common/social-share/social-share.php',$social_share_data); ?>
                
                
                
                <?php
                
                $social_data = array(
                    'book_id' => $book->id,
                    'app_id' => $app_id,
                    'cover_url' => $book->cover->pic_url,
                    'title' => $book->name,
                    'short_url' => $book->short_url,
                    'description' => $book->description,
                );
                
                //code($social_data);
                
                $this->load->view('social/share_book_buttons', $social_data); ?>
                
              </div>
            </div>     
    
    
    
<?php } ?>       
        
    </tbody>
</table>

<?php echo anchor("book/create_book","<i class='icon-plus icon-white'></i> Ajouter un florBook",'class="btn btn-success"'); ?>

<br /><br />

<p class='lead'>Aperçu de mes florBooks (<?= count($books); ?>)</p>
<?php foreach ($books as $key => $book) {
    $this->load->view('books/templates/book_thumb',$book);
}?>


