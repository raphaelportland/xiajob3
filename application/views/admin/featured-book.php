<p class='lead'>Ajouter un florBooks à la une</p>
    
<?php 
$new_book_id = array(
    'name'  => 'new_book_id',
    'id'    => 'new_book_id',
    'value' => set_value('new_book_id'),
    'maxlength' => 5,
    'size'  => 5,
);

echo form_open('admin/add_featured_book', 'class="form-inline"');

echo form_input($new_book_id);
echo form_submit('submit','Ajouter', "class='btn'");

echo form_close(); 

?>


<p class='lead'>florBooks actuellement à la une</p>

<table class='table table-bordered'>
    <tr><th>Miniature</th><th>Infos</th><th></th></tr>
    
    <?php foreach ($featured as $key => $book) : ?>
        
        <?php if($book == '') : ?>
            
            <tr><td colspan='2'>
                <div class='alert'><strong>Book id : <?= $key; ?></strong><br />
                Ce book n'existe plus.</div></td>
                <td><?= anchor('admin/delete_featured_book/'.$key, '<i class="icon icon-white icon-trash"></i>', 'class="btn btn-danger"'); ?></td>
            </tr>
            
        <?php else : ?>
        
        <tr>
            <td><a href='<?= site_url('book/show/'.$key); ?>'><img src='<?= base_url().$book->cover->th_url; ?>' class='img-polaroid' /></a></td>
            <td>Book id : <?= $key; ?><br />
            <strong><?= $book->name; ?></strong><br />
            <?= $book->description; ?><br /><br />
            user id : <?= $book->owner->id; ?><br />
            <?= anchor('profile/view/'.$book->owner->id, $book->owner->username.' - '.$book->owner->full_name); ?></td>
            <td><?= anchor('admin/delete_featured_book/'.$key, '<i class="icon icon-white icon-trash"></i>', 'class="btn btn-danger"'); ?></td>
        </tr>
        
        <?php endif; ?>
        
    <?php endforeach; ?>
    
    
</table>
    
