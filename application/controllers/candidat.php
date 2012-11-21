<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Candidat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        
        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/');
        }
    }  
    
    
    
    function index() {
        echo 'success';
    }
              
}
    