<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Classe admin
 * Pour les fonctionnalités d'administration
 * 
 * @package florBooks
 * @subpackage models
 * @author Raphaël Malaizé
 */
class Admin_model extends CI_Model {
    
    /**
     * Retire le book de la liste des books mis à la une
     * 
     */
    function delete_featured_book($book_id) {
       
       $this->db->where('book_id', $book_id)->delete('featured_books');
        
    }
    
    /**
     * Ajoute un book à la table des featured_books
     */
    function add_featured_book($book_id) {
        
        $this->db->insert('featured_books', array('book_id' => $book_id));
    }
    
    /**
     * Renvoie la liste des administrateurs avec les infos
     */
    function get_admin_list() {
        
        $q = $this->db->select('user_id')
        ->where('option','is_admin')->where('value',1)
        ->group_by('user_id')
        ->get('user_options');
        
        if($q->num_rows() > 0) {
            
            $this->load->model('user');
            $admin_list = array();
            
            $params = array();
            
            foreach ($q->result() as $key => $user) {
                $params['user_id'] = $user->user_id;
                $admin_list[$user->user_id] = $this->user->get_user($params);
            }
            //code($admin_list);
            return $admin_list;
        } else {
            return false;
        }                
    }
    
    /**
     * Ajoute un administrateur
     */
    function add_admin($id) {
        $this->db->insert('user_options', array('user_id' => $id, 'option' => 'is_admin', 'value' => 1));        
    }
    
    
    /**
     * Supprime un administrateur
     */
    function del_admin($id) {
        $this->db->where('user_id', $id)->where('option','is_admin')->where('value',1)->delete('user_options');
    }
    
    
}