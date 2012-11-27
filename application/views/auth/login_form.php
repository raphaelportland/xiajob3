<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'size'	=> 30,
);

if ($login_by_username AND $login_by_email) {
	$login_label = 'Email or login';
} else if ($login_by_username) {
	$login_label = 'Login';
} else {
	$login_label = 'Email';
}

$label_attributes = array(
'class' => 'control-label',
);

$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'size'	=> 30,
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	//'style' => 'margin:0;padding:0',
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);
?>

<?php echo form_open('auth/login','class="form-horizontal"'); //echo form_open($this->uri->uri_string()); ?>

<legend>Connectez-vous</legend>

<div class="control-group">
    <?php echo form_label($login_label, $login['id'],$label_attributes); ?>
    <?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>
    <div class="controls">
        <?php echo form_input($login); ?>    
    </div>     
</div>


<div class="control-group">
    <?php echo form_label('Mot de passe', $password['id'],$label_attributes); ?>
    <?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>
    <div class="controls">
        <?php echo form_password($password); ?>    
    </div>     
</div>

<div class="control-group">
    <div class="controls">
        <label class="checkbox">
          <?php echo form_checkbox($remember); ?><?php echo form_label('mémoriser', $remember['id']); ?>
        </label>
        <?php echo form_submit('submit', 'Entrer','class="btn btn-primary"'); ?>
                <?php echo anchor('/auth/forgot_password/', 'Mot de passe oublié '); ?>
    </div>   
</div>

<div class="control-group">
    <div class="controls">
<?php echo anchor('extlinks/facebook_request/candidat',' ','title="Utilisez facebook pour vous connecter" class="fbconnect-btn"'); ?>
    </div>   
</div>

<center>
Pas encore inscrit ? <?php echo anchor('auth/register/candidat', 'Créez votre compte gratuitement'); ?>   
</center>

		
			<?php //if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', ' S\'inscrire'); ?>


<?php echo form_close(); ?>

