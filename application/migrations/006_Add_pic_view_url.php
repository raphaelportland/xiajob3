<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Ajoute un champ 'view url' pour stocker les adresses bitly des images
 * 
 */  
class Migration_Add_pic_view_url extends CI_Migration {
    
    function up() {
        // ajoute la colonne aux book_pics
             
        $field = array(
        
            'view_url' => array(
                'type' => 'varchar',
                'constraint' => '255',
                ),
        );
        
        $this->dbforge->add_column('book_pics', $field);        
    }
    
    
    function down() {
        // retire la colonne
        $this->dbforge->drop_column('book_pics', 'view_url');
        
    }
    
}