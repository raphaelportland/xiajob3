
<?php 
$year_diplome = array(
    'name'  => 'year_diplome',
    'id'    => 'year_diplome',
    'value' => set_value('year_diplome',$data->annee_diplome),
    'placeholder' => 'Année',
    'maxlength' => 4,
    'size'  => 4,
); 
  
$custom_formation = array(
    'name'  => 'custom_formation',
    'id'    => 'custom_formation',
    'value' => set_value('custom_formation',$data->autre_formation),
    'placeholder' => 'Autre formation : précisez',
    'maxlength' => 150,
    'size'  => 150,
);   
  
        
$custom_diplome = array(
    'name'  => 'custom_diplome',
    'id'    => 'custom_diplome',
    'value' => set_value('custom_diplome',$data->autre_diplome),
    'placeholder' => 'Autre diplôme : précisez',
    'maxlength' => 30,
    'size'  => 30,
);  
?>
<?php echo form_open('fleurjob/edit/formations/'.$data->id,'class="form-horizontal"'); ?>    
<div class="modal-body">
      
  
      
  <div class="control-group">     
    <label class="control-label" for="recomp1">Année du diplôme</label>
    <div class="controls">
      <?php echo form_input($year_diplome,'','class="input-small"');?>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="autre_recomp1">Ecole</label>
    <div class="controls">
       <?php echo form_dropdown('formation', $formation_list,$data->formation_id,'class="input-xlarge"'); ?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="year_recomp1">La formation n'est pas dans la liste</label>
    <div class="controls">
      <?php echo form_input($custom_formation,'','class="input-xlarge"'); ?> 
    </div>
  </div>        
    
  <div class="control-group">
    <label class="control-label" for="autre_recomp1">Diplôme</label>
    <div class="controls">
       <?php echo form_dropdown('diplome', $diplome_list,$data->diplome_id,'class="input-xlarge"'); ?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="year_recomp1">Autre diplôme</label>
    <div class="controls">
      <?php echo form_input($custom_diplome,'','class="input-xlarge"'); ?> 
    </div>
  </div>  
        
  </div>   
  <div class="modal-footer"> 
    <a href="#" data-toggle="modal" data-target="#modaledit" class="btn">Annuler</a>  
<?php echo form_submit('submit','Enregistrer','class="btn btn-primary"'); ?>
<?php echo form_close(); ?> 
</div>    