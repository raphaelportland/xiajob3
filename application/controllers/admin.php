<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur de l'administration
 * 
 * 
 */
class Admin extends CI_Controller
{
    /**
     * page d'accueil
     * 
     */
    function index() {
        $this->load->model('user');            
        if($this->user->is_admin()) { // il est bien administrateur
                
            // affichage du panneau d'administration
            $data['rubrique'] = 'Bienvenue !';
            $data['view'] = 'admin/admin-panel';
            $this->load->view('admin/admin-template', $data);
                
        } else { // il n'est pas administrateur
            
            redirect('main'); 
            
        }
        
    }
    
    
    /**
     * Affiche la page de gestion des books à la une
     * 
     */
    function featured_book() {
       
        $this->load->model('user');
        if($this->user->is_admin()) { // il est bien administrateur
        
            // chargement des books à la une
            $this->load->model('books');
            $data['featured'] = $this->books->get_featured_book_list();
                
            // affichage du panneau d'administration
            $data['rubrique'] = 'florBooks à la une';
            $data['view'] = 'admin/featured-book';
            $this->load->view('admin/admin-template', $data);
                
        } else { // il n'est pas administrateur
            
            redirect('main'); 
            
        }       
        
    }
    

    /**
     * Ajoute le book dans la table des books mis en avant
     */
    function add_featured_book() {
        $this->load->model('user');
        if($this->user->is_admin()) { // il est bien administrateur 
             if($this->input->post('submit')) {            
                 
                 $this->load->model('admin_model');
                 $this->admin_model->add_featured_book($this->input->post('new_book_id'));
                 
                 redirect('admin/featured_book');
                 
             }
        }
    }


    /**
     * Supprime le book de la table des books mis en avant
     * 
     */
    function delete_featured_book($book_id) {
        $this->load->model('user');
        if($this->user->is_admin()) { // il est bien administrateur       
            $this->load->model('admin_model');
            $this->admin_model->delete_featured_book($book_id);       
            redirect('admin/featured_book');
        }
        
    }
    
    
    
    /**
     * Page de gestion des administrateurs
     * 
     */
    function manage_admins() {
        $this->load->model('user');
        if($this->user->is_admin()) { // il est bien administrateur   
        
            // chargement des données des admin
            $this->load->model('admin_model');
            $data['admin_list'] = $this->admin_model->get_admin_list();
            
            // affichage du panneau d'administration
            $data['rubrique'] = 'Gestion des administrateurs';
            $data['view'] = 'admin/admin-management';
            $this->load->view('admin/admin-template', $data);        
        }        
    }


    /**
     * Ajoute un administrateur
     */
    function add_admin() {
        $this->load->model('user');
        if($this->user->is_admin()) { // il est bien administrateur 
             if($this->input->post('submit')) {            
                 
                 $this->load->model('admin_model');
                 $this->admin_model->add_admin($this->input->post('new_admin'));
                 
                 redirect('admin/manage_admins');
                 
             }
        }        
    }

    /**
     * Supprime l'administrateur
     * 
     */
    function del_admin($user_id) {
        $this->load->model('user');
        if($this->user->is_admin()) { // il est bien administrateur       
            $this->load->model('admin_model');
            $this->admin_model->del_admin($user_id);       
            redirect('admin/manage_admins');
        }
        
    }
    
    
    /**
     * Affiche la liste des utilisateurs
     */
    function users_perso() {
        $this->load->model('user');
        if($this->user->is_admin()) { // il est bien administrateur             
            $this->load->model('admin_model');
            $data['users'] = $this->admin_model->get_all_users();
                   
            $data['rubrique'] = 'Gestion des utilisateurs';
            $data['view'] = 'admin/user-perso-management';
            $this->load->view('admin/admin-template', $data); 
        }         
    }  
    
    /**
     * suspens un compte utilisateur
     */
    function ban_user($user_id) {
        $this->load->model('user');
        if($this->user->is_admin()) { // il est bien administrateur
            $this->load->model('admin_model');
            $this->admin_model->ban_user($user_id);
            
            redirect('admin/users_perso');
        }        
    }

    /**
     * réactive un compte utilisateur
     */
    function unban_user($user_id) {
        $this->load->model('user');
        if($this->user->is_admin()) { // il est bien administrateur
            $this->load->model('admin_model');
            $this->admin_model->unban_user($user_id);
            
            redirect('admin/users_perso');
        }        
    }
      
}
    