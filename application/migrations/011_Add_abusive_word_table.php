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
    
        $fields = array(
            
            
    		 'ID' => array(
                'type' => 'INT',
                'constraint' => '10',    
                 'auto_increment' => TRUE				
            ),   
			
			
            'abusive_word' => array(
                'type' => 'varchar',
                'constraint' => '255',            
            ),            
            
        );
        
       
        $this->dbforge->add_field($fields);
		$this->dbforge->add_key('ID', TRUE);
		$this->dbforge->create_table('abusive_word'); 
           
        
    }
    
    
    function down() {
        
        $this->dbforge->drop_table('abusive_word');
        
    }
}    
