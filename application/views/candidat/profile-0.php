<?php // mes infos personnelles ?>

<?php

$dob = array(
    'name'  => 'dob',
    'id'    => 'dob',
    'value' => set_value('dob',$userdata->options->dob),
    'maxlength' => 10,
    'size'  => 10,
);

$nom = array(
    'name'  => 'nom',
    'id'    => 'nom',
    'value' => set_value('nom',$userdata->options->nom),
    'maxlength' => 30,
    'size'  => 30,
);

$prenom = array(
    'name'  => 'prenom',
    'id'    => 'prenom',
    'value' => set_value('prenom',$userdata->options->prenom),
    'maxlength' => 30,
    'size'  => 30,
);

$mobile = array(
    'name'  => 'mobile',
    'id'    => 'mobile',
    'value' => set_value('mobile',$userdata->options->mobile),
    'maxlength' => 30,
    'size'  => 30,
);

$ad1 = array(
    'name'  => 'ad1',
    'id'    => 'ad1',
    'value' => set_value('ad1',$userdata->options->ad1),
    'maxlength' => 50,
    'size'  => 50,
);

$ad2 = array(
    'name'  => 'ad2',
    'id'    => 'ad2',
    'value' => set_value('ad2',$userdata->options->ad2),
    'maxlength' => 50,
    'size'  => 50,
);


$postcode = array(
    'name'  => 'postcode',
    'id'    => 'postcode',
    'value' => set_value('postcode',$userdata->options->postcode),
    'maxlength' => 5,
    'size'  => 5,
);

$city = array(
    'name'  => 'city',
    'id'    => 'city',
    'value' => set_value('city',$userdata->options->city),
    'maxlength' => 30,
    'size'  => 30,
    
);
    
    
if($userdata->options->status == 'student') { $student_status_checked = true; } else { $student_status_checked = false; }    
$student_status = array(
    'name' => 'status',
    'id' => 'student_status',
    'value' => 'student',
    'checked' => $student_status_checked,
);

if($userdata->options->status == 'pro') { $pro_status_checked = true; } else { $pro_status_checked = false; }
$pro_status = array(
    'name'        => 'status',
    'id'          => 'pro_status',
    'value'       => 'pro',
    'checked'     => $pro_status_checked,
);    
    
    

echo form_open('fleurjob/edit_profile/0','class="form"'); ?>

<div class='row-fluid'>
    <div class='span6'>
<?php 
echo("<div class='control-group'>");
echo form_label('Votre prénom', 'prenom', 'class="control-label"');
echo form_input($prenom);


echo form_label('Votre nom', 'nom', 'class="control-label"');
echo form_input($nom);
echo("</div>");


echo("<div class='control-group'>");
echo form_label('Votre date de naissance', 'dob', 'class="control-label"');
echo form_input($dob);
echo "<span class='help-block'>jj/mm/aaaa</span>";
echo("</div>"); ?>



<?php
echo("<div class='control-group'>");
echo form_label('N° de téléphone', 'mobile', 'class="control-label"');
echo form_input($mobile);
echo("</div>"); ?>    

<div class='control-group'>
<?php echo form_label('Votre statut : '); ?>

<label class="radio">
    <?php echo form_radio($pro_status); ?>
    Professionnel
</label>
<label class="radio">
    <?php echo form_radio($student_status); ?>
    Etudiant
</label>

</div>


    
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

</div>

<div class='row-fluid'>
<?php echo form_submit("register","Mettre à jour mes informations", "class='btn btn-primary btn-large pull-right'");?>
<?php echo form_close(); ?>
</div>




