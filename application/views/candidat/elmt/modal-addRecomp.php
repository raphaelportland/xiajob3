<!-- Fenêtres modales pour l'ajout de nouvelles données -->

<?php
if($this->session->userdata('failed_input')) :
    $input = $this->session->userdata('failed_input');
    $this->session->unset_userdata('failed_input');
endif;


if(isset($input['autre_recomp1'])) :
    $default_autre_recomp = $input['autre_recomp1'];
else:
    $default_autre_recomp = '';
endif;

if(isset($input['recomp1'])) :
    $default_recomp_type = $input['recomp1'];
else :
    $default_recomp_type = false;
endif;


?>

<div id="addRecomp" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Ajouter une récompense</h3>
  </div>
  <div class="modal-body">

<?php 
$autre_recomp = array(
    'name'  => 'autre_recomp1',
    'id'    => 'autre_recomp1',
    'value' => set_value('autre_recomp1',$default_autre_recomp),
    'placeholder' => 'Précisez',
    'maxlength' => 30,
    'size'  => 30,
);
        
$year_recomp = array(
    'name'  => 'year_recomp1',
    'id'    => 'year_recomp1',
    'value' => set_value('year_recomp1'),
    'placeholder' => 'Année',
    'maxlength' => 4,
    'size'  => 4,     
);
?>
      
<?php echo form_open('main/add_recomp','class="form-horizontal"'); ?>      
      
  <div class="control-group">     
    <label class="control-label" for="recomp1">Récompense</label>
    <div class="controls">
       <?php echo form_dropdown('recomp1', $recomp_list, $default_recomp_type,'class="input-xlarge"'); ?>  
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="autre_recomp1">Précision</label>
    <div class="controls">
      <?php echo form_input($autre_recomp,'','class="input-xlarge"');?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="year_recomp1">Année</label>
    <div class="controls">
      <?php echo form_input($year_recomp,'','class="input-small"'); ?> 
    </div>
  </div>        
    
      
  </div>
  <div class="modal-footer"> 
    <a href="#" data-toggle="modal" data-target="#addRecomp" class="btn">Annuler</a>
<?php echo form_submit('submit','Enregistrer','class="btn btn-primary"'); ?>
<?php echo form_close(); ?>     
  </div>
</div>