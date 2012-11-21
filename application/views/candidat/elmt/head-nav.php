    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <div class='container-fluid'>
                <?php echo anchor('fleurjob',' FleurJob','class="brand"'); ?>
                <ul class="nav pull-left">
                  
                  <li><?php echo anchor('fleurjob', '<i class="icon-home icon-white"></i> Accueil'); ?></li>
                  <li><?php echo anchor('auth/register/candidat','Inscription'); ?></li>
                  <li><a href="#">About</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>  
                
                <ul class="nav pull-right">
                    <li>
                    <?php echo anchor("fleurjob/logout","déconnexion"); ?>
                    </li>                 
                </ul>
        </div>
      </div>
    </div>
