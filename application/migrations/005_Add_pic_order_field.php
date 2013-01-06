<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Ajoute une colonne ordre aux images
 * 
 */  
class Migration_Add_pic_order_field extends CI_Migration {
    
    function up() {
        // ajoute la colonne "order" aux book_pics
             
        $field = array(
        
            'order' => array(
                'type' => 'INT',
                'constraint' => '11',
                ),
        );
        
        $this->dbforge->add_column('book_pics', $field);        
    }
    
    
    function down() {
        // retire la colonne "order"
        $this->dbforge->drop_column('book_pics', 'order');
        
    }
    
}