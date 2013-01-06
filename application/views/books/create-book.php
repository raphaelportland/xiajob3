<h1>Créer un nouveau florBook</h1>

<?php

$book_name = array(
    'name' => 'book_name',
    'id'    => 'book_name',
    'value' => set_value('book_name'),
    'placeholder' => 'Mon Book',
    'class' => 'input-xlarge',
    'maxlength' => 150,
    'size'  => 150,
);

$description = array(
    'name' => 'description',
    'id'    => 'description',
    'value' => set_value('description'),
    'placeholder' => 'La description de votre book',
    'rows' => '4',
    'cols' => '140',
);


?>


<?php echo form_open('book/create_book/', 'class="form-horizontal"'); ?>

<div class="control-group">
    <label class="control-label" for="type1">Nom du Book</label>
    <div class='controls'>
        <?php echo form_input($book_name); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="type1">Description</label>
    <div class='controls'>
        <?php echo form_textarea($description); ?>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="type1">Occasion</label>
    <div class='controls'>
        <?php echo form_dropdown('occasion', $occasions_list,'','class="input-xlarge"'); ?>
    </div>
</div>

<?php echo form_hidden('user_id', $user_id); ?>

<?php echo form_submit('submit', 'Créer ce book', 'class="btn btn-large btn-primary"'); ?>

<?php echo form_close(); ?>
