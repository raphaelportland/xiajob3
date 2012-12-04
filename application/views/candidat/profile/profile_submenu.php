<ul class="nav nav-pills">
  <li <?php if($rubrique == 0) { echo "class='active'"; } ?>><?php echo anchor('main/edit_profile/0',"1. Mes infos personnelles"); ?></li>
  <li <?php if($rubrique == 1) { echo "class='active'"; } ?>><?php echo anchor('main/edit_profile/1',"2. Mon expérience"); ?></li>
  <li <?php if($rubrique == 2) { echo "class='active'"; } ?>><?php echo anchor('main/edit_profile/2',"3. Mes compétences"); ?></li>
  <li class='red-pill pull-right <?php if($rubrique == 3) { echo " active"; } ?>'><?php echo anchor('register/unregister',"<i class='icon icon-color icon-warning-sign'></i> Supprimer mon compte"); ?></li>
</ul>