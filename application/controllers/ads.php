<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Annonces
 * 
 * 
 */
class Ads extends CI_Controller
{
    /**
     * Page d'accueil des annonces
     */
    function index() {
        
        redirect('ads/first_step');
        
    }
    
    
    /**
     * Première étape de la création d'annonce
     */
    function first_step() {
        
        $data['view'] = 'ads/first_step';
        $this->load->view('common/templates/main-fixed', $data);
        
    }
    
    
    /**
     * Création d'annonce emploi
     * 
     */
    function job_ad() {
        
        
        
    }
    
    
    
}