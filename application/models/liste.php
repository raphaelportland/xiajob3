<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  
 *  Permet de récupérer les listes de l'applications
 *  et éventuellement les mettre en cache 
 * 
 */
class Liste extends CI_Model {
    
    
    /**
     * Renvoie la liste des compétences
     *
     */
    function competences() {      
        $q = $this->db->get('competences');        
        return $q->result();              
    }
    
    
    
    /**
     * Renvoie la liste des fleurs
     */
    function flowers($lang = 'fr') {
        
        $this->db->cache_on();
        $q = $this->db->select('name_'.$lang)->get('fleurs');
        
        $result = $q->result();
        
        //code($result);
        
        $fleur_list = "";
        
        foreach ($result as $key => $fleur) {
            
            $name = 'name_'.$lang;
            
            $fleur_list .= '&quot;'.$fleur->$name . '&quot;';
            
            if($key != $q->num_rows() - 1) :
                $fleur_list .= ', ';
            endif; 
        }
        
        $this->db->cache_off();
        
        return $fleur_list;
       
    }




    
    /**
     * Renvoie la liste des récompenses
     * avec l'index numérique et le nom
     * 
     */
    function recompenses() {
        $q = $this->db->get('recompenses');
               
        foreach ($q->result() as $key => $data) {          
            $result[$data->id] = $data->name;         
        }                            
        return $result;
    }




    
    /**
     * Renvoie la liste des école
     * avec l'index numérique et le nom
     * 
     */
    function formations() {
        $q = $this->db->get('formations');
              
        foreach ($q->result() as $key => $data) {          
            $result[$data->formation_id] = $data->nom;         
        }        
        return $result;
    }




    
    /**
     * Renvoie la liste des diplome
     * avec l'index numérique et le nom
     * 
     */
    function diplomes() {
        $q = $this->db->get('diplomes');
        
        foreach ($q->result() as $key => $data) {
            $result[$data->diplome_id] = $data->diplome; 
        }      
        return $result;         
    }






    
    /**
     * Renvoie la liste des mois 
     * avec leur index numérique et leur nom
     * 
     */
    function months() {
        $q = $this->db->get('months');       
        
        foreach ($q->result() as $key => $data) {            
            $months[$data->id] = $data->month;         
        }                 
        return $months;          
    }
  
  
  
  
    
    
    
    /**
     * Renvoie la liste des types de poste
     * avec l'index numérique et le nom
     * 
     */
    function postes() {
        $q = $this->db->get('postes');
        
        foreach ($q->result() as $key => $data) {            
            $postes[$data->poste_id] = $data->poste;         
        }
        
        return $postes;
    } 
    







    /**
     * Renvoie la liste des occasions
     * avec l'index numérique et le nom
     * 
     */
    function occasions() {
        $q = $this->db->get('occasions');
        
        foreach ($q->result() as $key => $data) {            
            $liste[$data->id] = $data->occasion_name;         
        }
     
        return $liste;
    } 

    
    
    
    
  
  
   
    
    /**
     * Renvoie la liste des types d'établissement
     * avec index numérique et nom
     * 
     */
    function types_etablissement() {
        $q = $this->db->get('type_etablissement');
        
        foreach ($q->result() as $key => $data) {            
            $type_etab[$data->id] = $data->type_etab;         
        }

        return $type_etab;
    }    
    
    
    
    
    /**
     * Renvoie la liste des degrés de compétence en fonction du score
     * 
     */
    function comp_rating() {
        $rating[1] = 'Aucune';
        $rating[2] = 'Débutant';
        $rating[3] = 'Intermédiaire';
        $rating[4] = 'Confirmé';
        $rating[5] = 'Expert';
        
        return $rating;
    } 
    
    
    
    
    
    
    
}
    