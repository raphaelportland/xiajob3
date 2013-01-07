<?php 
/**
 * Homepage de la partie Candidat
 */
?>
<div class='row'>
    <h1>Révélez vos talents !</h2>      
</div>

<div class='row first-row'>

    <!-- La vidéo de présentation -->
    <div class='pull-left'>
        <iframe width="640" height="360" src="http://www.youtube.com/embed/P_qgquKHgV4?rel=0" frameborder="0" allowfullscreen></iframe>        
    </div>
 
    
    <!-- Le formulaire de login -->
    <div class='home-login'>
        <center>
            <br />
            <h2>J'ai un compte !</h2>
            <?= anchor('auth/login','je me connecte','class="btn btn-pink"'); ?>    
            <br /><br /><br />
            <h2>Pas encore inscrit ?</h2>
            
            <?= anchor('auth/register/candidat', 'Inscrivez-vous ici', 'class="btn btn-primary"'); ?><br /><br />
            <?php echo anchor('extlinks/facebook_request/candidat',' ','title="Utilisez facebook pour vous connecter" class="fbconnect-btn"'); ?>        
            
        </center>

        
        
        <?php /*
        $data['show_captcha'] = FALSE;
        $data['login_by_username'] = FALSE;
        
        $this->load->view('auth/login_form', $data); */
        ?>    
    </div>   
    
</div>



<div class='row section'>
    <span class='title-btn'><h2>Les florBooks les plus populaires</h2> <?php echo anchor('book','<i class="icon icon-chevron-right"></i> Explorer tous les books'); ?></span>
        <?php 
        
        foreach ($books as $key => $book) : // les books récents               
            $this->load->view('books/templates/book_thumb',$book);        
        endforeach; 
        ?> 
</div>        
     
       
       


