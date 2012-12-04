  
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
          <div class='container-fluid'>
                <?php echo anchor('book',' florBooks','class="brand"'); ?>
                <ul class="nav">
                    <li><a>FR</a></li>                           
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Books <b class="caret"></b></a>                        
                        <ul class="dropdown-menu">
                            <li><?php echo anchor("book",'<i class="icon icon-eye-open"></i> Voir'); ?></li>
                            <li><?php echo anchor("book/my_books",'<i class="icon icon-camera"></i> Créer','class=""'); ?></li>
                            <li><?php echo anchor("pages/hints",'<i class="icon icon-question-sign"></i> Conseils','class=""'); ?></li>                          
                        </ul>
                    </li>
                    <li><?php echo anchor("main/welcome",'Mon Espace'); ?></li>
                 </ul>
 
                
                <ul class='nav pull-right'>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?= $this->session->userdata('username'); ?> <b class="caret"></b></a>                        
                        <ul class="dropdown-menu">
                            <li><?php echo anchor("main/edit_profile",'<i class="icon icon-user"></i> Mon profil'); ?></li>
                            <li><?php echo anchor("auth/logout",'<i class="icon icon-off"></i> Déconnexion'); ?></li>                          
                        </ul>
                     </li>
                    <?php echo anchor('pages/coming_soon', 'Achat/Vente magasin','class="pull-right btn btn-info"'); ?>  
                    <?php echo anchor('pages/coming_soon', 'Emploi/Recrutement','class="pull-right btn btn-primary"'); ?>                         
                </ul>             

                 <ul class='nav book-infos'>
                    <li class="divider-vertical"></li>
                    <?php if(isset($description) && $description != '') : ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle book-title" data-toggle="dropdown">&nbsp;<i class='icon icon-white icon-book'></i> &nbsp;<?= $name; ?> &nbsp; <b class="caret"></b></a>          
                        <ul class="dropdown-menu">
                          <li class='book-description'>
                              <?= $description; ?>
                          </li>
                        </ul>
                    </li>
                    <?php else : ?>
                    <li>
                        <a class="book-title">&nbsp;<i class='icon icon-white icon-book'></i> &nbsp;<?= $name; ?> &nbsp; </a>          
                    </li>                    
                    <?php endif; ?>                     
                    <li><?php echo anchor('profile/view/'.$owner->id, 'by '.$owner->username,'title="voir le profil"'); ?></li>
                    <li class="divider-vertical"></li>                                                                                                                                    
                </ul>  

                
        </div>
      </div> 
    </div>