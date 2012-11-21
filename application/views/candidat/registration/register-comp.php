<div id='registration_form' class='box'>
    
<h2>Mes compétences</h2>


<?php echo form_open('register/candidat','class="form"'); ?>

<?php 

$informatique = array(
    'name' => 'informatique',
    'id'    => 'informatique',
    'value' => set_value('informatique'),
    'placeholder' => 'Autre logiciel / compétence : précisez',
    'class' => 'span4',
    'maxlength' => 150,
    'size'  => 150,
);

$description = array(
    'name' => 'description',
    'id'    => 'description',
    'value' => set_value('description'),
    'placeholder' => 'Description courte (140 mots)',
    'rows' => '4',
    'cols' => '140',
    'class' => 'span10',
);




?>

<p class='lead'>Description rapide</p>

<div class='well'>
    <?php echo form_textarea($description); ?>
</div>


<p class='lead'>Compétences</p>

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
            
            foreach($competences as $key => $competence) {
                
                echo("<tr><th>".$competence->nom."</th>");
                
                
                for ($i=1; $i < 6; $i++) {
                    
                    echo("<td>");
                    echo form_radio($competence->id, $i); 
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
    <div class='row'> 
              
        <div class='span12'><strong>Styles pratiqués</strong> (plusieurs choix possibles)</div>
        
        <label class="checkbox inline span2">
          <?php echo form_checkbox('libreservice', 1); ?> Libre service
        </label>
        
        <label class="checkbox inline span2">
          <?php echo form_checkbox('even', 1); ?> Evénementiel
        </label>
        
        <label class="checkbox inline span2">
          <?php echo form_checkbox('design', 1); ?> Designer Floral
        </label>
        
        <label class="checkbox inline span2">
          <?php echo form_checkbox('tradi', 1); ?> Traditionnel
        </label>
            
    </div>
</div>

<div id='permis' class='well'>
    <div class='row'> 
              
        <div class='span12'><strong>Permis de conduire</strong></div>
        
        <label class="checkbox inline span3">
          <?php echo form_checkbox('pieton', 1); ?> Pas de permis
        </label>
        
        <label class="checkbox inline span3">
          <?php echo form_checkbox('permisb', 1); ?> Permis B
        </label>
        
        <label class="checkbox inline span3">
          <?php echo form_checkbox('permisc', 1); ?> Permis C
        </label>
            
    </div>
</div>

<div id='informatique' class='well'>
    <div class='row'> 
              
        <div class='span12'><strong>Informatique</strong></div>
        
        <label class="checkbox inline span2">
          <?php echo form_checkbox('word', 1); ?> Word
        </label>
        
        <label class="checkbox inline span2">
          <?php echo form_checkbox('excel', 1); ?> Excel
        </label>
        
        <div class='span4'>
            <?php echo form_input($informatique); ?>
        </div>
            
    </div>
</div>



</br>


<?php echo anchor('register/ignore_register',"ignorer et passer à l'étape suivante",'class="btn btn-warning btn-large"'); ?>

<?php echo form_submit("register","valider et passer à l'étape suivante", "class='btn btn-primary btn-large pull-right'");?>

<?php echo form_close(); ?>
</div>


</div>