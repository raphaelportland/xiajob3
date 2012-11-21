<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comments_model extends CI_Model {


    /**
     * L'id de l'auteur du commentaire
     */
    public $user_id; 
    
    /**
     * Le username de l'auteur du commentaire
     */
    public $username;
    
    /**
     * Le commentaire
     */
    public $comment;
    
    /**
     * Le timestamp du commentaire
     */
    public $created_at;
    
    /**
     * La photo de référence du commentaire
     */
    public $pic_id;
    
    /**
     * L'id du commentaire
     */
    public $comment_id;


    /**
     * Renvoie le commentaire complet ayant l'id indiqué
     */
    function get_comment_by_id($comment_id) {
        
        $q = $this->db->select('*, comments.id as comment_id, user_data.id as ud_id')
        ->from('comments')
        ->join('user_data','user_data.user_id = comments.user_id')
        ->where('comments.id', $comment_id)
        ->get();
        
        if($q->num_rows() > 0) {
            
            $comment = $q->row(); 
            
            $this->comment_id = $comment->comment_id;
            $this->pic_id = $comment->pic_id;
            $this->user_id = $comment->user_id;
            $this->comment = $comment->comment;
            $this->created_at = $comment->created_at;
            
            if($comment->username != '') {
                $this->username = $comment->username;
            } elseif($comment->first_name != '') {
                $this->username = $comment->first_name;
            } else {
                $this->username = "Anonymous";
            }
            
            return $this;
            
        } else {
            return false;
        }
        
    }





    
    /**
     * Enregistrement d'un commentaire
     * 
     */
    function save_comment($data) {
        
        if($data['comment'] != '') {     
            $this->db->insert('comments',$data);       
            //$comment_id = $this->db->insert_id(); 
            return true;           
        } else {
            return false;
        }
    } 
   
    

    /**
     * Récupère les commentaires sur la photo
     * 
     * @param int
     * @param int
     * @return array of objects
     */
    function get_pic_comments($pic_id, $limit = null) {
        
        $this->db
                ->select('*, comments.id as comment_id')
                ->from('comments')
                ->order_by('created_at', "desc");
        
        if(isset($limit)) { 
            $this->db->limit($limit);
        }
                
        $this->db                
                ->join('user_data', 'user_data.user_id = comments.user_id')
                ->where('comments.pic_id', $pic_id);
                
        $q = $this->db->get();
                
        if($q->num_rows() > 0) {
            $comments->nb = $this->get_comment_nb($pic_id);   
            
            foreach ($q->result() as $key => $comment) {
                
                $comment_data = new stdClass();
                
                $comment_data->comment_id = $comment->comment_id;
                $comment_data->pic_id = $comment->pic_id;
                $comment_data->user_id = $comment->user_id;
                $comment_data->comment = $comment->comment;
                $comment_data->created_at = $comment->created_at;
                
                if($comment->username != '') {
                    $comment_data->username = $comment->username;
                } elseif(isset($comment->first_name) &&  $comment->first_name != '') {
                    $comment_data->username = $comment->first_name;
                } else {
                    $comment_data->username = "Anonymous";
                }
                
                $comments->comments[] = $comment_data;                
            }
             
            //$comments->comments = $q->result();          
        } else {
            $comments = new stdClass();
            $comments->comments = null;
        }             
                
        return $comments;
    }


    /**
     * Renvoie le nombre de commentaires associés à l'image
     * @param int
     * @return int 
     */
    function get_comment_nb($pic_id) {
        $q = $this->db->select('id')->where('pic_id',$pic_id)->get('comments');    
        
        //code($q->result());    
        return $q->num_rows();
    }
    
    
    
}