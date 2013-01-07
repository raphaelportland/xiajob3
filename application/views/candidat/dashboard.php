<br />
<h1>Mon Espace</h1>


<?php
if($user->options->profile_step != 'finished') {
    $this->load->view('candidat/elmt/please_finish_your_profile');
}
?>

        <!-- User -->
        <h3><?= $user->username; ?></h3>
        <?= anchor('main/edit_profile','<i class="icon icon-white icon-user"></i> Modifier mon profil','class="btn btn-primary"'); ?>
        
        <br /><br />
        <p class='muted'>Membre depuis le <?= date("d F Y", $user->member_since); ?></p>   
    
   
        <!-- Skills -->
        <p class='lead'>Compétences <?php echo anchor('main/edit_profile/2','Mettre à jour', 'class="btn"'); ?></p>
        <?php $this->load->view('candidat/elmt/skills-2columns'); ?>
    


    <p class="lead">Mes florBooks <small>(<?= count($user->books); ?>)</small> <?php echo anchor('book/my_books','Modifier', 'class="btn"'); ?></p>    
    <div class='row'>
        <div class='span12'>
        <table class='table'>
            <tr><th>Nom</th><th><i class='icon icon-star'></i> (Favoris)</th></tr>
        <?php
        foreach ($user->books as $key => $book) {
          
            echo "<tr><td>".anchor('book/show/'.$book->id, $book->name)."</td>";
            echo "<td>$book->fav_count</td></tr>";  
            
        }
        ?>
        </table>
        </div>
    </div>
    
    <p class='lead'>Mes favoris <?= anchor('social/favorites','Voir / Modifier', 'class="btn"'); ?></p>    
    <div class='row'>
        <div class='span12'>
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