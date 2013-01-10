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
            ->order_by('order','asc')
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
    
    /**
     * Récupère une photo et les paramètres associés
     * (fleurs, commentaires...)
     * @param int $pic_id
     * @param array $params
     * @return object
     */
    function get_pic($pic_id, $params = null) {
        
        if(isset($params)) {
            extract($params);
        }
        
        $data = new stdClass();
        
        // les infos sur la photo
        $this->db
        ->select('*')
        ->from('book_pics')
        ->where('book_pics.id', $pic_id);
        
        $q = $this->db->get();
        $data->picture = $q->row();
        
        
        // les infos sur le book
        if(isset($with_book_info)) :
            
            $q = $this->db->where('id',$data->picture->book_id)->get('user_book');
            $data->book = $q->row();
            
            // les informations sur le propriétaire
            if(isset($with_owner)) {
               $user_params = array(
               'user_id' => $data->book->user_id,
               );
               
               $this->load->model('user');
               $data->owner = $this->user->get_user_basic_infos($user_params);
            }  
            
        endif;
        
       // on ajoute les fleurs si nécessaire
       if(isset($with_flowers)) {
           $this->load->model('books');
           $data->flower_data = $this->books->get_pic_flowers($pic_id);
       }
       
       // on ajoute les commentaires si nécessaire     
       if(isset($with_comments)) {
           $this->load->model('comments_model');
           $data->comments = $this->comments_model->get_pic_comments($pic_id);
       }
        
        return $data;
        
    }

    // renvoie l'url raccourcie de visionnage de la photo
    function get_pic_view_url($book_id, $pic_id) {
        // url avec bitly
        $this->load->library('bitly');            
        $pic_url = $this->bitly->shorten(site_url('book/show/'.$book_id.'/picture/'.$pic_id)); 
             
        return $pic_url;
    }
    
    
    
    
    
        
    
}