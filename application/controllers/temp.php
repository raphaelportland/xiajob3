<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur temporaire
 * A SUPPRIMER AVANT LE LANCEMENT
 * 
 * 
 */
class Temp extends CI_Controller
{
    
    function index() {
        echo("Controleur temporaire <br />
        /d/XX : supprime l'utilisateur XX<br />
        /a/XX : lien d'activation de l'utilisateur XX<br />");
    }
    
    
    // A SUPPRIMER AVANT LE LANCEMENT :
    function d($user_id) {
        $this->load->model('generic_user');
        $this->generic_user->set_id($user_id);
        $this->generic_user->delete_user();
        
        echo($user_id . " deleted.");
    }   
    
    // A SUPPRIMER AVANT LE LANCEMENT :
    function a($user_id, $password = '1234') {
        
        $this->load->model('users');
        $user = $this->users->get_user_by_id($user_id,false);
        
        echo anchor('auth/activate/'.$user_id.'/'.$user->new_email_key.'/'.$password, 'Lien d\'authentification utilisateur '.$user_id);
    }
    
    
    
    function flower_list() {
        
        $this->load->view('common/head');
        $this->load->model('liste');
        echo($this->liste->flowers('fr'));
    }  
    
    
    function get_user($user_id) {        
        code($user_id . ' Generic_user');        
        $this->load->model('generic_user');
        $data = $this->generic_user->get_user($user_id);      
        code($data);
    }
    
    function get_candidat($user_id) {
        code($user_id . ' Candidat');
        $this->load->model('candidat');
        $data = $this->candidat->get_candidat($user_id);       
        code($data);           
    }
    
    
    function get_book($book_id) {
        code('get_book with comments');
        $this->load->model('books');
        code($this->books->get_book_by_id($book_id, true));
    }
    
    
    function info() {
        phpinfo();
    }  
    
    
} 