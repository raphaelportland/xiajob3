<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Table contenant les annonces emploi + table d'expérience
 * 
 */  
class Migration_Add_abusive_comment_table extends CI_Migration {
    
    function up() {
        
        /*
         * Table abusive_comment 
         * 
         */
        
     
        $this->dbforge->add_field('absuive_id');        
        
        $this->dbforge->create_table('abusive_comment'); 
        
    
        $fields = array(
            
          
            'absuive_category_id' => array(
                'type' => 'INT',
                'constraint' => 10,
                ),
                
            
            'bookId' => array(
                'type' => 'INT',
                'constraint' => '10',            
            ),
            
            
            'absuive_comment' => array(
                'type' => 'varchar',
                'constraint' => '255',            
            ),            
            
        );
        
        $this->dbforge->add_column('abusive_comment', $fields);  
           
        
    }
    
    
    function down() {
        
        $this->dbforge->drop_table('abusive_comment');
        
    }
}    