    <div id='topbar' class="navbar navbar-fixed-top">
      <div class="navbar-inner">
          <div class='container-fluid'>
                <a href='<?= site_url('wall'); ?>'><img class="nav pull-left" src='<?= base_url(); ?>/public/img/logo.png' /></a>
                <img class="nav pull-left" src='<?= base_url(); ?>/public/img/beta.png' />
                <ul class="nav pull-left">
                    <li><a>FR</a></li>                           
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Books <b class="caret"></b></a>                        
                        <ul class="dropdown-menu">
                            <li><?php echo anchor("book",'<i class="icon icon-eye-open"></i> Explorer'); ?></li>
                            <li><?php echo anchor("auth/register",'<i class="icon icon-camera"></i> Mes florBooks','class=""'); ?></li>
                            <li><?php echo anchor("pages/hints",'<i class="icon icon-question-sign"></i> Conseils','class=""'); ?></li>                          
                        </ul>
                     </li>
                    <li><?php echo anchor('auth/register','Inscription'); ?></li>
                </ul>
                    
                
                   <?php echo anchor('pages/coming_soon', 'Achat/Vente magasin','class="pull-right btn btn-info"'); ?>                                       
                   <?php echo anchor('pages/coming_soon', 'Emploi/Recrutement','class="pull-right btn btn-primary"'); ?>   
                   
                <ul class="nav pull-right">
                    <li><?php echo anchor("auth/login","Connectez-vous"); ?></li>
                </ul> 
                                      
        </div>
      </div>
    </div>
