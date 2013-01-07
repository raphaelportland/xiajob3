    <div id='topbar' class="navbar navbar-fixed-top">
      <div class="navbar-inner">
          <div class='container-fluid'>
                <a href='<?= site_url('main'); ?>'><img class="nav pull-left" src='<?= base_url(); ?>/public/img/logo.png' /></a>
                <img class="nav pull-left" src='<?= base_url(); ?>/public/img/beta.png' />
                <ul class="nav pull-left">    
                    <li><a>FR</a></li>                           
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Books <b class="caret"></b></a>                        
                        <ul class="dropdown-menu">
                            <li><?php echo anchor("book",'<i class="icon icon-eye-open"></i> Explorer'); ?></li>
                            <li><?php echo anchor("book/my_books",'<i class="icon icon-camera"></i> Mes florBooks','class=""'); ?></li>
                            <li><?php echo anchor("pages/hints",'<i class="icon icon-question-sign"></i> Conseils','class=""'); ?></li>                          
                        </ul>
                     </li>
                     <li><?php echo anchor("main/welcome",'Mon Espace'); ?></li>
                                
                </ul>  
                
                   <?php echo anchor('pages/coming_soon', 'Achat/Vente magasin','class="pull-right btn btn-info"'); ?>                                       
                   <?php echo anchor('pages/coming_soon', 'Emploi/Recrutement','class="pull-right btn btn-primary"'); ?>   
                   
                <ul class="nav pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?= $this->session->userdata('username'); ?> <b class="caret"></b></a>                        
                        <ul class="dropdown-menu">
                            <li><?php echo anchor("main/edit_profile",'<i class="icon icon-user"></i> Mon profil'); ?></li>
                            <li><?php echo anchor("auth/logout",'<i class="icon icon-off"></i> Déconnexion'); ?></li>                          
                        </ul>
                     </li>
                </ul>                   
                                        
                    

                                
                                  
        </div>
      </div>
    </div>
