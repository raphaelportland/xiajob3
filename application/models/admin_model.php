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
    
    
    
}