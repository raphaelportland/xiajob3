<h2>Modifier votre Book</h2>

<?php

$book_name = array(
    'name' => 'book_name',
    'id'    => 'book_name',
    'value' => set_value('book_name',$book->book),
    'placeholder' => 'Mon Book',
    'class' => 'input-xlarge',
    'maxlength' => 150,
    'size'  => 150,
);

$description = array(
    'name' => 'description',
    'id'    => 'description',
    'value' => set_value('description',$book->description),
    'placeholder' => 'La description de votre book',
    'rows' => '4',
    'cols' => '140',
);
?>

<p class='lead'>Informations sur le book</p>


<?php echo form_open('fleurjob/edit_book/'.$book->id, 'class="form-horizontal"'); ?>

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

<?php echo form_hidden('order',$book->order); ?>
<?php echo form_hidden('id',$book->id); ?>

<?php echo anchor('fleurjob/edit_profile/3', "Annuler", 'class="btn"'); ?>

<?php echo form_submit('submit', 'Enregistrer', 'class="btn btn-primary"'); ?>

<br />
<br />

<?php if(isset($book->pics)): ?>

<p class='lead'>Images du book</p>
<table class='table table-hover'> 
    <thead>
        <tr>
            <th>Photo</th>
            <th>Titre</th>
            <th>Description</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        

<?php foreach ($book->pics as $key => $pic) : ?>  
    <tr>
        <td><img class='img-polaroid' src="<?= base_url().$pic->th_url ?>" /></td> 
        <td><?php echo form_input('pic_name'.$key, $pic->pic_name, 'class="input input-xlarge"'); ?></td> 
        
        <?php $pic_desc = array(
        'name' => 'pic_desc'.$key,
        'rows' => '2'
        );?>
        
        <td><?php echo form_textarea($pic_desc, $pic->pic_comment,'rows="2" class="input"'); ?></td>
        
        <?php echo form_hidden('pic_id'.$key,$pic->id); ?>
        
        
        <td><?php echo anchor('fleurjob/del_picture/'.$pic->id,'<i class="icon icon-white icon-trash"></i> Supprimer','class="btn btn-danger delete-pic"');?></td>       
    </tr>   


<?php endforeach; ?> 
    </tbody>  
</table>

<?php echo anchor('fleurjob/edit_profile/3', "Annuler", 'class="btn"'); ?>

<?php echo form_submit('submit', 'Enregistrer', 'class="btn btn-primary"'); ?>

<?php endif; ?>
<?php echo form_close(); ?>