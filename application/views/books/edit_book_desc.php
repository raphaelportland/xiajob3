<?php

if(isset($book->description)) {
    $original_book_description = $book->description;    
} else {
    $original_book_description = '';
}


$description = array(
    'name' => 'value',
    'id'    => 'description',
    'value' => set_value('description',$original_book_description),
    'placeholder' => 'La description de votre book',
    'rows' => '4',
    'cols' => '140',
    'data-url' => 'book/edit_book_desc',
);

$attributes = array('id' => 'ajax_form');

echo form_open('book/edit_book_desc/'.$book->id);

echo form_hidden('table','user_book');
echo form_hidden('field','description');
echo form_hidden('id',$book->id);
echo form_hidden('submit','submit');
?>
<div class='control-group'>
    <div class='control'>
        <?php echo form_textarea($description); ?> 
    </div>
    <div class='control'>
        <button type='submit' class='btn btn-success'>
            <i class='icon icon-white icon-ok'></i> Valider
        </button>      
    </div>
</div>

<?php echo form_close(); ?>