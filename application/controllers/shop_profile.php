<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Profil boutique
 * 
 * 
 */
class Shop_profile extends CI_Controller
{
    
    
    function create() {
        
        if(!$this->session->userdata('user_id')) { // réservé aux utilisateurs connectés
            redirect('main');
        }
        
        $data['view'] = 'shop_profile/create';
        $this->load->view('common/templates/main-fixed', $data);
        
    }
    
    
    function view($shop_id) {
        
        $data['view'] = 'shop_profile/public_profile';
        $this->load->view('common/templates/main-fixed', $data);
        
    }
    
    
    
}