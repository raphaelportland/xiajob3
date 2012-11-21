<?php
/**
 * Création de chevrons avec mise en couleur selon l'état : en cours ou réussi
 */
 
function chevron($title,$message,$step_order,$current_step) {
    
    echo("<div id='etape_".$step_order."' class='etape span2 btn ");   
    
    if($step_order == $current_step) {
        echo 'btn-warning';
    } elseif($step_order < $current_step) {
        echo 'btn-success';
    } elseif($current_step == 'waiting') {
        if($step_order == 1) { echo 'btn-success'; }
        else { echo('disabled'); }
    }

    echo("'><strong>".$title."</strong><p>".$message."</p></div>");    
        
}
