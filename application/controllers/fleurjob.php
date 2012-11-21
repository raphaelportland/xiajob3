<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur du site Candidat
 * 
 * 
 */
class Fleurjob extends CI_Controller
{
          
    /**
     * Accueil du site Candidat
     * Dispatche les utilisateurs entre loggués et non loggués
     * 
     */
    function index() {
         
        if (!$this->tank_auth->is_logged_in()) {  // si l'utilisateur n'est pas loggué                  
            $data['view'] = 'candidat/home';
        
            $this->load->view('common/templates/main',$data);
                            
        } else { // s'il est loggué
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
        $this->load->model('candidat');
        $this->candidat->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas. 
 
        $this->candidat->get_candidat();
        
        $data['user'] = $this->candidat;     
        $data['view'] = "candidat/dashboard";
        $this->load->view("common/templates/main",$data);
    }       





    
    /**
     * Affichage/Modification du profil candidat
     * 
     */
    function edit_profile($rubrique = 0) {
        $this->load->model('candidat');        
        $this->candidat->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        
        
        if($rubrique == 0) {
            if($this->input->post()) {
                
                $this->candidat->update_profile(0,$this->input->post());                
                //$this->candidat->update_options($this->input->post());            
            }
            $this->candidat->all_options();             
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
        }
        
        if($rubrique == 2) {
            
            if($this->input->post('submit')) {                      
                $this->candidat->update_competences($this->input->post());                
            }
                        
            $this->load->model('liste');
            $data['comp_list'] = $this->liste->competences();
            $data['recomp_list'] = $this->liste->recompenses();
            $this->load->helper('profile');                               
        }
        
        if($rubrique == 3) {
            
            if(!$this->candidat->has_book()) {
                redirect('fleurjob/create_book');
            } else {
                
                $this->load->model('books');
                $data['books'] = $this->books->all_books();
                
            }
            
        }
        
        $data['user'] = $this->candidat->get_candidat();
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
        
        redirect("fleurjob/edit_profile/1");            
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
        
        redirect("fleurjob/edit_profile/1");            
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
        
        redirect("fleurjob/edit_profile/1");            
    } 
    
    
    
    
    
    /**
     * efface une donnée d'un certain type
     * 
     */
    function del($type,$id) {
        $this->load->model('candidat');        
        $this->candidat->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        

        $this->candidat->delete_info($type,$id);
        
        redirect("fleurjob/edit_profile/1");
        
    }
    
    
    
    function edit($type, $id) {
        $this->load->model('candidat');        
        $this->candidat->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.           
        
        if($this->input->post('submit')) {          
            $this->candidat->update_attrib($type,$id,$this->input->post());           
            redirect('fleurjob/edit_profile/1');           
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



    
}