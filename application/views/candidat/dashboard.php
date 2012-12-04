<br />
<p class='lead'>Mon Espace</p>


<?php
if($user->options->profile_step != 'finished') {
    $this->load->view('candidat/elmt/please_finish_your_profile');
}
?>



<div class='row-fluid'>
    <div class='span3'>
        <!-- User -->
        <h3><?= $user->username; ?></h3>
        <?= anchor('main/edit_profile','<i class="icon icon-white icon-user"></i> Modifier mon profil','class="btn btn-primary"'); ?>
        
        <br /><br />
        <p class='muted'>Membre depuis le <?= date("d F Y", $user->member_since); ?></p>
    </div>
    
    
    <div class='span9'>
        <!-- Skills -->
        <?php echo anchor('main/edit_profile/2','<h3>Compétences</h3>'); ?>

        <div class='span4'>
            <table class='table'>
                    <?php for ($j=1; $j < 6; $j++) :
                        
                        $competence = $user->resume->skills[$j]; 
                        $score = $competence->score;
                        
                        echo("<tr><td><p><small>".$competence->nom."</small></p></td><td>");  
                        
                        for ($i=0; $i < 4; $i++) {
                            if($score > 1) : ?>
                                <i class='star star-on'></i>
                            <?php $score = $score - 1;
                            else : ?>
                                <i class='star star-off'></i>                
                            <?php endif;
                        }
                        echo("</td></tr>");
                    endfor;?>
            </table>                        
        </div>
        <div class='span4'>
            <table class='table'>
                    <?php for ($j=6; $j < 9; $j++) :
                        
                        $competence = $user->resume->skills[$j]; 
                        $score = $competence->score;
                        
                        echo("<tr><td><p><small>".$competence->nom."</small></p></td><td>");  
                        
                        for ($i=0; $i < 4; $i++) {
                            if($score > 1) : ?>
                                <i class='star star-on'></i>
                            <?php $score = $score - 1;
                            else : ?>
                                <i class='star star-off'></i>                
                            <?php endif;
                        }
                        echo("</td></tr>");
                    endfor;?>
            </table>             
        </div>

    </div>    
</div>

<div class='row-fluid'>
    <div class='span6'>
        <?php echo anchor('book/my_books','<h3>Mes florBooks ('.count($user->books).')</h3>'); ?>
        <table class='table'>
            <tr><th>Nom</th><th><i class='icon icon-star'></i> (Favoris)</th></tr>
        <?php
        foreach ($user->books as $key => $book) {
          
            echo "<tr><td>".anchor('book/view/'.$book->id, $book->name)."</td>";
            echo "<td>$book->fav_count</td></tr>";  
            
        }
        ?>
        </table>
    </div>
    
    <div class='span6'>
        <?= anchor('social/favorites','<h3>Favoris</h3>'); ?>

        <?php         
        if(!isset($user->favorites)) :
            echo "<p>Vous n'avez pas de florBooks favoris pour le moment</p>";
            
        elseif(count($user->favorites) == 1) :
            echo "<p>Vous avez 1 florBook favori.</p>";
        else :
            echo "<p>Vous avez ".count($user->favorites)." floBooks favoris.</p>";
        endif;        
        ?>   
    </div>       
    
</div>