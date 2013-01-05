<?php 

if(isset($official)) :
    $official_count = count($official) - 1;
    foreach($official as $key => $flower) :
        echo $flower->name_fr;
        if($key < $official_count) echo ', ';
    endforeach; 
endif;

if(isset($custom)) :
    if(isset($official)) echo ", ";
    $custom_count = count($custom) - 1;
    foreach($custom as $key => $flower) :
        echo $flower->custom_name;
        if($key < $custom_count) echo ', ';
    endforeach; 
endif;

?>