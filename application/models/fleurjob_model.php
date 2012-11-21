<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fleurjob_model extends CI_Model {


    
    function select_expe() {
        
        $q = $this->db->get('postes');
        
        $postes = array();
        
        foreach ($q->result() as $key => $data) {
            
            $postes[$data->poste_id] = $data->poste;         
        }      

        $q = $this->db->get('type_etablissement');
        
        $type_etab = array();
        
        foreach ($q->result() as $key => $data) {
            
            $type_etab[$data->id] = $data->type_etab;         
        }
        
        $result['postes'] = $postes;
        $result['type_etab'] = $type_etab;      

        
        return $result;         
    }


    
    /**
     * Enregistre les options en base de données
     * Attention, il s'agit d'un insert, ce n'est pas adapté pour un update.
     * 
     * 
     */
    function register_options($user_id, $data) {
        
        $options = array();
        
        $i = 0;
        
        foreach ($data as $option => $value) {
            $options[$i]['user_id'] = $user_id;
            $options[$i]['option'] = $option;
            $options[$i]['value'] = $value;
            $i++;
        }
        
        $this->db->insert_batch('user_options',$options);
        
    }
    
    /**
     * Crée le profil en base de donnée (attention ce n'est pas un update mais un insert)
     * 
     */
    function set_profile_type($user_id, $type) {
        
        $data = array(
            'user_id' => $user_id,
            'option' => 'profile_type',
            'value' => $type,        
        );
        
        $this->db->insert('user_options',$data);
        
    }
    
    /**
     * Récupère le type de profil de l'utilisateur et le renvoie
     * candidat / recruteur
     * 
     */
    function get_user_profile_type($user_id) {
        $q = $this->db
            ->select('value')
            ->where('user_id',$user_id)
            ->where('option','profile_type')
            ->limit(1)
            ->get('user_options');
            
        $result = $q->result_array();
        
        $profile_type = $result[0]['value'];
        
        return $profile_type;
    }
    
    /**
     * Fixe l'étape de remplissage du profil
     * Crée un enregistrement pour l'étape 1
     * fait un update dans les autres cas
     * 
     * 
     */
    function set_profile_step($user_id, $step) {
        
        $data['user_id'] = $user_id;
        $data['option'] = 'profile_step';
        $data['value'] = $step;
        
        if($step == 1) {
            $this->db->insert('user_options',$data);
        }
        
        else {
            
            $this->db
                ->where('user_id',$user_id)
                ->where('option','profile_step')
                ->update('user_options',$data);   
        }        
        
    }

    /**
     * Récupère l'étape de remplissage du profil de l'utilisateur
     * 
     * 
     */
    function get_user_profile_step($user_id) {
        $q = $this->db
            ->select('value')
            ->where('user_id',$user_id)
            ->where('option','profile_step')
            ->limit(1)
            ->get('user_options');
            
        $result = $q->result_array();
        
        $step = $result[0]['value'];
        
        return $step;
    }
    


    
    /**
     * Enregistre les compétences
     * les compétences principales dans user_autoevaluation
     * les cases à cocher dans les options
     * l'informatique dans comp spécifiques
     * 
     */
    function record_comp($user_id, $data) {
        
        unset($data['register']);

        // enregistrement de la description
        
        $desc = array(
            'user_id' => $user_id,
            'description' => $data['description'],
        );

        //$this->db->insert('user_description',$desc);  
        
        unset($data['description']);
                
        
        // récupère toutes les compétences        
        $competences = array();
        
        $i = 1;
        while(isset($data[$i])) {
            
            $comp = array(
                'user_id' => $user_id,
                'competence' => $i,
                'score' => $data[$i],
            );
            
            $competences[] = $comp;
            unset($data[$i]);
            $i++;
        }
        
        //$this->db->insert_batch('user_autoevaluation', $competences);
        
        
        // enregistrement des compétences diverses
        
        // d'abord l'éventuel logiciel
        
        if($data['informatique'] != '') {
            
            $info = array(
                'user_id' => $user_id,
                'custom_comp_type' => 1, // index de l'informatique dans les custom_comp_types
                'comp_name' => $data['informatique'],
            );
            
            //$this->db->insert('user_custom_comp',$info);            
                       
        } 
        
        unset($data['informatique']);
        
        // ensuite tout ce qui reste doit être placé dans les options
        // avec faux si absent

        if(isset($data['libre-service'])) { $data['libre-service'] = 1; } else { $data['libre-service'] = 0; }
        if(isset($data['even'])) { $data['even'] = 1; } else { $data['even'] = 0; }
        if(isset($data['design'])) { $data['design'] = 1; } else { $data['design'] = 0; }
        if(isset($data['tradi'])) { $data['tradi'] = 1; } else { $data['tradi'] = 0; }
        if(isset($data['pieton'])) { $data['pieton'] = 1; } else { $data['pieton'] = 0; }
        if(isset($data['permis-b'])) { $data['permis-b'] = 1; } else { $data['permis-b'] = 0; }
        if(isset($data['permis-c'])) { $data['permis-c'] = 1; } else { $data['permis-c'] = 0; }
        if(isset($data['word'])) { $data['word'] = 1; } else { $data['word'] = 0; }
        if(isset($data['excel'])) { $data['excel'] = 1; } else { $data['excel'] = 0; }

        $options = array();

        foreach ($data as $key => $value) {
            $option = array(
                'user_id' => $user_id,
                'option' => $key,
                'value' => $value,
            );
            $options[] = $option;
        }

        //$this->db->insert_batch('user_options',$options);        
        
    }



    



    /**
     * Récupère et renvoie toutes les infos sur l'utilisateur
     * 
     * 
     */
    function get_all_user_data($user_id) {
            
        $data['recomp'] = $this->get_user_recompenses($user_id);
        $data['diplomes'] = $this->get_user_diplomes($user_id);
        $data['xppro'] = $this->get_user_xppro($user_id);
        
        
        //stop_code($data);

        
        return $data;
        
    }
    
    /**
     * Mise à jour des données utilisateur
     */
    function update_user_data($rubrique, $data) {
        
        $user_id = $this->tank_auth->get_user_id();        
        
        switch($rubrique) {
            case '0' :
                unset($data['register']);
                
                $options = array();
                
                $errors = 0;
                
                foreach ($data as $option => $value) {
                    
                    $opt = array(
                        'user_id' => $user_id,
                        'option' => $option,
                        'value' => $value,
                    );
                    
                    if(!$this->db
                        ->where('user_id',$user_id)
                        ->where('option',$option)
                        ->update('user_options',$opt)) {
                        
                    $errors ++;    
                    }
                }   
                    
                if($errors == 0) : $flashmessage = "Votre profil a bien été mis à jour <i class='icon-ok'></i>";            
                else : $flashmessage = "Il y a eu $errors erreurs pendant la mise à jour";
                endif;
                
                $this->session->set_flashdata('message', $flashmessage);                  
                break;
        }       
        
    }

    
}
?>