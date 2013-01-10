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
        
        $this->load->model('user');
        $this->user->set_id($user_id);
        
        if($this->user->profile() == 'perso') :
            
            $params = array(
            'with_resume' => true,
            'with_skills' => true,
            'with_diplomas' => true,
            'with_xppro' => true,
            'with_options' => true,
            'with_address' => true,
            'with_description' => true,
            'with_books' => true,
            'books_params' => array(
                'user_id' => $user_id,
                'with_covers' => true,
                'with_occasions' => true,
                'with_fav_count' => true,
                ),
            );
            
            $data['user'] = $this->user->get_user($params);
            
                    
        else :
            
            $data = "aucune données";   
          
            
        endif;
        
        //code($data);
        
        $data['view'] = 'candidat/profile/public-profile';

        $this->load->view('common/templates/main-fixed',$data);
        
    }
   
    
    
}