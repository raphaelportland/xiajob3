<?php

if(isset($book->name)) {
    $original_book_name = $book->name;    
} else {
    $original_book_name = '';
}



$book_name = array(
    'name' => 'value',
    'id'    => 'book_name',
    'value' => set_value('book_name',$original_book_name),
    'placeholder' => 'Mon Book',
    'class' => 'input-xlarge autosubmit',
    'maxlength' => 150,
    'size'  => 150,
    'data-url' => 'book/edit_book_name',
    
    
);

$attributes = array('id' => 'ajax_form', 'class' => 'form form-inline');


echo form_open('book/edit_book_name/'.$book->id);

echo form_hidden('table','user_book');
echo form_hidden('field','name');
echo form_hidden('id',$book->id);
echo form_hidden('submit','submit');
?>
<div class="input-append">
<?php echo form_input($book_name); ?>
<button type='submit' class='btn btn-success'>
    <i class='icon icon-white icon-ok'></i>
</button>       
</div>

<?php echo form_close(); ?>