<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Classe Search_model
 * 
 * @package florBooks
 * @subpackage models
 * @author Raphaël Malaizé
 */
class Search_model extends CI_Model {
    
    
    /**
     * Renvoie un tableau de photos
     * à partir des noms des fleurs
     * 
     * @param array $flower_array
     */
    function search_pic_by_flowers($flower_array) {
        
        $this->db->select('book_pics.id as pic_id, user_book.short_url as book_url, book_pics.pic_name, book_pics.book_id, book_pics.th_url, fleurs.id as flower_id, fleurs.name_fr')
        ->from('book_pics')
        ->join('pic_flowers', 'pic_flowers.pic_id = book_pics.id')
        ->join('fleurs', 'fleurs.id = pic_flowers.flower_id')
        ->join('user_book', 'user_book.id = book_pics.book_id')
        ->where_in('fleurs.name_fr',$flower_array);
        $q = $this->db->get();
                
        if($q->num_rows() > 0) {
            return $q->result();
        }
        
    }
    
}