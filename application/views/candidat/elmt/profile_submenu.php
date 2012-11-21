<ul class="nav nav-pills">
  <li <?php if($rubrique == 0) { echo "class='active'"; } ?>><?php echo anchor('fleurjob/edit_profile/0',"Mes infos personnelles"); ?></li>
  <li <?php if($rubrique == 1) { echo "class='active'"; } ?>><?php echo anchor('fleurjob/edit_profile/1',"Mon expérience"); ?></li>
  <li <?php if($rubrique == 2) { echo "class='active'"; } ?>><?php echo anchor('fleurjob/edit_profile/2',"Mes compétences"); ?></li>
  <li <?php if($rubrique == 3) { echo "class='active'"; } ?>><?php echo anchor('fleurjob/edit_profile/3',"Mon Book"); ?></li>
  <li class='disabled'><a href="#">Mes alertes</a></li>
</ul>