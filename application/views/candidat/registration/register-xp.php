<div id='registration_form' class='box'>
    
<h2>Mon expérience</h2>


<?php echo form_open('register/candidat','class="form"'); ?>

<?php 
$autre_recomp = array(
    'name'  => 'autre_recomp1',
    'id'    => 'autre_recomp1',
    'value' => set_value('autre_recomp1'),
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

$year_diplome1 = array(
    'name'  => 'year_diplome1',
    'id'    => 'year_diplome1',
    'value' => set_value('year_diplome1'),
    'placeholder' => 'Année',
    'maxlength' => 4,
    'size'  => 4,
); 
  
$custom_formation1 = array(
    'name'  => 'custom_formation1',
    'id'    => 'custom_formation1',
    'value' => set_value('custom_formation1'),
    'placeholder' => 'Autre formation : précisez',
    'maxlength' => 150,
    'size'  => 150,
);   
  
        
$custom_diplome1 = array(
    'name'  => 'custom_diplome1',
    'id'    => 'custom_diplome1',
    'value' => set_value('custom_diplome1'),
    'placeholder' => 'Autre diplôme : précisez',
    'maxlength' => 30,
    'size'  => 30,
);  

$custom_lieu1 = array(
    'name'  => 'custom_lieu1',
    'id'    => 'custom_lieu1',
    'value' => set_value('custom_lieu1'),
    'maxlength' => 30,
    'size'  => 30,
);  



$year_start1 = array(
    'name'  => 'year_start1',
    'id'    => 'year_start1',
    'value' => set_value('year_start1'),
    'placeholder' => 'Année',
    'maxlength' => 4,
    'size'  => 4,
);    

$year_end1 = array(
    'name'  => 'year_end1',
    'id'    => 'year_end1',
    'value' => set_value('year_end1'),
    'placeholder' => 'Année',
    'maxlength' => 4,
    'size'  => 4,
); 

?>


<p class="lead">Prix et récompenses</p>

<div id='recompenses'>
  
    <div id='recompense1' class='clonedRecomp well'>
        <div class='row'>
        
            <div class='span4'><strong>Récompense</strong></div>    
            <div class='span3'><strong>Précision</strong></div>
            <div class='span3'><strong>Année</strong></div>
            
            <div class='span4'>   
            <?php echo form_dropdown('recomp1', $recomp_list,'','class="span4"'); ?>    
            </div>
    
            <div class="span3">
            <?php echo form_input($autre_recomp);?> 
            </div>        
            
            <div class='span3'>
            <?php echo form_input($year_recomp); ?>              
            </div>   
               
        </div>
    </div>
</div>
<a id='add_recomp' class='btn btn-mini'><i class='icon-plus'></i> Ajouter un prix</a>
<a id='btnDelRecomp' class='btn btn-mini btn-danger'><i class='icon-minus icon-white'></i> Supprimer le dernier prix</a>
</br>
</br>
</br>

<p class="lead">Formations et diplômes</p>

<div id='formations' class=''>

       
    <div id='formation1' class='clonedFormation well'>
        <div class='row'>
        
        <div class='span3'><strong>Année</strong></div>    
        <div class='span4'><strong>Ecole</strong></div>
        <div class='span3'><strong>Diplôme</strong></div>
           
        <div class='span3'>
        <?php echo form_input($year_diplome1); ?>           
        </div>   
           
        <div class='span4'>   
        <?php echo form_dropdown('formation1', $formation_list,'','class="span4"'); ?>    
        </div>
        
        <div class='span3'>
        <?php echo form_dropdown('diplome1', $diplome_list); ?>    
        </div>        
        
        <div class='span4 offset3'>La formation n'est pas dans la liste</div>
        <div class='span3'>Autre diplôme</div>
                
        <div class='span4 offset3'>   
        <?php echo form_input($custom_formation1); ?>
        </div>
 
        <div class='span3'>   
        <?php echo form_input($custom_diplome1); ?>
        </div>       
    
    </div>

</div>
<a id='add_formation' class='btn btn-mini'><i class='icon-plus'></i> Ajouter une formation</a>
<a id='btnDelFormation' class='btn btn-mini btn-danger'><i class='icon-minus icon-white'></i> Supprimer la dernière formation</a>
</br>
</br>
</br>

<p class='lead'>Expériences pro</p>

<div id='experiencespro' class=''>

    <div id='experience1' class='clonedXp well'>
        <div class='row'>

        <div class='span4'><strong>Nom de l'entreprise / ville</strong></div>
        <div class='span3'><strong>Poste</strong></div>
        <div class='span3'><strong>Type d'établissement</strong></div>
             
        <div class='span4'>   
        <?php echo form_input($custom_lieu1,'', 'class="span4"'); ?>
        </div> 
        
        <div class='span3'>   
        <?php echo form_dropdown('poste1', $postes_list); ?>    
        </div>         
        
        <div class='span3'>   
        <?php echo form_dropdown('type1', $type_etab_list); ?>    
        </div>
        
        <div class='span12'>
            <div class='span5'>
            de : <?php echo form_dropdown('month_start1', $months,'','class="span2"'); ?>
            <?php echo form_input($year_start1,'', 'class="span2"'); ?>
            </div>
            <div class='span5'>
            à :  <?php echo form_dropdown('month_end1', $months,'','class="span2"'); ?>
            <?php echo form_input($year_end1,'', 'class="span2"'); ?>
            </div>
        </div>
                             
        </div>
    </div>    
   
</div>
<a id='add_expe' class='btn btn-mini'><i class='icon-plus'></i> Ajouter une expérience</a>
<a id='btnDelXp' class='btn btn-mini btn-danger'><i class='icon-minus icon-white'></i> Supprimer la dernière expérience</a>
</br>
</br>
</br>


<?php echo anchor('register/ignore_register',"ignorer et passer à l'étape suivante",'class="btn btn-warning btn-large"'); ?>

<?php echo form_submit("register","valider et passer à l'étape suivante", "class='btn btn-primary btn-large pull-right'");?>

<?php echo form_close(); ?>
</div>


</div>