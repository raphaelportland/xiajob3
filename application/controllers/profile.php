<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur des profils publics
 * 
 * 
 */
class Profile extends CI_Controller
{
    
    function index() {
        
    }
    
    function view($user_id) {
        
        $this->load->model('generic_user');
        $this->generic_user->set_id($user_id);
        
        if($this->generic_user->profile() == 'candidat') :
            
            $params = array(
            'with_resume' => true,
            'with_skills' => true,
            'with_diplomas' => true,
            'with_xppro' => true,
            'with_options' => true,
            'with_address' => true,
            'with_books' => true,
            'books_params' => array(
                'user_id' => $user_id,
                'with_covers' => true,
                'with_occasions' => true,
                'with_fav_count' => true,
                ),
            );
            
            $data['user'] = $this->generic_user->get_user($params);
            
            
            /* 
            $this->load->model('candidat');
            $data = $this->candidat->get_candidat($user_id);
            
            $this->load->model('liste');
            $data->comp_list = $this->liste->competences();  
            $data->comp_rating = $this->liste->comp_rating(); 

            
            $this->load->model('books');
            $this->books->set_owner($user_id);
            $data->books = $this->books->all_books();       
            $data->occasions = $this->liste->occasions();  
             *
             */
                    
        else :
            
            $data = "aucune données";   
          
            
        endif;
        
        //code($data);
        
        $data['view'] = 'candidat/profile/public-profile';

        $this->load->view('common/templates/main-fixed',$data);
        
    }
   
    
    
}