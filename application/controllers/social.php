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
        
        $params = array(
        'with_pictures' => true,
        );
        
        foreach ($favs as $key => $book) {
            
            $books[] = $this->books->get_book($book->book_id, $params);
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
    
    
    /**
     * Page de contact par mail
     */
    function contact() {
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('subject', 'Le sujet du mail', 'required');
        $this->form_validation->set_rules('message', 'Le message', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');        
        
        // validation
        if ($this->form_validation->run())
        {
            // le formulaire est envoyé
            $this->load->library('email');
            
            $this->email->from($this->input->post('email'));
            $this->email->to('florbooks@gmail.com'); 
            $this->email->cc($this->input->post('email')); 
            
            $this->email->subject('[florBooks] '.$this->input->post('subject'));
            $this->email->message($this->input->post('message'));  
            
            $this->email->send();
            
            // message de réussite
            $data['view'] = 'common/contact-form-submitted';
            $this->load->view('common/templates/main',$data);
        } else {

            // affichage du formulaire
            $data['view'] = 'common/contact-form';
            $this->load->view('common/templates/main',$data);                
            
        }
    }
    
    
}