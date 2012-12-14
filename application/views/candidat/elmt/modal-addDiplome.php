<!-- Fenêtres modales pour l'ajout de nouvelles données -->

<div id="addDiplome" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Ajouter une formation</h3>
  </div>
  <div class="modal-body">

<?php 
$year_diplome = array(
    'name'  => 'year_diplome',
    'id'    => 'year_diplome',
    'value' => set_value('year_diplome'),
    'placeholder' => 'Année',
    'maxlength' => 4,
    'size'  => 4,
); 
  
$custom_formation = array(
    'name'  => 'custom_formation',
    'id'    => 'custom_formation',
    'value' => set_value('custom_formation'),
    'placeholder' => 'Autre formation : précisez',
    'maxlength' => 150,
    'size'  => 150,
);   
  
        
$custom_diplome = array(
    'name'  => 'custom_diplome',
    'id'    => 'custom_diplome',
    'value' => set_value('custom_diplome'),
    'placeholder' => 'Autre diplôme : précisez',
    'maxlength' => 30,
    'size'  => 30,
);  
?>
      
<?php echo form_open('main/add_diplome','class="form-horizontal"'); ?>      
      
  <div class="control-group">     
    <label class="control-label" for="recomp1">Année du diplôme</label>
    <div class="controls">
      <?php echo form_input($year_diplome,'','class="input-small"');?>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="autre_recomp1">Ecole</label>
    <div class="controls">
       <?php echo form_dropdown('formation', $formation_list,'','class="input-xlarge"'); ?>
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
       <?php echo form_dropdown('diplome', $diplome_list,'','class="input-xlarge"'); ?>
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
    <a href="#" data-toggle="modal" data-target="#addDiplome" class="btn">Annuler</a>
<?php echo form_submit('submit','Enregistrer','class="btn btn-primary"'); ?>
<?php echo form_close(); ?>     
  </div>
</div>