    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <div class='container-fluid'>
                <?php echo anchor('recruteur',' FleurJob','class="brand"'); ?>
                <ul class="nav pull-left">
                  
                  <li><?php echo anchor('recruteur', '<i class="icon-home icon-white"></i> Accueil'); ?></li>
                  <li><?php echo anchor('recruteur/welcome','Ma boutique'); ?></a></li>                   

                </ul>  
                
                <ul class="nav pull-right">
                    <li>
                    <?php 
                    if (!$this->tank_auth->is_logged_in()) {
                        
                        echo anchor("auth/login","Connectez-vous");
                        
                    } else {
                        
                        echo anchor("auth/logout","déconnexion");
                    } ?>
                    </li>                 
                </ul>
        </div>
      </div>
    </div>
