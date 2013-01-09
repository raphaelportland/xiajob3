<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * 
 */  
class Migration_Add_optin_table extends CI_Migration {
    
    function up() {
        
        // ajout du id
        $this->dbforge->add_field('id');
        
        $this->dbforge->create_table('opt_in');        
        
        // ajout du champ user_id
        $field1 = array(
        
            'user_id' => array(
                'type' => 'INT',
                'default' => 11,
                ),
        );
        
        $this->dbforge->add_column('opt_in', $field1);         
        
        
        // ajout du champ optin_cgu
        $field2 = array(
        
            'optin_cgu' => array(
                'type' => 'BOOL',
                'default' => 0,
                ),
        );
        
        $this->dbforge->add_column('opt_in', $field2);   
        
        
        // enfin on retire la colonne optin_cgu de la table utilisateurs
        $this->dbforge->drop_column('user_data', 'optin_cgu');
        
        
    }
    
    function down(){
        
        $this->dbforge->drop_table('opt_in');
        
    }
}