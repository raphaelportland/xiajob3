Bienvenue sur <?php echo $site_name; ?>,

Nous vous remercions pour votre inscription à <?php echo $site_name; ?>. Nous avons listé les détails de votre compte ci-dessous, faites attention à les garder en sécurité.
Pour confirmer votre adresse email, veuillez suivre ce lien :

<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key.'/'.$password); ?>


Vous devez confirmer votre adresse email dans les <?php echo $activation_period; ?> heures. Passé ce délai votre compte sera supprimé et vous devrez vous réinscrire.
<?php if (strlen($username) > 0) { ?>

Your username: <?php echo $username; ?>
<?php } ?>

Votre identifiant : <?php echo $email; ?>
<?php if (isset($password)) {  ?>

Votre mot de passe : <?php echo $password; ?>
<?php  } ?>

Bien cordialement,
L'Equipe <?php echo $site_name; ?>