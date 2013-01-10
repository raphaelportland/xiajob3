<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur de l'inscription au site
 * 
 * 
 */
class Register extends CI_Controller
{
    
    
    function index() {
        
        if($this->session->userdate('user_id')) { // si l'utilisateur est loggué, on le renvoi à la page d'accueil
            redirect('main');
        } else { // sinon on affiche le formulaire d'inscription
            
            
            
        }
    }
    
    
    /**
     * Enregistrement d'un candidat
     * 
     */
    /*function candidat() {
        $this->load->model('candidat');        
        $this->candidat->login_test('perso'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.     

        $step = $this->candidat->current_register_step();

        switch($step){
            
            case "2" :                
                $this->load->library('form_validation');               
                $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|xss_clean');
                $this->form_validation->set_rules('nom', 'Nom', 'trim|required|xss_clean');
                $this->form_validation->set_rules('dob', 'Date de naissance', 'trim|required|xss_clean');
                
                if ($this->form_validation->run()) {
                    // success                    
                    $this->candidat->record_profile_pro($this->input->post());
                    $this->candidat->upgrade_register_step();
                    
                    redirect('register/candidat');                    
                }
                
                $data['view'] = 'register-profilpro';
                $data['step'] = $step;
                $this->load->view('candidat/templates/registration',$data);                          
              
                break;
                
            case "3" : 
                if ($this->input->post()) {
                    
                    $this->candidat->record_expe($this->input->post());
                    $this->candidat->upgrade_register_step();
                    
                    redirect('register/candidat');                
                }    
                                
                $this->load->model('liste');
                $data['comp_list'] = $this->liste->competences();
                $data['recomp_list'] = $this->liste->recompenses();
                $data['formation_list'] = $this->liste->formations();
                $data['diplome_list'] = $this->liste->diplomes();                                       
                $data['type_etab_list'] = $this->liste->types_etablissement();
                $data['postes_list'] = $this->liste->postes();            
                $data['months'] = $this->liste->months(); 
                
                $data['step'] = $step;
                
                $data['view'] = 'register-xp';
                $this->load->view('candidat/templates/registration',$data);
                break;
                
                                
            case '4' :
                if ($this->input->post()) {
                                     
                    $this->candidat->record_competences($this->input->post());
                    $this->candidat->upgrade_register_step();
                    
                    redirect('register/candidat');
                }
            
                $data['step'] = $step;
                
                $this->load->model('liste');
                $data['competences'] = $this->liste->competences();
                
                $data['view'] = 'register-comp';
                $this->load->view('candidat/templates/registration',$data);                     
                break;
                
            case '5':
            
                $data['step'] = $step;
                
                $data['view'] = 'register-book';
                $this->load->view('candidat/templates/registration',$data);                    
                
                break;    

            case '6':
                if ($this->input->post()) {
                    // si les données sont envoyées                 
                }
            
                $data['step'] = $step;
                
                $data['view'] = 'register-alerts';
                $this->load->view('candidat/templates/registration',$data);                                   
                break; 
                
            case 'finished' :
                // on redirige sur le dashboard
                redirect('main/welcome');
                break;
            
            default : 
                // pas d'étape connue, on renvoie sur la fonction register
                redirect('auth/register/candidat');
                break;           
        }         
    }*/
    
    /**
     * Enregistrement d'un compte pro
     * 
     */
    function pro() {
        $this->load->model('user');
        $this->user->login_test('pro'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.
        
        $step = $this->user->current_register_step();        
        
        switch($step){
            
            case "2" :     
                $this->load->library('form_validation');
                
                $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|xss_clean');
                $this->form_validation->set_rules('nom', 'Nom', 'trim|required|xss_clean');
                $this->form_validation->set_rules('dob', 'Date de naissance', 'trim|required|xss_clean');
                
                if ($this->form_validation->run()) {
                    // success                    
                    $this->recruteur->record_profilpro($this->input->post());
                    $this->user->upgrade_register_step();
                    
                    redirect('register/recruteur');                    
                }
                
                $data['view'] = 'register-boutique';
                $data['step'] = $step;
                $this->load->view('recruteur/templates/registration',$data);                    
                break;
                
            case "3" :
                break;
                
            case "4" :
                break;
                
            case 'finished' :
                // on redirige sur le dashboard
                redirect('pro/welcome');
                break;                
        }
    }
    
    
    
    
    /**
     * Ignore la phase en cours
     * dans le processus d'inscription
     * 
     */   
    function ignore_register() {
        $this->load->model('user');
        $this->user->login_test(); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.     
        
        // obtient la phase en cours via le compte utilisateur       
        $step = $this->user->current_register_step();
        $newstep = $this->user->upgrade_register_step();    
        
        if($newstep == 'finished') : 
        switch($this->user->userdata->profile) {
            case 'candidat' :
                redirect('main/welcome');
                break;
            case 'recruteur' :
                redirect('recruteur/welcome');
                break;        
        }             
        else : redirect('register');
        endif;                          
    }    
    


    
    
    /**
     * Page d'attente de l'activation du compte
     * 
     */
    function waiting_activation($profile) {
        //$data['step'] = 2;
        $data['view'] = "candidat/registration/register-waiting-activation";
        
        switch($profile) {
            case 'perso' :
                $this->load->view('common/templates/main-fixed',$data);                
                break;
            case 'recruteur' :
                $this->load->view('recruteur/templates/registration',$data);
                break;
        }
        
    }




 
    /**
     * Page d'accueil d'un compte activé
     * 
     */
    function activated() {        
        $this->load->model('user');
        $this->user->login_test();
        
        $params = array(
        'with_options' => true,
        );
        
        $user = $this->user->get_user($params);
                       
            
        //$data['step'] = $user->options->profile_step;
        
        switch($this->user->profile) {
            case 'perso':
                $data['view'] = 'candidat/registration/activated';  
                $this->load->view('common/templates/main-fixed',$data);
                break;
            case 'recruteur': 
                $this->load->view('recruteur/templates/registration',$data);
                break;
        }
    }        
    

    /**
     * Désinscription du site
     * Supprime toutes les informations sur l'utilisateur
     * 
     */
    function unregister() {
       $data['view'] = 'candidat/unregister';
       $this->load->view('common/templates/main-fixed', $data);
    }
    
    function unregister_confirm() {        
        $this->load->model('user');
        $this->user->login_test();
        $this->user->set_id($this->session->userdata('user_id')); // seul l'utilisateur loggué peut se supprimer
        $this->user->delete_user();
        $this->load->library('tank_auth');
        $this->tank_auth->logout();
        
        redirect('main');
    }    
    
}
    