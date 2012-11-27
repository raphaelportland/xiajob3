        <div id='big-footer' class='container-fluid'>
            <div class='container'>
            <div class='row'>
                <div class='span4'>
                    <strong>FLOR... QUI ?</strong>
                    <br /><br />
                    <ul class="unstyled">
                         <li><?php echo anchor('pages/meet_the_gnomes','Qui sommes nous ?'); ?></li>
                         <li><?php echo anchor('pages/coming_soon','florBooks en quelques mots'); ?></li>
                         <li><?php echo anchor('pages/coming_soon','Est-ce que l\'équipe est sympa ?'); ?></li>
                         <li><?php echo anchor('social/contact','Envie de participer ?'); ?></li>
                         <li><?php echo anchor('pages/coming_soon','FAQ'); ?></li>
                         <li><?php echo anchor('social/contact','Laissez nous un message'); ?></li>
                    </ul>
                    
                </div>
            
                <div class='span4'>
                    <strong>ENNUYEUX</strong>  
                    <p class='small'>(Mais necessaire)</p> 
                    <ul class="unstyled">
                        <li><?php echo anchor('pages/cgu', 'Conditions générales'); ?></li>
                        <li><?php echo anchor('social/contact','Signalez un abus'); ?></li>
                        <li><?php echo anchor('pages/coming_soon','Confidentialité'); ?></li>
                        <li><?php echo anchor('pages/coming_soon','Propriété intellectuelle'); ?></li>
                        <li><?php echo anchor('pages/coming_soon','Mentions Légales'); ?></li>
                    </ul>      
                </div>
                
                <div class='span4'>
                    <strong><i class='icon icon-white icon-warning-sign'></i> PHASE BETA <i class='icon icon-white icon-warning-sign'></i></strong><br />
                    <br />  
                    <p>Cela veut dire que le site n'est pas encore finalisé.</p>
                    <p>On travaille dur pour tout améliorer ! <br />
                    Vous avez vu un défaut ? <?php echo anchor('social/contact', 'dites-le nous ici !'); ?></p>          
                </div>
            </div> 
            
            <div id="footer" class='row-fluid'>
                <span>florBooks &copy; <?= date('Y'); ?></span>
            </div>    
            </div>
        </div>

    </body>
</html>