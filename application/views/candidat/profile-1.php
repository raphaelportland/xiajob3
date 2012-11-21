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

foreach ($userdata->recompenses as $key => $recompense) {   
    echo("<tr><td>$recompense->name</td><td>$recompense->autre_recomp</td><td>$recompense->year_recomp</td>
    <td>"); ?>
    <div class="btn-group">
    <?php //echo anchor("fleurjob/edit_recomp/$recompense->user_recomp_id",'Modifier', 'class="btn btn-mini"');
    echo anchor("fleurjob/edit/recomp/$recompense->user_recomp_id", 'Modifier', 'role="button" class="btn btn-mini edit"');
    echo anchor("fleurjob/del/recomp/$recompense->user_recomp_id",'Supprimer', 'class="btn btn-mini btn-danger confirm"');
?>  </div>  
    <?php echo("</td></tr>");
}
?>     
    </tbody>  
</table>
<?php echo anchor('#addRecomp','Ajouter un prix', 'role="button" class="btn" data-toggle="modal"'); ?>

<br />
<br />

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

foreach ($userdata->diplomes as $key => $diplome) {   
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
    <div class="btn-group">
            
    <?php 
    echo anchor("fleurjob/edit/formations/$diplome->user_form_id", 'Modifier', 'role="button" class="btn btn-mini edit"');
    echo anchor("fleurjob/del/formations/$diplome->user_form_id",'Supprimer', 'class="btn btn-mini btn-danger confirm"'); ?>
    </div>
    <?php echo("</td></tr>");
}
?>     
    </tbody>  
</table>
<?php echo anchor('#addDiplome','Ajouter un diplôme', 'role="button" class="btn" data-toggle="modal"'); ?>


<br />
<br />

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

foreach ($userdata->xppro as $key => $xp) {   
    echo("<tr><td>de $xp->month_start/$xp->year_start à $xp->month_end/$xp->year_end</td>");
    echo("<td>$xp->etablissement</td><td>$xp->type_name</td><td>$xp->poste_name</td>");  
    
    echo("<td>"); ?>
    <div class="btn-group">
        
    <?php echo anchor("fleurjob/edit/expepro/$xp->user_xp_id",'Modifier', 'class="btn btn-mini edit"');
    
    echo anchor("fleurjob/del/expepro/$xp->user_xp_id",'Supprimer', 'class="btn btn-mini btn-danger confirm"'); ?>
    </div>
    <?php echo("</td></tr>");
}
?>     
    </tbody>  
</table>
<?php echo anchor('#addXp','Ajouter une expérience', 'role="button" class="btn" data-toggle="modal"'); ?>
