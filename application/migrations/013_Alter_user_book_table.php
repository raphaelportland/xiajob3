<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Table contenant les annonces emploi + table d'expérience
 * 
 */  
class Migration_Alter_user_book_table extends CI_Migration {
    
    function up() {
        
        /*
         * Alter Table user_book 
         * 
         */
        
     
	    $fields = array(
                        'status' => array(
						'type' => 'INT',
						'constraint' => 10,
                        'default' => 0,						
						
						)
                     );
                    $this->dbforge->add_column('user_book', $fields);
        
    }
    
    

}    