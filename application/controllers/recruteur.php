<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur de la partie "recruteur" du site
 * 
 * 
 * 
 */
class Recruteur extends CI_Controller
{
    
    /**
     * Accueil du site recruteur
     * 
     */
    function index() {  
        if (!$this->tank_auth->is_logged_in()) {  // si l'utilisateur n'est pas loggué                   
            $data['view'] = 'recruteur/home';
            $this->load->view('recruteur/templates/public',$data);                               
        } else {
     
            $this->load->model('generic_user');
            $profile = $this->generic_user->profile();
            
            if($profile == 'candidat') : redirect('fleurjob/welcome');
            else : redirect('recruteur/welcome');
            endif;               
        }        
    }



    /**
     * Tableau de bord
     * 
     */
    function welcome() {
        $this->load->model('generic_user');
        $this->generic_user->login_test('recruteur'); 
 
        $data['options'] = $this->generic_user->all_options();
        
        $data['view'] = "recruteur/dashboard";
        $this->load->view("recruteur/templates/private",$data);
    }
        
}