<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><title>Bienvenue sur <?php echo $site_name; ?>!</title></head>
<body>
<div style="max-width: 800px; margin: 0; padding: 30px 0;">
<table width="80%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="5%"></td>
<td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
<h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Bienvenue chez <?php echo $site_name; ?>!</h2>
Nous vous remercions pour votre inscription à <?php echo $site_name; ?>. Nous avons listé les détails de votre compte ci-dessous, faites attention à les garder en sécurité.<br />
Pour confirmer votre adresse email, veuillez suivre ce lien :<br />
<br />
<big style="font: 16px/18px Arial, Helvetica, sans-serif;"><b><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key.'/'.$password); ?>" style="color: #3366cc;">Finaliser mon inscription...</a></b></big><br />
<br />
Ce lien ne marche pas ? Copiez le lien suivant dans la barre d'adresse de votre navigateur :<br />
<nobr><a href="<?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key.'/'.$password); ?>" style="color: #3366cc;"><?php echo site_url('/auth/activate/'.$user_id.'/'.$new_email_key.'/'.$password); ?></a></nobr><br />
<br />
Vous devez confirmer votre adresse email dans les <?php echo $activation_period; ?> heures. Passé ce délai votre compte sera supprimé et vous devrez vous réinscrire.<br />
<br />
<br />
<?php if (strlen($username) > 0) { ?>Your username: <?php echo $username; ?><br /><?php } ?>
Votre identifiant : <?php echo $email; ?><br />
<?php if (isset($password)) {  ?>Votre mot de passe : <?php echo $password; ?><br /><?php  } ?>
<br />
<br />
Bien cordialement,<br />
L'Equipe <?php echo $site_name; ?>
</td>
</tr>
</table>
</div>
</body>
</html>