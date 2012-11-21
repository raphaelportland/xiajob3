<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Social_model extends CI_Model {
    
    /**
     * Ajoute le favori à l'utilisateur
     * Renvoie un code selon la réussite
     * @param array
     * @return int
     */
    function add_fav($data) {
        
        $is_fav = $this->is_fav($data);
        
        if(!$is_fav) {
            
            if($this->db->insert('user_fav', $data)) {
                return "1"; // success
            } else {
                return "3"; // error code
            }
        } else {
            return "2"; // already in favs
        } 
        
        return('nothing');   
    }
    
    /**
     * Regarde si le book est déjà dans les favoris
     * de l'utilisateur
     * @param array
     * @return bool
     */
    function is_fav($data) {
        $q = $this->db
        ->select('id')
        ->from('user_fav')
        ->where('user_id', $data['user_id'])
        ->where('book_id', $data['book_id'])
        ->get();
        
        if($q->num_rows() == '1') return true;
        return false;
    }
    
    /**
     * Renvoie la liste des id des books
     * mis en favori par l'utilisateur
     * @param int
     * @param object
     */
    function get_user_favs($user_id) {
        $q = $this->db->where('user_id', $user_id)
        ->select('book_id')->get('user_fav');
        
        if($q->num_rows() > 0) {
            $favs = $q->result();
            return $favs;
        } else {
            return false;
        }
    }
    
    
    /**
     * Supprime un book favori
     * @param array
     * @return bool
     */
    function del_fav($data) {
        
        if($this->is_fav($data)) { // on vérifie que le book est bien dans les favoris de la personne
            
            $this->db
            ->where('user_id', $data['user_id'])
            ->where('book_id', $data['book_id'])
            ->delete('user_fav');
            
            return true;
            
        } else {
            
            return false;
        }
    }
    
}