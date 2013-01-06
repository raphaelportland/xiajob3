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
    
    
    
    function add_list_1() {
        
        // OCCASIONS
        $data_occasions = array(
        array('occasion_name' => 'Plaisir d’offrir'),
        array('occasion_name' => '1er Mai'),
        );
        
        $this->db->insert_batch('occasions',$data_occasions);
        
        // AWARDS
        $data_awards = array(
        array('name' => 'Médaillé Régional des Olympiades des Métiers'),
        array('name' => 'Médaillé National des Olympiades des Métiers'),
        array('name' => 'Vainqueur de la Coupe Espoir Interflora'),
        array('name' => 'Vainqueur de la Coupe Interflora'),
        );

        $this->db->insert_batch('recompenses',$data_awards);
        
        // DIPLOMAS
        $data_diplomas = array(
        array('diplome' => 'BM (Brevet de Maîtrise)'),
        );

        $this->db->insert_batch('diplomes',$data_diplomas);        
        
        
        // TYPE D'ETABLISSEMENT
        $this->db->where('type_etab', 'Magasin Libre Service');
        $data_etab = array(
        'type_etab' => 'Magasin sous Enseigne'
        );
        
        $this->db->update('type_etablissement', $data_etab);
        
        // SKILLS
        $this->db->insert('competences', array('nom' => "Vente & Conseil Clientèle"));
        
    } 


    function test_loads() {
        $this->config->load('img_folders');
        code($this->config->item('img_folder'));
        code($img_folder);
    }
    
    
    function get_max_pic_order($book_id) {
        echo('test de get_max_pic_order (books) pour le book '.$book_id);
        $this->load->model('books');
        $result = $this->books->get_max_pic_order($book_id);
        code($result);
    }
    
} 