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


    /**
     * Renvoie la liste de tous les utilisateurs
     * 
     */
    function get_all_users() {
        
        $q = $this->db->select('id, banned, ban_reason')->get('users');
        
        if($q->num_rows() > 0) {
            
            $this->load->model('user');
            
            $users = array();
            foreach ($q->result() as $key => $user) {
            
                $params['user_id'] = $user->id;
                $users[$user->id] = $this->user->get_user($params);
                $users[$user->id]->ban_status = $user->banned;
                $users[$user->id]->ban_reason = $user->ban_reason;
            }
            return $users;
        }
        
    }

    /**
     * Suspension d'un compte
     */
    function ban_user($user_id) {
        
        $ban_reason = "Votre compte a été suspendu. Merci de contacter l'équipe.";
        
        $this->db->where('id', $user_id)->update('users', array('banned' => 1, 'ban_reason'  => $ban_reason));
        
        
    }

    /**
     * Réactivation d'un compte
     */
    function unban_user($user_id) {
        
        $this->db->where('id', $user_id)->update('users', array('banned' => 0, 'ban_reason' => null));
        
    }

    function abusive_insert($abusiveWord){
		  $this->db->insert('abusive_word', array('abusive_word'=>$abusiveWord)); 
          return  $this->db->insert_id();  	 
	} 
	
	function abusive_words_list(){
	     $words = new stdClass();
		 $words = $this->db->select('ID, abusive_word')->get('abusive_word ');
        
        return $words->result();
	}
	
	function abusive_comment($abusiveComments){
	      // print_r($abusiveComments);die;
	     $this->db->insert('abusive_comment', array('absuive_category_id'=>$abusiveComments['id'],'bookId'=>$abusiveComments['bookid'],'absuive_comment'=>$abusiveComments['caomment'])); 
         return  $this->db->insert_id();  	 
	}
	
	function abusive_comment_list(){
	     $comments = new stdClass();
		 /*select 
fj_abusive_comment.absuive_id,
fj_abusive_comment.absuive_category_id,
fj_abusive_comment.bookId,fj_abusive_comment.absuive_comment,
fj_abusive_word.abusive_word from fj_abusive_comment LEFT JOIN fj_abusive_word ON fj_abusive_comment.absuive_category_id = fj_abusive_word.ID*/
		 
		 
		 $comments = $this->db->query('select 
fj_abusive_comment.absuive_id,
fj_abusive_comment.absuive_category_id,
fj_abusive_comment.bookId,fj_abusive_comment.absuive_comment,
fj_abusive_word.abusive_word from fj_abusive_comment LEFT JOIN fj_abusive_word ON fj_abusive_comment.absuive_category_id = fj_abusive_word.ID');
		                 
         return $comments->result();
	}
    
}