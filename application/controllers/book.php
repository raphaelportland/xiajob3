<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur des books
 * 
 * 
 */
class Book extends CI_Controller
{
    /**
     * La galerie des books
     * 
     */
    function index() {
        
        $this->load->model('books');
        $this->books->get_featured_books(4);
        $this->books->get_recent(8);
                
        $data['books'] = $this->books->books;
        
        $data['view'] = 'books/gallery';      
        $this->load->view('common/templates/main',$data);
       
    }
    
    
    
    /**
     * Affiche tous les books les plus récents
     * 
     */
     function latest() {
         
        $this->load->model('books');
        $this->books->get_recent();

        $this->load->model('liste');
        
        $data['books'] = $this->books->books;
        $data['occasions'] = $this->liste->occasions(); 
        
        $this->load->view('books/latest',$this->books->books);         
         
     }
    

    /**
     * Vue extérieure d'un book (publique)
     * 
     * @param int
     */
    function view($book_id) {
                
        $this->load->model('books');      
        $data = $this->books->get_book_by_id($book_id, true);

            $this->load->library('tank_auth');

            if($this->tank_auth->is_logged_in()) { // l'utilisateur est loggué
            
                $this->load->model('social_model'); 
                $infos_fav = array(
                'user_id' => $this->session->userdata('user_id'),
                'book_id' => $book_id,
                );
                $data->is_fav = $this->social_model->is_fav($infos_fav);            

            
                $this->load->model('generic_user');
                if($this->generic_user->is_book_owner($book_id)) { // l'utilisateur est le propriétaire du book
                    $data->viewer_is_owner = true;                
                } else {
                    $data->viewer_is_owner = false;
                } 
                $data->viewer_is_logged_in = true;
            } else {
                    $data->viewer_is_owner = false;
                    $data->viewer_is_logged_in = false;
            }

            $this->load->view('books/templates/book_tpl',$data);
    }   


    function search() {
        if($this->input->post('submit')) :
            // des données ont été reçues
            
            $this->load->model('books');
            $this->books->search($this->input->post('keywords'));
            
            //code($this->books->data->search);
        else :
            echo("rien recu");
        endif;
    }  
    
    /**
     * Affiche la liste des books d'un candidat
     * 
     */
    function my_books() {
        $this->load->model('candidat');
        $this->candidat->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.         

        $books = $this->candidat->get_all_user_books($this->session->userdata('user_id'));
        
        // si pas de book créé, on l'envoie en créer un
        if(!isset($books)) { redirect('book/create_book'); } 
        
        $data['view'] = "books/my_books";
        $data['books'] = $books;
        
        $this->load->view("common/templates/main",$data);              
    }
    
    
    
    /**
     * Edite le book indiqué
     * 
     */
    function edit($id) {
        
        $this->load->model('generic_user');        
        $this->generic_user->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        
        
        $this->load->model('books');
        
        if($this->input->post('submit')) {
            $this->books->update($this->input->post());
            redirect('book/my_books');
        }

        $data['book'] = $this->books->get_book_by_id($id);        
        $data['view'] = 'books/edit-book';       
        $this->load->view('common/templates/main',$data);        
    }


