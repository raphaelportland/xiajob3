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
    function job_ad($step = 0) {
        
        $rubrique = array(
            'name' => 'Annonce emploi',
            'folder' => 'job',
        );
        
        $data['rubrique'] = $rubrique;
        $data['step'] = $step;
        $data['view'] = 'ads/ad_template';    
        
        
        if($this->input->post('submit0')) { // formulaire étape 1
            
            // ici traitement du formulaire
            
            $data['step'] = 1;
        }        
        
             
        
        if($this->input->post('submit1')) { // formulaire étape 1
            
            // ici traitement du formulaire
            
            $data['step'] = 2;
        }
        
        
        
        $this->load->view('common/templates/main-fixed', $data);
        
    }
    
    
    
}