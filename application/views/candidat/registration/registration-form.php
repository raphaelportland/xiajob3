
<?php
if ($use_username) {
    $username = array(
        'name'  => 'username',
        'id'    => 'username',
        'value' => set_value('username'),
        'maxlength' => $this->config->item('username_max_length', 'tank_auth'),
        'size'  => 30,
    );
}
$email = array(
    'name'  => 'email',
    'id'    => 'email',
    'value' => set_value('email'),
    'maxlength' => 80,
    'size'  => 30,
);
$password = array(
    'name'  => 'password',
    'id'    => 'password',
    'value' => set_value('password'),
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'size'  => 30,
);
$confirm_password = array(
    'name'  => 'confirm_password',
    'id'    => 'confirm_password',
    'value' => set_value('confirm_password'),
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'size'  => 30,
);

$student_status = array(
    'name' => 'status',
    'id' => 'student_status',
    'value' => 'student',
    'checked' => false,
);

$pro_status = array(
    'name'        => 'status',
    'id'          => 'pro_status',
    'value'       => 'pro',
    'checked'     => TRUE,
);

$label_attributes = array(
'class' => 'control-label',
);

$captcha = array(
    'name'  => 'captcha',
    'id'    => 'captcha',
    'maxlength' => 8,
);


$optin_cgu = array(
    'name'        => 'optin_cgu',
    'id'          => 'optin_cgu',
    'value'       => '1',
    'checked'     => false,
    );




?>
<?php echo form_open($this->uri->uri_string()); ?>

<legend>Inscription</legend> 


    <?php if ($use_username) { ?>
<table>        
    <tr>
        <td><?php echo form_label('Username', $username['id']); ?></td>
        <td><?php echo form_input($username); ?></td>
        <td style="color: red;"><?php echo form_error($username['name']); ?><?php echo isset($errors[$username['name']])?$errors[$username['name']]:''; ?></td>
    </tr>
</table>    
    <?php } ?>
    

<div class='control-group'>
    <?php echo form_label('Adresse email', $email['id'],$label_attributes); ?>
    <?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
    <div class='controls'>
        <?php echo form_input($email); ?>
    </div>    
</div>
  
<div class='control-group'>
    <?php echo form_label('Mot de passe', $password['id'],$label_attributes); ?>
    <?php echo form_error($password['name']); ?>
    <div class='controls'>
        <?php echo form_password($password); ?>
    </div>    
</div>
      
<div class='control-group'>
    <?php echo form_label('Mot de passe (vérification)', $confirm_password['id'],$label_attributes); ?>
    <?php echo form_error($confirm_password['name']); ?>
    <div class='controls'>
        <?php echo form_password($confirm_password); ?>
    </div>    
</div>


<div class='control-group'>
    <?php echo form_error($optin_cgu['name']); ?>
    <div class='controls'>
        <label class="checkbox">
        <?php echo form_checkbox($optin_cgu); ?> J'accepte les <?php echo anchor('pages/cgu',"Conditions Générales d'Utilisation",'target="_blank"'); ?> de florBooks
        </label>
    </div>
</div>


<?php echo form_hidden('profile',$profile); ?>

<div class='control-group'>
    <div class='controls'>
    <?php echo form_submit('register', "Créer mon compte","class='btn btn-primary'"); ?>    
    </div>
</div>

    
<div class="control-group">
    <div class="controls">
<?php echo anchor('extlinks/facebook_request/candidat',' ','title="Utilisez facebook pour vous connecter" class="fbconnect-btn"'); ?>
    </div>   
</div>

<?php echo form_close(); ?>
