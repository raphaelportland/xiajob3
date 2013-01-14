        <div id='big-footer' class='container-fluid'>
            <div class='container'>
            <div class='row'>
                <div class='span4'>
                    <h3>flor... qui ?</h3>
                    
                    <ul class="unstyled">
                         <li><?php echo anchor('pages/meet_the_gnomes','Qui sommes nous ?'); ?></li>
                         <li><?php echo anchor('pages/pitch','FlorBooks en quelques mots'); ?></li>
                         <li><?php echo anchor('pages/team','Est-ce que l\'équipe est sympa ?'); ?></li>
                         <li><?php echo anchor('pages/participate','Envie de participer ?'); ?></li>
                         <li><?php echo anchor('pages/faq','Questions courantes'); ?></li>
                         <li><?php echo anchor('social/contact','Laissez nous un message'); ?></li>
                    </ul>
                    
                </div>
            
                <div class='span4'>
                    <h3>Ennuyeux...</h3> 
                    <p class='small'>...mais necessaire !</p> 
                    <ul class="unstyled">
                        <li><?php echo anchor('pages/cgu', 'Conditions générales'); ?></li>
                        <li><?php echo anchor('social/contact','Signalez un abus'); ?></li>
                        <li><?php echo anchor('pages/coming_soon','Confidentialité'); ?></li>
                        <li><?php echo anchor('pages/coming_soon','Propriété intellectuelle'); ?></li>
                        <li><?php echo anchor('pages/coming_soon','Mentions Légales'); ?></li>
                    </ul>      
                </div>
                
                <div class='span4'>
                    <h3>Phase Beta <img src='<?= base_url(); ?>/public/img/beta.png' /></h3>
                    <br />  
                    <p>Cela veut dire que le site n'est <strong>pas encore finalisé</strong>.</p>
                    <p>On travaille dur pour tout améliorer ! <br />
                    Quelque chose cloche? <?php echo anchor('social/contact', 'dites-le nous ici !'); ?></p>          
                </div>
            </div> 
            
            <div id="footer" class='row-fluid'>
                <span>florBooks &copy; <?= date('Y'); ?></span>
            </div>    
            </div>
        </div>
<?php $this->load->view('common/webengage'); ?>
    </body>
</html>