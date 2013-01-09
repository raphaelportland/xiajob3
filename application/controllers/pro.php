<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Professionnels
 * 
 * 
 */
class Pro extends CI_Controller
{
    /**
     * Page d'accueil pro
     */
    function index() {
        
        $data['view'] = 'pro/home';
        $this->load->view('common/templates/main-fixed',$data);
        
    }
    
    
}