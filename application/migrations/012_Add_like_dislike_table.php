<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *  Table contenant les annonces emploi + table d'expérience
 * 
 */  
class Migration_Add_like_dislike_table extends CI_Migration {
    
    function up() {
        
        /*
         * Table like_dislike 
         * 
         */
        
  
        $fields = array(
            
    		 'id' => array(
                'type' => 'INT',
                'constraint' => 11,  
                'auto_increment' => TRUE				
            ),   
			
            
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 10,            
            ),   

             'book_id' => array(
                'type' => 'INT',
                'constraint' => 10,            
            ),  

             'status' => array(
                'type' => 'tinyint',
                'constraint' => 2,            
            ),  			
            
        );
        
       	$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('like_dislike'); 
           
        
    }
    
    
    function down() {
        
        $this->dbforge->drop_table('like_dislike');
        
    }
}    
