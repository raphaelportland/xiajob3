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
        $this->load->model('generic_user', 'user');
            
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
       
        $this->load->model('generic_user', 'user');
            
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

         if($this->input->post('submit')) {            
             
             $this->load->model('admin_model');
             $this->admin_model->add_featured_book($this->input->post('new_book_id'));
             
             redirect('admin/featured_book');
             
         }
    }


    /**
     * Supprime le book de la table des books mis en avant
     * 
     */
    function delete_featured_book($book_id) {
       
       $this->load->model('admin_model');
       $this->admin_model->delete_featured_book($book_id);
       
       redirect('admin/featured_book');
        
    }

    
}
    