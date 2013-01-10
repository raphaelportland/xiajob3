<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 * 
 */  
class Migration_Remove_profile_from_user_data extends CI_Migration {
    
    function up() {
        
        // on récupère tous les profils        
        $q = $this->db->get('user_data');
        $old_data = $q->result();
        
        code($old_data);
        
        $new_data = array();
        
        foreach ($old_data as $key => $user) {
            
            if($user->profile == 'candidat') { $profile = 'perso'; }
            else { $profile = $user->profile; }
            
            // on prépare le batch
            $new_data[] = array(
                'user_id' => $user->user_id,
                'option' => 'profile',
                'value' => $profile,
            ); 
        }
        
        code($new_data);  
        
        // on importe tous les profils dans les options
        $this->db->insert_batch('user_options', $new_data);
        
        // on drop la colonne profil de la table user_data
        $this->dbforge->drop_column('user_data', 'profile');
        
    }
    
    function down(){
        // si besoin voir controleur temp (test_mig_8) : code pour migration inverse
    }
}