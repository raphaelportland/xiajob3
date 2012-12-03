<?php // mes infos personnelles ?>

<?php

if(isset($user->dob)) :
    $user_dob = $user->dob;
else:
    $user_dob = '';
endif;

$dob = array(
    'name'  => 'dob',
    'id'    => 'dob',
    'value' => set_value('dob',$user_dob),
    'maxlength' => 10,
    'size'  => 10,
);

if(isset($user->last_name)) :
    $user_nom = $user->last_name;
else:
    $user_nom = '';
endif;

$nom = array(
    'name'  => 'nom',
    'id'    => 'nom',
    'value' => set_value('nom',$user_nom),
    'maxlength' => 30,
    'size'  => 30,
);





if(isset($user->username)) :
    $username = $user->username;
else:
    $username = '';
endif;

$pseudo = array(
    'name'  => 'username',
    'id'    => 'username',
    'value' => set_value('username',$username),
    'maxlength' => 30,
    'size'  => 30,
);




if(isset($user->first_name)) :
    $user_prenom = $user->first_name;
else:
    $user_prenom = '';
endif;

$prenom = array(
    'name'  => 'prenom',
    'id'    => 'prenom',
    'value' => set_value('prenom',$user_prenom),
    'maxlength' => 30,
    'size'  => 30,
);

if(isset($user->mobile_phone)) :
    $user_mobile = $user->mobile_phone;
else:
    $user_mobile = '';
endif;

$mobile = array(
    'name'  => 'mobile',
    'id'    => 'mobile',
    'value' => set_value('mobile',$user_mobile),
    'maxlength' => 30,
    'size'  => 30,
);

if(isset($user->address->street)) :
    $user_ad1 = $user->address->street;
else:
    $user_ad1 = '';
endif;

$ad1 = array(
    'name'  => 'ad1',
    'id'    => 'ad1',
    'value' => set_value('ad1',$user_ad1),
    'maxlength' => 50,
    'size'  => 50,
);

if(isset($user->address->complement)) :
    $user_ad2 = $user->address->complement;
else:
    $user_ad2 = '';
endif;

$ad2 = array(
    'name'  => 'ad2',
    'id'    => 'ad2',
    'value' => set_value('ad2',$user_ad2),
    'maxlength' => 50,
    'size'  => 50,
);

if(isset($user->address->postcode)) :
    $user_postcode = $user->address->postcode;
else:
    $user_postcode = '';
endif;

$postcode = array(
    'name'  => 'postcode',
    'id'    => 'postcode',
    'value' => set_value('postcode',$user_postcode),
    'maxlength' => 5,
    'size'  => 5,
);

if(isset($user->address->city)) :
    $user_city = $user->address->city;
else:
    $user_city = '';
endif;

$city = array(
    'name'  => 'city',
    'id'    => 'city',
    'value' => set_value('city',$user_city),
    'maxlength' => 30,
    'size'  => 30,
);

    
    
if(isset($user->options->status) && ($user->options->status == 'student')) { $student_status_checked = true; } else { $student_status_checked = false; }    
$student_status = array(
    'name' => 'status',
    'id' => 'student_status',
    'value' => 'student',
    'checked' => $student_status_checked,
);

if(isset($user->options->status) && ($user->options->status == 'pro')) { $pro_status_checked = true; } else { $pro_status_checked = false; }
$pro_status = array(
    'name'        => 'status',
    'id'          => 'pro_status',
    'value'       => 'pro',
    'checked'     => $pro_status_checked,
);    
    
if(isset($user->options->status) && ($user->options->status == 'amateur')) { $amateur_status_checked = true; } else { $amateur_status_checked = false; }
$amateur_status = array(
    'name'        => 'status',
    'id'          => 'amateur_status',
    'value'       => 'amateur',
    'checked'     => $amateur_status_checked,
);      

echo form_open('main/edit_profile/0','class="form"'); ?>

<div class='row-fluid'>
    <div class='span6'>
<?php 
echo("<div class='control-group'>");
echo form_label('Votre prénom', 'prenom', 'class="control-label"');
echo form_input($prenom);


echo form_label('Votre nom', 'nom', 'class="control-label"');
echo form_input($nom);


echo form_label('Pseudonyme', 'username', 'class="control-label"');
echo form_input($pseudo);
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
<label class="radio">
    <?php echo form_radio($amateur_status); ?>
    Amateur
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

<?php echo form_hidden('country', 'France'); ?>

<div class='row-fluid'>
<?php echo form_submit("register","Mettre à jour mes informations", "class='btn btn-primary btn-large pull-right'");?>
<?php echo form_close(); ?>
</div>




