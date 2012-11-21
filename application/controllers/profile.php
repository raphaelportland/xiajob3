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
             
            $this->load->model('candidat');
            $data = $this->candidat->get_candidat($user_id);
            
            $this->load->model('liste');
            $data->comp_list = $this->liste->competences();  
            $data->comp_rating = $this->liste->comp_rating(); 

            
            $this->load->model('books');
            $this->books->set_owner($user_id);
            $data->books = $this->books->all_books();       
            $data->occasions = $this->liste->occasions();  
                    
        else :
            
            $data = "aucune données";   
          
            
        endif;
        
        //code($data);

        $this->load->view('candidat/profile/public-profile',$data);
        
    }
   
    
    
}