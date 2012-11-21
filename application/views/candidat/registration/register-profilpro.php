<div id='registration_form' class='box'>
    
<h2>Mon profil Pro</h2>

<?php

$dob = array(
    'name'  => 'dob',
    'id'    => 'dob',
    'value' => set_value('dob'),
    'maxlength' => 10,
    'size'  => 10,
);

$nom = array(
    'name'  => 'nom',
    'id'    => 'nom',
    'value' => set_value('nom'),
    'maxlength' => 30,
    'size'  => 30,
);

$prenom = array(
    'name'  => 'prenom',
    'id'    => 'prenom',
    'value' => set_value('prenom'),
    'maxlength' => 30,
    'size'  => 30,
);

$mobile = array(
    'name'  => 'mobile',
    'id'    => 'mobile',
    'value' => set_value('mobile'),
    'maxlength' => 30,
    'size'  => 30,
);

$ad1 = array(
    'name'  => 'ad1',
    'id'    => 'ad1',
    'value' => set_value('ad1'),
    'maxlength' => 50,
    'size'  => 50,
);

$ad2 = array(
    'name'  => 'ad2',
    'id'    => 'ad2',
    'value' => set_value('ad2'),
    'maxlength' => 50,
    'size'  => 50,
);


$postcode = array(
    'name'  => 'postcode',
    'id'    => 'postcode',
    'value' => set_value('postcode'),
    'maxlength' => 5,
    'size'  => 5,
);

$city = array(
    'name'  => 'city',
    'id'    => 'city',
    'value' => set_value('city'),
    'maxlength' => 30,
    'size'  => 30,
);

echo form_open('register/candidat','class="form"'); ?>

<div class='row-fluid'>
    <div class='span6'>
<?php 
echo("<div class='control-group'>");
echo form_label('Votre prénom *', 'prenom', 'class="control-label"');
echo form_input($prenom);


echo form_label('Votre nom *', 'nom', 'class="control-label"');
echo form_input($nom);
echo("</div>");


echo("<div class='control-group'>");
echo form_label('Votre date de naissance *', 'dob', 'class="control-label"');
echo form_input($dob);
echo "<span class='help-block'>jj/mm/aaaa</span>";
echo("</div>");


echo("<div class='control-group'>");
echo form_label('N° de téléphone', 'mobile', 'class="control-label"');
echo form_input($mobile);
echo("</div>"); ?>        
    </div> 
    
    <div class='span6'>
<?php
echo("<div class='control-group'>");
echo form_label('Adresse', 'ad1', 'class="control-label"');
echo form_input($ad1);
echo "<span class='help-block'>n° et rue</span>";
echo form_input($ad2);
echo "<span class='help-block'>complément</span>";
echo form_label('Code postal', 'postcode', 'class="control-label"');
echo form_input($postcode);
echo form_label('Ville', 'city', 'class="control-label"');
echo form_input($city);
echo("</div>"); ?>               
    </div>      
<?php echo form_submit("register","valider et passer à l'étape suivante", "class='btn btn-primary btn-large'");?>
<?php echo form_close(); ?>
</div>


</div>