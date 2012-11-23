<h2>Contactez nous</h2>

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
    'value' => set_value('email'),
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

<div class="control-group">
<?php echo form_label('Sujet', 'subject'); ?>
<?php echo form_input($subject); ?>
</div>

<div class="control-group">
<?php echo form_label('Adresse Email', 'email'); ?>
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


