<h1>Identifiez des fleurs</h1>

<img src="<?= base_url().$pic->th_url; ?>" class='img img-polaroid' />

<br /><br />

<?php echo form_open('book/add_flowers/'.$pic_id, 'class="form-inline" autocomplete="off"'); ?>

<input placeholder="Tapez le nom d'une fleur" class='input-xlarge' name="flower" type="text" data-provide="typeahead" data-source="[<?= $fleurs; ?>]">

<?php echo form_submit('submit', 'Ajouter', 'class="btn"'); ?>

<?php echo form_close(); ?> 
 
<?php 

$flower_data['added_flowers'] = $pic->flowers;
$this->load->view('books/added_flowers',$flower_data); ?>

<br /><br />
<?php echo anchor('book/edit/'.$pic->book_id,'<i class="icon icon-chevron-left"></i> Retour à la modification du florBook','class="btn"'); ?>
