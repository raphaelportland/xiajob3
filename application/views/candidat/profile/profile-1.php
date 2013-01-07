<?php // mon expérience ?>


<?php $this->load->view('candidat/elmt/modal-addRecomp'); ?>
<?php $this->load->view('candidat/elmt/modal-addDiplome'); ?>
<?php $this->load->view('candidat/elmt/modal-addXp'); ?>
<?php $this->load->view('candidat/elmt/modal-edit'); ?>

<p class='lead'>Prix et récompenses</p>

<table class='table table-bordered table-hover'>
    <thead>
        <th>Récompense</th>
        <th>Précision</th>
        <th>Année</th>
        <th></th>
    </thead>   
    <tbody>

<?php

foreach ($user->resume->awards as $key => $recompense) {   
    echo("<tr><td>$recompense->name</td><td>$recompense->autre_recomp</td><td>$recompense->year_recomp</td>
    <td>"); ?>

    <?= anchor("main/edit/recomp/$recompense->user_recomp_id", '<i class="icon-edit"></i> Modifier', 'role="button" class="btn edit"'); ?>&nbsp;
    <?= anchor("main/del/recomp/$recompense->user_recomp_id",'<i class="icon-trash icon-white"></i>', 'class="btn btn-danger confirm"');
?>   
    <?php echo("</td></tr>");
}
?>     
    </tbody>  
</table>
<?php echo anchor('#addRecomp','<i class="icon-plus icon-white"></i> Ajouter un prix', 'role="button" class="btn btn-pink" data-toggle="modal"'); ?>

<br /><br />
<br /><br />

<p class='lead'>Formations et diplômes</p>

<table class='table table-bordered table-hover'>
    <thead>
        <th>Année</th>
        <th>Ecole</th>
        <th>Diplôme</th>
        <th></th>
    </thead>   
    <tbody>

<?php

foreach ($user->resume->diplomas as $key => $diplome) {   
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
    
    echo("<td>"); ?>

            
    <?= anchor("main/edit/formations/$diplome->user_form_id", '<i class="icon-edit"></i> Modifier', 'role="button" class="btn edit"'); ?>&nbsp;
    <?= anchor("main/del/formations/$diplome->user_form_id",'<i class="icon-trash icon-white"></i>', 'class="btn btn-danger confirm"'); ?>
    <?php echo("</td></tr>");
}
?>     
    </tbody>  
</table>
<?php echo anchor('#addDiplome','<i class="icon-plus icon-white"></i> Ajouter un diplôme', 'role="button" class="btn btn-pink" data-toggle="modal"'); ?>


<br /><br />
<br /><br />

<p class='lead'>Expériences pro</p>

<table class='table table-bordered table-hover'>
    <thead>
        <th>Période</th>
        <th>Entreprise</th>
        <th>Type d'établissement</th>
        <th>Poste occupé</th>
        <th></th>
    </thead>   
    <tbody>

<?php

foreach ($user->resume->xppro as $key => $xp) {   
    echo("<tr><td>de $xp->month_start/$xp->year_start à $xp->month_end/$xp->year_end</td>");
    echo("<td>$xp->etablissement</td><td>$xp->type_name</td><td>$xp->poste_name</td>");  
    
    echo("<td>"); ?>

      
    <?= anchor("main/edit/expepro/$xp->user_xp_id",'<i class="icon-edit"></i> Modifier', 'class="btn edit"');?>&nbsp;
    
    <?= anchor("main/del/expepro/$xp->user_xp_id",'<i class="icon-trash icon-white"></i>', 'class="btn btn-danger confirm"'); ?>

    <?php echo("</td></tr>");
}
?>     
    </tbody>  
</table>
<?php echo anchor('#addXp','<i class="icon-plus icon-white"></i> Ajouter une expérience', 'role="button" class="btn btn-pink" data-toggle="modal"'); ?>
