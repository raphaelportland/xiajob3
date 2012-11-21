<h2>Modifier votre Book</h2>

<?php

echo form_open();

?>

<div class="btn-group">
    <?php echo anchor('book/my_books', "Retourner à mes books", 'class="btn"'); ?>
    <?php echo anchor("upload/index/$book->id","<i class='icon-camera'></i> Ajouter",'class="btn"'); ?>
    <?php echo form_submit('submit', "Enregistrer", 'class="btn btn-primary"'); ?>
</div>
<br />
<br />

<?php if(isset($book->pictures->pics)): ?>

<p class='lead'>Images du book</p>
<table class='table table-hover'> 
    <thead>
        <tr>
            <th>Photo</th>
            <th>Titre et description</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
<?php //code($book->pictures); ?>        

<?php foreach ($book->pictures->pics as $key => $pic) : ?> 
    
   
    
<?php 
$pic_desc = array(
    'name' => 'pic_desc'.$key,
    'rows' => '3'
); 

?>
     
    <tr>
        <td><img class='img-polaroid' src="<?= base_url().$pic->th_url ?>" /></td> 
        <td>
            <div class='control-group'>
                <div class='control'>
                    <?php echo form_input('pic_name'.$key, $pic->pic_name, 'class="input input-xlarge"'); ?>     
                </div>  
                <div class='control'>
                    <?php echo form_textarea($pic_desc, $pic->pic_comment,'rows="2" class="input input-xlarge"'); ?>
                </div>                  
            </div>
            
            
            
            <?php 
            $flower_data['added_flowers'] = $pic->flower_data;
            $flower_data['pic_id'] = $pic->id;
            $flower_data['forbidden_edit'] = true;
            
            $this->load->view('books/added_flowers',$flower_data); ?>
            
            
        </td> 
        
        <?php echo form_hidden('pic_id'.$key,$pic->id); ?>       
        
        <td>
            <div class="btn-group">
                <?php echo anchor('book/add_flowers/'.$pic->id,'Identifier / Modifier les fleurs','class="btn"'); ?>
                <?php echo anchor('book/del_picture/'.$pic->id,'<i class="icon icon-white icon-trash"></i> Supprimer','class="btn btn-danger delete-pic"');?>
            </div>
        </td>       
    </tr>   


<?php endforeach; ?> 
    </tbody>  
</table>

<?php echo anchor('book/my_books', "Retourner à mes books", 'class="btn"'); ?>

<?php echo form_submit('submit', 'Enregistrer', 'class="btn btn-primary"'); ?>

<?php endif; ?>
<?php echo form_close(); ?>