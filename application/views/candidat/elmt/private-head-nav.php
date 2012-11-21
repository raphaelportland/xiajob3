    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <div class='container-fluid'>
                <?php echo anchor('fleurjob',' florBooks','class="brand"'); ?>
                <ul class="nav pull-left">    
                    <li><a>FR</a></li>                           
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Books <b class="caret"></b></a>                        
                        <ul class="dropdown-menu">
                            <li><?php echo anchor("book",'<i class="icon icon-eye-open"></i> Voir'); ?></li>
                            <li><?php echo anchor("book/my_books",'<i class="icon icon-camera"></i> Créer','class=""'); ?></li>
                            <li><?php echo anchor("book/advice",'<i class="icon icon-question-sign"></i> Conseils','class=""'); ?></li>                          
                        </ul>
                     </li>
                     <li><?php echo anchor("fleurjob/welcome",'Mon Espace'); ?></li>
                                
                </ul>  
                
                   <?php echo anchor('pages/coming_soon', 'Achat/Vente magasin','class="pull-right btn btn-info"'); ?>                                       
                   <?php echo anchor('pages/coming_soon', 'Accès Emploi/Recrutement','class="pull-right btn btn-primary"'); ?>   
                   
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?= $this->session->userdata('username'); ?> <b class="caret"></b></a>                        
                        <ul class="dropdown-menu">
                            <li><?php echo anchor("fleurjob/edit_profile",'<i class="icon icon-user"></i> Mon profil'); ?></li>
                            <li><?php echo anchor("auth/logout",'<i class="icon icon-off"></i> Déconnexion'); ?></li>                          
                        </ul>
                     </li>
                </ul>                   
                                        
                    

                                
                                  
        </div>
      </div>
    </div>
