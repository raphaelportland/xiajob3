<?php
/**
 * Template publique pour la partie candidat
 * 
 */
?>
 
<?php $this->load->view('common/head'); ?>

<?php $this->load->view('candidat/elmt/public-head-nav'); ?>       

<div class="container-fluid">    
    
    <div class="row-fluid">
    <!-- photo -->
    <!--
    <div class='span2'>
        <br />
        <img src='http://placehold.it/140x140' class='img-polaroid' />  
        <br />
        <?php echo anchor('', 'envoyer un message', 'class="btn btn-mini"'); ?>
        <br />
        <?php echo anchor('', 'ajouter aux favoris', 'class="btn btn-mini"'); ?>                
    </div>
    -->
    
    <!-- Infos générales -->
    <div class='span6'>
        <h1><?php 
        if(isset($username) && ($username != '')) : 
            echo $username; 
        else : 
            if(isset($first_name) && ($first_name != '')) :
                echo($first_name);
            else :
                echo "Anonymous"; 
            endif;
        endif; ?>
        <br />
        <small><?php if(isset($address->country)) : echo $address->country; else : echo "(France)"; endif; ?> </small>
        <span class="badge badge-success badge-large"><?php if(isset($options->status)) : echo $options->status; else : echo "statut non défini"; endif; ?></span></h1>
            
        
        <!--
        <div>
            Prix / récompenses
        </div>
        -->
        
        <br />
        <blockquote>
            <p class=''><?php if(isset($description)) : echo $description; endif; ?></p>
        </blockquote>
        
    </div>
    
    
    <!-- Styles pratiqués -->
    <div class='span4'>
        <h3>Styles pratiqués</h3>
        
        <?php if(isset($options->libreservice) && ($options->libreservice == 1)) : ?>
        <span class="badge badge-info badge-large">Libre service</span><br />   
        <?php endif; ?> 
            
        <?php if(isset($options->even) && ($options->even == 1)) : ?>
        <span class="badge badge-info badge-large">Evénementiel</span><br />   
        <?php endif; ?>         
        
        <?php if(isset($options->design) && ($options->design == 1)) : ?>
        <span class="badge badge-info badge-large">Designer Floral</span><br />   
        <?php endif; ?>         
        
        <?php if(isset($options->tradi) && ($options->tradi == 1)) : ?>
        <span class="badge badge-info badge-large">Traditionnel</span><br />   
        <?php endif; ?>         
        
    </div>
    
    
    </div>
    
    
    
    <?php if($books): ?>
    <div class='row-fluid'>
        <h2>Mes books</h2>
        
        <?php foreach ($books as $key => $book) {
            
            //code($book);
            //@$book->occasion = $occasions[$book->id_occasion];
            
            //code($book);
                     
            $this->load->view('books/templates/book_thumb',$book);
            
            
        } ?>

    </div>
    <?php endif; ?>
    
<?php if(isset($resume->skills)) : ?>
    <div class='row-fluid'>
        <h2>Compétences</h2>
        
    
    <table class='table'>
        

            <?php 
            
            foreach($resume->skills as $key => $competence) :
            
                $score = $competence->score;
                $rating = $comp_rating[$score];
                
                echo("<tr><td><p class='lead'>".$competence->nom."</p></td><td>");  
                
                for ($i=0; $i < 4; $i++) {   

                    if($score > 1) : ?>
                        
                        <i class='star star-on'></i>
                        
                    <?php $score = $score - 1;
                    
                    else : ?>
                        
                        <i class='star star-off'></i>    
                                           
                    <?php endif;
                }
                
                echo("</td><td><small>$rating</small></td></tr>");

            endforeach; ?>
    </table>
        
    </div>
<?php endif; ?>   
    
    <div class='row-fluid'>
        <h2>Formation</h2>
        
<table class='table table-bordered table-hover'>
    <thead>
        <th>Année</th>
        <th>Ecole</th>
        <th>Diplôme</th>
    </thead>   
    <tbody>

<?php

foreach ($resume->diplomas as $key => $diplome) {   
    echo("<tr><td>$diplome->annee_diplome</td>");
    
    if($diplome->formation_id != 0) {
        echo("<td>$diplome->nom</td>");
    } else {
        echo("<td>$diplome->autre_formation</td>");
    }
    
    if($diplome->diplome_id != 0) {
        echo("<td>$diplome->diplome</td>");
    } else {
        echo("<td>$diplome->autre_diplome</td>");
    }    
    echo("</tr>");
}
?>     
    </tbody>  
</table>         


    </div>    
    
    <div class='row-fluid'>
        <h2>Expérience</h2>
        
<table class='table table-bordered table-hover'>
    <thead>
        <th>Période</th>
        <th>Entreprise</th>
        <th>Type d'établissement</th>
        <th>Poste occupé</th>
    </thead>   
    <tbody>

<?php

foreach ($resume->xppro as $key => $xp) {   
    echo("<tr><td>de $xp->month_start/$xp->year_start à $xp->month_end/$xp->year_end</td>");
    echo("<td>$xp->etablissement</td><td>$xp->type_name</td><td>$xp->poste_name</td>");  
    
    echo("<td></tr>");
}
?>     
    </tbody>  
</table>        
        
    </div> 
    
    <!--
    <div class='row-fluid'>
        <h2>Ses recommandations pro</h2>
    </div>     
    -->
       

</div> <!-- /container -->

<?php $this->load->view('common/footer'); ?>