<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Table contenant les annonces emploi + table d'expérience
 * 
 */  
class Migration_Add_abusive_word_table extends CI_Migration {
    
    function up() {
        
        /*
         * Table abusive_word 
         * 
         */
        
     
        $this->dbforge->add_field('ID');        
        
        $this->dbforge->create_table('abusive_word'); 
        
    
        $fields = array(
            
            
            'abusive_word' => array(
                'type' => 'varchar',
                'constraint' => '255',            
            ),            
            
        );
        
        $this->dbforge->add_column('abusive_word', $fields);  
           
        
    }
    
    
    function down() {
        
        $this->dbforge->drop_table('abusive_word');
        
    }
}    