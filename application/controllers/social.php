<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur des books
 * 
 * 
 */
class Social extends CI_Controller
{
    function add_fav() {
        
        if($this->input->post('book_id')) {

            $data['book_id'] = $this->input->post('book_id');
            $data['user_id'] = $this->session->userdata('user_id');
            $this->load->model('social_model');
            
            $result = $this->social_model->add_fav($data);
            
            switch($result) {
                
                case '1' :
                    $msg = "Ce book a bien été ajouté à vos favoris";
                    break;
                    
                case '2' : 
                    $msg = "Ce book est déjà dans vos favoris";
                    break;
                    
                case '3' :
                    $msg = "Error";
                    break;
            } 
            
            echo($msg);  
            
        } else {
            echo 'error';
        }
        
    }
    
    
    
    

    function favorites() {
        
        
        $this->load->model('social_model');
        $favs = $this->social_model->get_user_favs($this->session->userdata('user_id'));
        
        //stop_code($favs);
        
        $this->load->model('books');
        foreach ($favs as $key => $book) {
            $books[] = $this->books->get_book_by_id($book->book_id);
        }
        
        $data['books'] = $books;
        $data['view'] = 'candidat/favorites';
        
        $this->load->view('candidat/templates/private', $data);
    }
    
    
    
    function del_fav($book_id) {
        $this->load->model('social_model');
        
        $data['book_id'] = $book_id;
        $data['user_id'] = $this->session->userdata('user_id');
        
        $this->social_model->del_fav($data);
        
        redirect('social/favorites');
    }
    
    
    
    
}