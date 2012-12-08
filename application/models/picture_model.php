<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Picture_model
 * 
 * Définition des photos utilisées dans les books
 * tables : 
 * book_pics
 * 
 * @package florBooks
 * @subpackage models
 * @author Raphaël Malaizé
 * 
 */
class Picture_model extends CI_Model {
    
    
    
    
    /**
     * Renvoie les photos enregistrées dans le book
     * 
     * @param int $book_id
     * @param array $params
     * 
     * @return object
     * 
     */
    function get_pics($book_id, $params = null) {
       $q = $this->db    
            ->where('book_id',$book_id)
            ->get('book_pics');
            
       
       if($q->num_rows() > 0) {
           $pics = $q->result();
           
       } else {
           return false;           
       }
       
       foreach ($pics as $key => $pic) {

           // on ajoute les fleurs si nécessaire
           if(isset($params['with_flowers'])) {
               $this->load->model('books');
               $pics[$key]->flower_data = $this->books->get_pic_flowers($pic->id);
           }
           
           // on ajoute les commentaires si nécessaire     
           if(isset($params['with_comments'])) {              
               $this->load->model('comments_model');
               $pics[$key]->comments = $this->comments_model->get_pic_comments($pic->id);
           }
       }
       return $pics;
    }
    
        
    
}