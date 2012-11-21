<?php

function test_option($userdata, $option) {
    
    if(isset($userdata->options->$option) && ($userdata->options->$option == 1)) : return true;
    else: return false; 
    endif;
}

function test_comp($score, $i) {
    
    if(isset($score) && ($score == $i)) : return true;
    else : return false;
    endif;               
}

?>
