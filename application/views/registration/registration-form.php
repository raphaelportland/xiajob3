
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

<?php echo form_open('auth/register'); ?>

<h1>Inscription</h1>

<div class='row'>
    <div class='span4'>
        <!-- Champ email -->  
        <div class='control-group'>
            <?php echo form_label('Adresse email', $email['id'],$label_attributes); ?>
            <?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
            <div class='controls'>
                <?php echo form_input($email); ?>
            </div>    
        </div>        
    </div>
    
    <div class='span4'>
        <!-- Mot de passe -->
        <div class='control-group'>
            <?php echo form_label('Mot de passe', $password['id'],$label_attributes); ?>
            <?php echo form_error($password['name']); ?>
            <div class='controls'>
                <?php echo form_password($password); ?>
            </div>    
        </div>        
    </div>
    
    <div class='span4'>
        <!-- Mot de passe 2 -->
        <div class='control-group'>
            <?php echo form_label('Mot de passe (vérification)', $confirm_password['id'],$label_attributes); ?>
            <?php echo form_error($confirm_password['name']); ?>
            <div class='controls'>
                <?php echo form_password($confirm_password); ?>
            </div>    
        </div>        
    </div>
</div>    

        
<!-- CGU -->
<div class='control-group'>
    <?php echo form_error($optin_cgu['name']); ?>
    <div class='controls'>
        <label class="checkbox">
        <?php echo form_checkbox($optin_cgu); ?> J'accepte les <?php echo anchor('pages/cgu',"Conditions Générales d'Utilisation",'target="_blank"'); ?> de florBooks
        </label>
    </div>
</div>


<br />
<p class='lead'>Quel type de compte voulez-vous créer ?</p> 
<div class='row'>
    
    
    <!-- Compte perso -->
    <div class="span6"> 
            <h2>Un compte perso</h2>         
        <div class='well'>            
            <ul>
                <li>Créer votre profil/CV floral professionnel</li>
                <li>Déposer des florbooks à votre nom</li>
                <li>Ajouter des books en favoris</li>
                <li>Créer des alertes emploi (bientôt !)</li>
                <li>et bien d'autres ... </li>
            </ul>
            <div class='control-group'>
                <div class='controls'>
                <br />
                <?= form_submit('submit_perso', "Créer mon compte perso","class='btn btn-info btn-large'"); ?>
                <br /><br />Vous pouvez aussi créer votre compte perso avec facebook : <?= anchor('extlinks/facebook_request/candidat',' ','title="Utilisez facebook pour vous connecter" class="fbconnect-btn"'); ?>
                </div>
            </div>               
        </div>
    </div>
    
    <!-- Compte pro -->
    <div class='span6'>
            <h2>Un compte pro</h2>        
        <div class='well'>
            <strong>Prochainement...</strong>
            <ul>
                <li>Créer une ou plusieurs pages magasin</li>
                <li>Déposer des florbooks au nom de vos magasins</li>
                <li>Déposer des annonces (recrutement, vente magasin, recherche de partenaire)</li>
                <li>et bien d'autres !</li>
            </ul>
            <div class='control-group'>
                <div class='controls'>
                <br />
                <?php //echo form_submit('submit_pro', "Créer mon compte pro","class='btn btn-warning btn-large'"); ?>
                <?= anchor('pages/coming_soon',"Créer mon compte pro", "title=\"C'est pour bientôt !\" class='btn btn-large disabled'"); ?>
                </div>
            </div>              
        </div>
      
    </div>
    
</div>
    


<?php echo form_close(); ?> 

