<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test_unit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('code');
        $this->display_header();        
    }
    
    function index($user_id = 21, $activated = false) {
        
        $this->test_candidat_model();
        
        $this->test_fleurjob_model($user_id);

        $this->test_users_model($user_id, $activated);

        // ne pas retirer
        $this->display_footer();    
    }
    
    /**
     * Teste le modèle candidat
     * 
     */
     function test_candidat_model() {
         $this->load->model('candidat');
         //$this->candidat->set_id(48);
         $this->title('Candidat');
         
         $this->test('$candidat->full_name()');
         $test = $this->candidat->full_name();
         code($test);
         
         $this->test('profile()');
         $test = $this->candidat->profile();
         code($test);
         
         $this->test('all_comp');
         $test = $this->candidat->all_competences();
         code($test);
     }
    
    
    /**
     * Teste le modèle fleurjob
     */
    function test_fleurjob_model($user_id) {
        $this->load->model('fleurjob_model');
        $this->title('fleurjob_model');
        
        $this->test('get_user_profile_step');       
        $test = $this->fleurjob_model->get_user_profile_step($user_id);
        code($test);
        
        $this->test('select_formations');
        $test = $this->fleurjob_model->select_formations();
        code($test);
        
        $this->test('get_user_options');
        $test = $this->fleurjob_model->get_user_options($user_id);
        code($test);  
        
        $this->test('select_expe');
        $test = $this->fleurjob_model->select_expe();
        code($test);   
    }
    
    
    function test_users_model($user_id, $activated) {
        $this->load->model('users');
        $this->title('users');
        
        $this->test('get_user_by_id');
        $test = $this->users->get_user_by_id($user_id, $activated);
        code($test);
    }
    
    
    
    /**
     * Header
     */
    function display_header() {
        echo("<html>
        <head>
            <meta http-equiv='content-type' content='text/html; charset=utf-8' />
            <title>tests</title>
        </head>
        <body>");        
    }
    
    /**
     * footer
     */
    function display_footer() {
        echo("</body></html>");
    }
    
    /**
     * Affichage du modèle testé
     */
    function title($tested_model) {
        echo("<h2 style='padding: 10px; background: black; color:white; margin: 0 0 10px 0;'>Tests du modèle ".$tested_model."</h2>");
    }
    
    /**
     * Affichage de la fonction testée
     */
    function test($tested_function) {
        echo("<p style='padding: 10px; color: white; background: blue; margin: 0 0 10px 0;'> <strong>f</strong> - ".$tested_function."</p>");
    }
    
}
?>   