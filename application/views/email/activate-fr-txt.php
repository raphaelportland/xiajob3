Bienvenue chez florBooks... et merci !

Nous avons listé les détails de votre compte ci-dessous, à garder précieusement !
Pour confirmer votre adresse email, veuillez suivre ce lien :

<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key.'/'.$password); ?>


Vous devez confirmer votre adresse email dans les <?php echo $activation_period; ?> heures. Passé ce délai votre compte sera supprimé et vous devrez vous réinscrire.

Votre identifiant : <?php echo $email; ?>
<?php if (isset($password)) {  ?>

Votre mot de passe : <?php echo $password; ?>
<?php  } ?>

Bien Floralement,
L'Equipe florBooks