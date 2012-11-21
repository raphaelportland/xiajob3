
<?php 
$autre_recomp = array(
    'name'  => 'autre_recomp1',
    'id'    => 'autre_recomp1',
    'value' => set_value('autre_recomp1',$data->autre_recomp),
    'placeholder' => 'Précisez',
    'maxlength' => 30,
    'size'  => 30,
);
        
$year_recomp = array(
    'name'  => 'year_recomp1',
    'id'    => 'year_recomp1',
    'value' => set_value('year_recomp1',$data->year_recomp),
    'placeholder' => 'Année',
    'maxlength' => 4,
    'size'  => 4,     
);
?>
<?php echo form_open('fleurjob/edit/recomp/'.$data->id,'class="form-horizontal"'); ?> 
  <div class="modal-body">      
     
    
  <div class="control-group">     
    <label class="control-label" for="recomp1">Récompense</label>
    <div class="controls">
       <?php echo form_dropdown('recomp1', $recomp_list,$data->recompense,'class="input-xlarge"'); ?>  
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
    <a href="#" data-toggle="modal" data-target="#modaledit" class="btn">Annuler</a>  
<?php echo form_submit('submit','Enregistrer','class="btn btn-primary"'); ?>
<?php echo form_close(); ?>     