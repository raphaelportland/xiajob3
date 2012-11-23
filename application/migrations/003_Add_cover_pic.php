<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Met en place la liste définitive des fleurs
 * 
 */  
class Migration_Add_cover_pic extends CI_Migration {
    
    function up() {
        // ajoute la colonne "cover_pic" aux books
             
        $field = array(
        
            'cover_pic' => array(
                'type' => 'INT',
                'constraint' => '11',
                ),
        );
        
        $this->dbforge->add_column('user_book', $field);        
    }
    
    
    function down() {
        // retire la colonne "cover_pic"
        $this->dbforge->drop_column('user_book', 'cover_pic');
        
    }
    
}