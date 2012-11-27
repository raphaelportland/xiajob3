<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur des pages "statiques"
 * 
 * 
 */
class Pages extends CI_Controller
{
    
    function coming_soon() {
        $data['view'] = 'common/pages/coming_soon';
        $this->load->view('common/templates/main-fixed',$data);
    }
    
    
    function cgu() {
        $data['view'] = 'common/pages/cgu';
        $this->load->view('common/templates/main-fixed',$data);
    }
    
    
    function hints() {
        $data['view'] = 'common/pages/florbooks-hints';
        $this->load->view('common/templates/main-fixed', $data);
    }
    
    function oups() {
        $data['view'] = 'common/pages/404';
        $this->load->view('common/templates/main-fixed', $data); 
    }
    
    function meet_the_gnomes() {
        $data['view'] = 'common/pages/who_we_are';
        $this->load->view('common/templates/main', $data);
    }
    
}