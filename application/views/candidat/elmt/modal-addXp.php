<!-- Fenêtres modales pour l'ajout de nouvelles données -->
<?php
if($this->session->userdata('failed_xp_input')) :
    $xp_input = $this->session->userdata('failed_xp_input');
    $this->session->unset_userdata('failed_xp_input');
endif;


if(isset($xp_input['custom_lieu1'])) :
    $default_custom_lieu1 = $xp_input['custom_lieu1'];
else:
    $default_custom_lieu1 = '';
endif;


if(isset($xp_input['year_start1'])) :
    $default_year_start1 = $xp_input['year_start1'];
else:
    $default_year_start1 = '';
endif;


if(isset($xp_input['year_end1'])) :
    $default_year_end1 = $xp_input['year_end1'];
else:
    $default_year_end1 = '';
endif;




if(isset($xp_input['poste1'])) :
    $default_poste1 = $xp_input['poste1'];
else :
    $default_poste1 = false;
endif;



if(isset($xp_input['type1'])) :
    $default_type1 = $xp_input['type1'];
else :
    $default_type1 = false;
endif;

if(isset($xp_input['month_start1'])) :
    $default_month_start1 = $xp_input['month_start1'];
else :
    $default_month_start1 = false;
endif;

if(isset($xp_input['month_end1'])) :
    $default_month_end1 = $xp_input['month_end1'];
else :
    $default_month_end1 = false;
endif;

?>
<div id="addXp" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Ajouter une expérience pro</h3>
  </div>
  <div class="modal-body">

<?php 
$custom_lieu1 = array(
    'name'  => 'custom_lieu1',
    'id'    => 'custom_lieu1',
    'value' => set_value('custom_lieu1',$default_custom_lieu1),
    'maxlength' => 30,
    'size'  => 30,
);  

$year_start1 = array(
    'name'  => 'year_start1',
    'id'    => 'year_start1',
    'value' => set_value('year_start1',$default_year_start1),
    'placeholder' => 'Année',
    'maxlength' => 4,
    'size'  => 4,
);    

$year_end1 = array(
    'name'  => 'year_end1',
    'id'    => 'year_end1',
    'value' => set_value('year_end1',$default_year_end1),
    'placeholder' => 'Année',
    'maxlength' => 4,
    'size'  => 4,
); 

?>
      
<?php echo form_open('main/add_xp','class="form-horizontal"'); ?>      

      
  <div class="control-group">     
    <label class="control-label" for="custom_lieu1">Entreprise</label>
    <div class="controls">
      <?php echo form_input($custom_lieu1,'', 'class="input-xlarge"'); ?>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="poste1">Type de poste</label>
    <div class="controls">
       <?php echo form_dropdown('poste1', $postes_list,$default_poste1,'class="input-xlarge"'); ?>
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="type1">Type d'établissement</label>
    <div class="controls">
      <?php echo form_dropdown('type1', $type_etab_list,$default_type1,'class="input-xlarge"'); ?>
    </div>
  </div>        
    
    <div class="control-group">
        <label class="control-label" for="type1">Période de :</label>
            <div class='controls'>
                <?php echo form_dropdown('month_start1', $months,$default_month_start1,'class="input-small"'); ?>
                <?php echo form_input($year_start1,'', 'class="input-small"'); ?>
            </div>
        <label class="control-label" for="type1">à :</label>
            <div class='controls'>
                <?php echo form_dropdown('month_end1', $months,$default_month_end1,'class="input-small"'); ?>
                <?php echo form_input($year_end1,'', 'class="input-small"'); ?>
            </div>
    </div>
  
  </div>

  <div class="modal-footer"> 
    <a href="#" data-toggle="modal" data-target="#addXp" class="btn">Annuler</a>
<?php echo form_submit('submit','Enregistrer','class="btn btn-primary"'); ?>
<?php echo form_close(); ?>     
  </div>
</div>