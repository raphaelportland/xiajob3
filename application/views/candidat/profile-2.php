<?php // mes compétences ?>

<?php echo form_open('fleurjob/edit_profile/2','class="form"'); ?>

<?php
$description = array(
    'name' => 'description',
    'id'    => 'description',
    'value' => set_value('description',$userdata->description),
    'placeholder' => 'Description courte (140 mots)',
    'rows' => '4',
    'cols' => '140',
    'class' => 'span10',
);


$informatique = array(
    'name' => 'informatique',
    'id'    => 'informatique',
    'value' => set_value('informatique',$userdata->informatique),
    'placeholder' => 'Autre logiciel / compétence : précisez',
    'class' => 'input-xlarge',
    'maxlength' => 150,
    'size'  => 150,
);


?>


<p class='lead'>Description rapide</p>

<div class='well'>
    <?php echo form_textarea($description); ?>
</div>



<p class='lead'>Mes compétences</p>


<div class='well'>
    
    <table class='table'>
        <thead>
            <tr>
                <th>#</th>
                <th>Aucune</th>
                <th>Débutant</th>
                <th>Intermédiaire</th>
                <th>Confirmé</th>
                <th>Expert</th>
            </tr>
        </thead>
        
        <tbody>
            
            <?php 
            
            foreach($comp_list as $key => $competence) {
                
                echo("<tr><th>".$competence->nom."</th>");
                
                
                for ($i=1; $i < 6; $i++) {
                    
                    echo("<td>");
                    
                    //if(isset($userdata->competences[$key]) && ($userdata->competence[$key]->score == $i)) { $checked = true; } else { $checked = false; }
                    
                    echo form_radio($competence->id, $i, test_comp($userdata,$key,$i)); 
                    echo("</td>");
                    
                } 
                echo("</tr>");   
            }                       
            ?>            
        </tbody>                        
    </table>
</div>

<p class="lead">Divers</p>

<div id='styles' class='well'>
    <div class='row-fluid'> 
              
        <div class='span12'><strong>Styles pratiqués</strong> (plusieurs choix possibles)</div>
        
        <label class="checkbox inline span3">                       
          <?php echo form_checkbox('libreservice', 1, test_option($userdata, 'libreservice')); ?> Libre service
        </label>
        
        <label class="checkbox inline span3">
          <?php echo form_checkbox('even', 1, test_option($userdata, 'even')); ?> Evénementiel
        </label>
        
        <label class="checkbox inline span3">            
          <?php echo form_checkbox('design', 1, test_option($userdata, 'design')); ?> Designer Floral
        </label>
        
        <label class="checkbox inline span2">            
          <?php echo form_checkbox('tradi', 1, test_option($userdata, 'tradi')); ?> Traditionnel
        </label>
            
    </div>
</div>

<div id='permis' class='well'>
    <div class='row-fluid'> 
              
        <div class='span12'><strong>Permis de conduire</strong></div>
        
        <label class="checkbox inline span3">
          <?php echo form_checkbox('pieton', 1, test_option($userdata, 'pieton')); ?> Pas de permis
        </label>
        
        <label class="checkbox inline span3">
          <?php echo form_checkbox('permisb', 1, test_option($userdata, 'permisb')); ?> Permis B
        </label>
        
        <label class="checkbox inline span3">
          <?php echo form_checkbox('permisc', 1, test_option($userdata, 'permisc')); ?> Permis C
        </label>
            
    </div>
</div>

<div id='informatique' class='well'>
    <div class='row-fluid'> 
              
        <div class='span12'><strong>Informatique</strong></div>
        
        <label class="checkbox inline span3">
          <?php echo form_checkbox('word', 1, test_option($userdata, 'word')); ?> Word
        </label>
        
        <label class="checkbox inline span3">
          <?php echo form_checkbox('excel', 1, test_option($userdata, 'excel')); ?> Excel
        </label>
        
        <div class='span4'>
            Autre : 
            <?php echo form_input($informatique); ?>
        </div>
            
    </div>
</div>



<?php echo form_submit("submit","Mettre à jour mes informations", "class='btn btn-primary btn-large pull-right'");?>
<?php echo form_close(); ?>


