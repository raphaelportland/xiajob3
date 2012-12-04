<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur du site Candidat
 * 
 * 
 */
class Main extends CI_Controller
{
          
    /**
     * Accueil du site Candidat
     * Dispatche les utilisateurs entre loggués et non loggués
     * 
     */
    function index() {
         
        if (!$this->tank_auth->is_logged_in()) {  // si l'utilisateur n'est pas loggué      
        
            $this->load->model('books');
            $this->books->get_latest(4);
        
            $data['books'] = $this->books->books;
                    
            $data['view'] = 'candidat/home';
        
            $this->load->view('common/templates/main',$data);
                            
        } else { // s'il est loggué
            $this->load->model('generic_user');
            $profile = $this->generic_user->profile();
         
            if($profile == 'candidat') : redirect('main/welcome');
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
        $this->generic_user->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas. 
        
        $params = array(
        'with_options' => true,
        'with_member_since' => true,
        'with_resume' => true,
        'with_skills' => true,
        'with_books' => true,
        'books_params' => array(
                            'user_id' => $this->session->userdata('user_id'),
                            'with_fav_count' => true, 
                            ),      
        'with_favorites' => true,
        );
        
        $data['user'] = $this->generic_user->get_user($params);;     
        $data['view'] = "candidat/dashboard";
        $this->load->view("common/templates/main",$data);
    }       





    
    /**
     * Affichage/Modification du profil candidat
     * 
     */
    function edit_profile($rubrique = 0) {

        if($rubrique == 0) {
            if($this->input->post()) {
                $this->load->library('form_validation');                
                $this->form_validation->set_rules('status', 'Votre statut', 'required');   
                $this->form_validation->set_message('required', '%s doit être renseigné');
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><strong>Erreur : </strong> ', '</div>');
                      
                if($this->form_validation->run() != FALSE) :
                    $this->load->model('candidat');
                    $this->candidat->update_profile(0,$this->input->post());
                endif;
            }
            
            $params = array(   
            'with_address' => true,
            'with_options' => true, 
            'with_phone' => true,
            'with_dob' => true,       
            );
            
            //$this->candidat->all_options();             
        }     

        
        if($rubrique == 1) {                                  
            // on récupère les listes nécessaires à l'onglet 1
            $this->load->model('liste');
            $data['comp_list'] = $this->liste->competences();
            $data['recomp_list'] = $this->liste->recompenses();
            $data['formation_list'] = $this->liste->formations();
            $data['diplome_list'] = $this->liste->diplomes();                                       
            $data['type_etab_list'] = $this->liste->types_etablissement();
            $data['postes_list'] = $this->liste->postes();            
            $data['months'] = $this->liste->months();
            
            $params = array(
            'with_resume' => true,
            'with_diplomas' => true,
            'with_awards' => true,
            'with_xppro' => true,
            );
            
        }
        
        if($rubrique == 2) {
            
            if($this->input->post('submit')) {
                
                if($this->form_validation->run() != "FALSE") :                
                    $this->load->model('candidat');                      
                    $this->candidat->update_competences($this->input->post());                   
                endif;
            }    
                        
            $this->load->model('liste');
            $data['comp_list'] = $this->liste->competences();
            $data['recomp_list'] = $this->liste->recompenses();
            $this->load->helper('profile');   
            
            $params = array(
            'with_resume' => true,
            'with_skills' => true,
            'with_computer_skills' => true,
            'with_options'=> true,
            'with_description' => true,
            );
                                        
        }
        
        if($rubrique == 3) {
            
            if(!$this->candidat->has_book()) {
                redirect('main/create_book');
            } else {
                
                $this->load->model('books');
                $data['books'] = $this->books->all_books();
                
            }
            
        }
        
        $this->load->model('generic_user');        
        $this->generic_user->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        
        
        $data['user'] = $this->generic_user->get_user($params);
        
        $data['rubrique'] = $rubrique;       
        $data['view'] = "candidat/profile/profile"; // mini-template pour les différents onglets du profil
        
        $this->load->view("common/templates/main",$data);
    }






    /**
     * ajout d'une récompense du candidat
     * 
     */
    function add_recomp() {
        $this->load->model('candidat');        
        $this->candidat->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        
        
        if($this->input->post('submit')) :

            $this->candidat->add('recomp', $this->input->post());                 
        endif;
        
        redirect("main/edit_profile/1");            
    }  






    /**
     * ajout d'un diplome du candidat
     * 
     */
    function add_diplome() {
        $this->load->model('candidat');        
        $this->candidat->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        
        
        if($this->input->post('submit')) :

            $this->candidat->add('diplome', $this->input->post());                 
        endif;
        
        redirect("main/edit_profile/1");            
    }    
    
    
    
    

    /**
     * ajout d'une expérience pro
     * 
     */
    function add_xp() {
        $this->load->model('candidat');        
        $this->candidat->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        
        
        if($this->input->post('submit')) :
            $this->candidat->add('xp', $this->input->post());                 
        endif;
        
        redirect("main/edit_profile/1");            
    } 
    
    
    
    
    
    /**
     * efface une donnée d'un certain type
     * 
     */
    function del($type,$id) {
        $this->load->model('candidat');        
        $this->candidat->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        

        $this->candidat->delete_info($type,$id);
        
        redirect("main/edit_profile/1");
        
    }
    
    
    
    function edit($type, $id) {
        $this->load->model('candidat');        
        $this->candidat->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.           
        
        if($this->input->post('submit')) {          
            $this->candidat->update_attrib($type,$id,$this->input->post());           
            redirect('main/edit_profile/1');           
        }
        
        $data['data'] = $this->candidat->get_attrib($type, $id);
               
        $this->load->model('liste');
        switch($type) {
            case 'recomp' :
                $data['recomp_list'] = $this->liste->recompenses();
                break;
                
            case 'formations' :
                $data['formation_list'] = $this->liste->formations();
                $data['diplome_list'] = $this->liste->diplomes();                                       
                $data['type_etab_list'] = $this->liste->types_etablissement();
                $data['postes_list'] = $this->liste->postes();            
                $data['months'] = $this->liste->months(); 
                break;
                
            case 'expepro' :
                $data['type_etab_list'] = $this->liste->types_etablissement();
                $data['postes_list'] = $this->liste->postes();            
                $data['months'] = $this->liste->months();                 
                break;
        }
        
        if($this->input->post('ajax')) {
            $this->load->view('candidat/elmt/'.$type.'-edit',$data);            
        } else {        
            $data['view'] = 'candidat/elmt/'.$type.'-edit';        
            $this->load->view('common/templates/main',$data);            
        }
    } 


    /**
     * Emmène à la validation des CGU pour les utilisateurs
     * qui viennent de facebook
     * 
     */
    function cgu() {
        /*
        $test_session = serialize(array(
            'user_id'   => '113',
            'username'  => 'Test3',
            'status'    => '1',
        ));  
        
        $this->session->set_userdata('secret_session', $test_session);     */ 
        
        $secret_session = $this->session->userdata('secret_session');
        
        $data['infos'] = unserialize($secret_session);        
        $data['view'] = 'common/accept-cgu-form';
        $this->load->view('common/templates/main', $data);
        
    }
    
    
    function valid_cgu() {
        $this->load->model('generic_user');        
        $this->generic_user->valid_cgu();
      
        
    }
    
    function decline_cgu() {
        // on supprime la session
        $this->session->sess_destroy();        
        // on redirige l'utilisateur à la porte
        redirect('main');
    }


    
}