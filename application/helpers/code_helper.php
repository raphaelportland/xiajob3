<?php 
function style(){
    echo("
    <style>
    
.code_helper {
    background: #faf8f0;
    display: block;
    padding: 0.5em 1em;
    border: 1px solid #bebab0;  
}      
    </style>
    ");
    
    
}



function code($var) {
    style();
    echo('<pre class="code_helper">');
       
    if(is_array($var) || is_object($var)) {
        print_r($var);
    }
    
    else {
        echo($var);
    }  
      
    echo('</pre>');
}


function stop_code($var) {
    code($var);
    die;
}


?>