<div class='well'>
<p class='lead'>Recherche de photos par fleur</p>
    
<?php echo form_open('pic_search/add_flowers', 'class="form-inline"'); ?>

<input placeholder="Tapez le nom d'une fleur" class='input-xlarge' name="flower" type="text" data-provide="typeahead" data-source="[<?= $fleurs; ?>]">

<?php echo form_submit('submit', 'Ajouter', 'class="btn"'); ?>

<?php echo form_close(); ?>
 
<?php 

if($this->session->userdata('search_elements')) :
    
    $search_elements = unserialize($this->session->userdata('search_elements'));
    
    
    // recherche de fleurs ?>
    
    <div class='flower_search'>
        <p>Chercher : 
    
    <?php foreach ($search_elements['flowers'] as $key => $flower) : ?>
        
        <span class="label label-inverse"><?= $flower; ?>
            <?php echo anchor('pic_search/remove_flower/'.rawurlencode($flower),"<i class='icon icon-white icon-remove'></i>"); ?>
        </span>&nbsp;       
        
    <?php endforeach; ?>
        </p>
    </div>
<?php endif; ?> 


<?php echo anchor('pic_search/search', 'Lancer la recherche', 'class="btn btn-primary"'); ?>&nbsp;
<?php echo anchor('pic_search/reset_search', '<i class="icon icon-white icon-ban-circle"></i> effacer les critères', 'class="btn btn-danger"'); ?>

</div>
