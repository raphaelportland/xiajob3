  <li class="span3">
    <div class="thumbnail">
      <img src="http://placehold.it/300x100&text=You" alt="">
      <p class='lead'>Bienvenue <?php if(isset($user->first_name)) { echo $user->first_name; } ?> !</p>
      <?php if($user->username != '') : ?>
          <p>Votre nom public : <em><?= $user->username; ?></em></p>
      <?php else : ?>
          <p>Vous n'avez pas défini de pseudonyme pour votre profil public.</p>       
      <?php endif; ?>
    <?php echo anchor('auth/logout','<i class="icon icon-white icon-off"></i> Sortir','class="btn btn-inverse"'); ?>
    </div>
  </li>