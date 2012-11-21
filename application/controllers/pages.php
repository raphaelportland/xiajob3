<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur des pages "statiques"
 * 
 * 
 */
class Pages extends CI_Controller
{
    
    function coming_soon() {
        $data['view'] = 'common/coming_soon';
        $this->load->view('common/templates/main',$data);
    }    
    
}