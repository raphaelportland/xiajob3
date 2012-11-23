<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Met en place la liste définitive des fleurs
 * 
 */  
class Migration_Add_cgu extends CI_Migration {
    
    function up() {
        // ajoute la colonne "optin_cgu" aux books
             
        $field = array(
        
            'optin_cgu' => array(
                'type' => 'BOOL',
                'default' => 0,
                ),
        );
        
        $this->dbforge->add_column('user_data', $field);        
    }
}