    /**
     * Supprime une photo dans un book
     * 
     */
    function del_picture($picture_id) {
       // on teste si l'utilisateur est loggué, puis qu'il est bien le propriétaire de la photo
       $this->load->model('generic_user');
       $this->generic_user->login_test();   
       if($this->generic_user->is_pic_owner($picture_id)) {
           $this->load->model('books');
           $return_book = $this->books->delete_pic($picture_id);
           redirect('book/edit/'.$return_book);
       } 
       else { redirect('book/my_books'); }         
    }
 
 
 
 
 

    
    /**
     * Suppression d'un book
     */
    function del_book($id) {
        $this->load->model('generic_user');        
        $this->generic_user->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        
        
        // vérifie que l'utilisateur est bien le propriétaire
        if($this->generic_user->is_book_owner($id)) {           
            $this->load->model('books');
            $this->books->delete($id);         
        }
        redirect('book/my_books');
    }
    


    
    /**
     * Création d'un nouveau book
     * 
     */
    function create_book() {
        $this->load->model('generic_user');        
        $this->generic_user->login_test(); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        

        
        
        if($this->input->post()) {           
            $this->load->model('books');
            $new_book_id = $this->books->create($this->input->post());
            
            redirect('book/add_pics/'.$new_book_id);                
        }  
        
        $this->load->model('liste');
        $data['occasions_list'] = $this->liste->occasions();
        $data['user_id'] = $this->generic_user->user_id;
        
        //stop_code($data);
                
        $data['view'] = 'books/create-book';
        $this->load->view('common/templates/main',$data);        
        
    } 
    
    
    
    
    
    
    /**
     * Ajout d'images
     * 
     */
    function add_pics($book_id) {
        $this->load->model('generic_user');        
        $this->generic_user->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        

        $this->load->model('books');
        $data['book'] = $this->books->get_book_by_id($book_id); 
 
        $data['view'] = 'books/add-pic';
        $this->load->view('common/templates/main',$data);                  
        
    }
        



    
    /**
     * Affichage du partage
     * 
     */
    function share($book_id) {        
        $this->load->model('generic_user');        
        $this->generic_user->login_test('candidat'); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        
                

        
        if($this->generic_user->is_book_owner($book_id)) :
            $this->load->model('books');
            $this->books->load($book_id);            
            $book_data = $this->books->books;
            $book_data->user_is_owner = true;
        else :
            $book_data = new stdClass();
            $book_data->user_is_owner = false;    
        endif;        
        
        $data['view'] = 'books/share';
        
        if($this->input->post('ajax')) {
            $this->load->view($data['view'],$book_data);            
        } else {    
            $this->load->view('common/templates/main',$data);
        }

    } 
    
    
    
    
    
    
    function edit_book_name($book_id) {
        
        $this->load->model('books');
        
        if($this->input->post('submit')) {
            $this->books->ajax_update($this->input->post());
            redirect('book/my_books');
        } else {
                        
            $data['book'] = $this->books->get_book_by_id($book_id);         
                      
            $this->load->view('books/edit_book_name',$data);
        }
    }   
      
    function edit_book_desc($book_id) {
        
        $this->load->model('books');
        
        if($this->input->post('submit')) {

            $this->books->ajax_update($this->input->post());
            redirect('book/my_books');
        } else {
                        
            $data['book'] = $this->books->get_book_by_id($book_id);                   
            $this->load->view('books/edit_book_desc',$data);
        }        
    }
    
    
    
    function add_flowers($pic_id) {
        
        $data['pic_id'] = $pic_id;
        
        //$this->load->model('liste');
        //$data['fleurs'] = $this->liste->flowers();
        
        //$data['fleurs'] = file_get_contents(base_url().'public/flower_list_fr.html');
        $this->load->model('liste');        
        $data['fleurs'] = $this->liste->flowers('fr');        
        
        $this->load->model('books');
        $this->books->set_lang('fr');
        
        if($this->input->post('submit')) {
            
            $this->books->save_pic_flower($pic_id, $this->input->post('flower'));
            
        }
        
        $data['pic'] = $this->books->get_pic_by_id($pic_id);
        
        $data['view'] = 'books/add-flowers';
        $this->load->view('common/templates/main',$data);
        
    }
    
    
    function del_pic_flower($pic_id, $flower_id, $custom_flower = null) {
        $this->load->model('books');
        
        if($custom_flower) {
            $this->books->del_pic_custom_flower($pic_id, $flower_id);            
        } else {       
            $this->books->del_pic_flower($pic_id, $flower_id);            
        }

        redirect('book/add_flowers/'.$pic_id);
    }
    
    
}