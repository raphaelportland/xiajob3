<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur de recherche
 * 
 * 
 */
class Pic_search extends CI_Controller
{
    function reset_search() {
        $this->session->unset_userdata('search_elements');
        
        redirect('book');
    }
    
    
    
    function add_flowers(){
        
        if(($this->input->post('flower')) && ($this->input->post('flower') != '')) {
            $new_flower = $this->input->post('flower');
            
            
            if($this->session->userdata('search_elements')) {
                
                $search_elements = unserialize($this->session->userdata('search_elements'));
            }
                $search_elements['flowers'][] = $new_flower;               
                $this->session->set_userdata('search_elements', serialize($search_elements));

        }
        
        redirect('book');
        
        
    }
    
    /**
     * Retire la fleur de la recherche
     *
     * @param string $flower urlencoded
     * @return none
     */
    function remove_flower($flower) {              
              
        $flower = urldecode($flower);
        
        if($this->session->userdata('search_elements')) {                
            $search_elements = unserialize($this->session->userdata('search_elements'));
            
            if(isset($search_elements['flowers'])) {
                foreach ($search_elements['flowers'] as $key => $added_flower) {
                    if($added_flower == $flower) {
                        unset($search_elements['flowers'][$key]);
                    }
                }
                $this->session->set_userdata('search_elements', serialize($search_elements));                
            }
        }              
        redirect('book');
    }
    
    
    
    /**
     * Execute la recherche
     * 
     */
    function search($range = null) {
        if(!$this->session->userdata('search_elements')) {
            redirect('book');
        }
        
        $search_elements = unserialize($this->session->userdata('search_elements'));
          
        $pictures = array();
        
        if(isset($search_elements['flowers'])) {
            
            // on récupère l'id des photos
            $this->load->model('search_model');
            $pictures['flowers'] = $this->search_model->search_pic_by_flowers($search_elements['flowers']);            
            
            $this->load->model('liste');
            $data['fleurs'] = $this->liste->flowers();
            
            
            $data['pictures'] = $pictures;
            $data['view'] = 'common/search_result';
            $this->load->view('common/templates/main-fixed', $data);
        }
        
        
        
    }
    
    
}