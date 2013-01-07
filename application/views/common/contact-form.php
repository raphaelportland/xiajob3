<?php

    if(isset($user->email)) {
        $user_email = $user->email;
    } else {
        $user_email = '';
    }
        

?>

<center>
    <img src="<?= base_url().'public/img/timbre.jpg'; ?>" />   
    <h1>Laissez-nous un message !</h1>    
</center>

<p>Des idées, l’envie de participer, un mot gentil ou même une frustration à évacuer… n’hésitez pas.<br /> 
Sans vos retours, on ne peut pas améliorer le site. Nous répondons, à tout le monde, au plus vite !</p>

<?php echo validation_errors(); ?>

<?php echo form_open('social/contact', 'class="form-horizontal"');

$subject = array(
    'name'  => 'subject',
    'id'    => 'subject',
    'value' => set_value('subject'),
    'placeholder' => 'le sujet de votre message',
    'maxlength' => 255,
    'size'  => 30,
);

$email = array(
    'name'  => 'email',
    'id'    => 'email',
    'value' => set_value('email', $user_email),
    'placeholder' => 'votre email pour la réponse',
    'maxlength' => 255,
    'size'  => 30,
);

$message = array(
    'name' => 'message',
    'id' => 'message',
    'placeholder' => 'votre message',
    'value' => set_value('message'),
);

?>

<p class='lead'>Pourquoi vous nous contactez ?</p>

<div class="control-group">
    <label class="radio">
        <input type='radio' name='motive' value='happy' <?php echo set_radio('motive', 'happy'); ?>/>
        Je veux juste laisser un message sympa
    </label>

    <label class="radio">
    <input type='radio' name='motive' value='participate' <?php echo set_radio('motive', 'participate'); ?>/>
    Je suis très content(e) du site et j’ai quelque chose à dire
    </label>

    <label class="radio">
    <input type='radio' name='motive' value='bug' <?php echo set_radio('motive', 'bug'); ?>/>
    Je veux signaler un problème
    </label>

    <label class="radio">
    <input type='radio' name='motive' value='team' <?php echo set_radio('motive', 'team'); ?>/>
    Je suis pas content(e) et j’ai de bonnes raisons !
    </label>

    <label class="radio">
    <input type='radio' name='motive' value='participate' <?php echo set_radio('motive', 'participate'); ?>/>
    Je veux parler à l’équipe (et ça rentre pas dans les cases du dessus)
    </label>
</div>


<p>Mille mercis à tous ceux qui ont écrit des messages sympa.<br />
Nous avons chacun une activité à coté et vos encouragements ne sont pas de trop ;)</p>


<p class='lead'>Votre message</p>

<div class="control-group">
<?php echo form_label('Sujet', 'subject'); ?>
<?php echo form_input($subject); ?>
</div>

<div class="control-group">
<?php echo form_label('Votre addresse email pour la réponse', 'email'); ?>
<?php echo form_input($email); ?>
</div>


<div class="control-group">
<?php echo form_label('Votre message', 'message'); ?>
<?php echo form_textarea($message); ?>
</div>

<div class="control-group">
<?php echo form_submit('submit', 'Envoyer', 'class="btn btn-success"'); ?>
</div>
<?php echo form_close(); ?>
