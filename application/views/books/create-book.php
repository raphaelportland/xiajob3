<h1>Créer un nouveau florBook</h1>
<br />
<?php

$book_name = array(
    'name' => 'book_name',
    'id'    => 'book_name',
    'value' => set_value('book_name'),
    'placeholder' => 'Mon florBook',
    'class' => 'input-xlarge',
    'maxlength' => 150,
    'size'  => 150,
);

$description = array(
    'name' => 'description',
    'id'    => 'description',
    'value' => set_value('description'),
    'placeholder' => 'La description de votre book : une phrase suffit !',
    'rows' => '2',
    'cols' => '140',
);


?>


<?php echo form_open('book/create_book/', 'class="form-horizontal"'); ?>


<?php echo validation_errors(); ?>

<div class="control-group">
    <label class="control-label" for="type1">Nom</label>
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


<div class="control-group">
    <div class='controls'>
<?php echo form_submit('submit', 'Valider', 'class="btn btn-pink"'); ?>        
    </div>
</div>


<?php echo form_close(); ?>
