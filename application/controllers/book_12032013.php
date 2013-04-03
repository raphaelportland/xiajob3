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
        $this->books->get_popular(8);
        $this->books->get_latest(8);  
                
        $data['books'] = $this->books->books;

        $this->load->model('liste');
        $data['fleurs'] = $this->liste->flowers();
        
        $data['view'] = 'books/gallery';      
        $this->load->view('common/templates/main-fixed',$data);
       
    }
    
    
    
    /**
     * Affiche tous les books les plus récents
     * 
     */
     function latest() {
         
        $this->load->model('books');                    
        $data['books'] = $this->books->get_latest(); 
        
        //code($data['books']);
        
        $data['view'] = 'books/latest';    
        $this->load->view('common/templates/main-fixed',$data);      
         
     }
     
     
     function popular() {
        $this->load->model('books');
        $data['books'] = $this->books->get_popular();
        $data['view'] = 'books/popular';    
        $this->load->view('common/templates/main-fixed',$data);    
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
     * Affiche la liste des books d'un utilisateur
     * 
     */
    function my_books() {
        $this->load->model('user');
        $this->user->login_test(); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.         

        $books_params = array(
        'with_fav_count' => true,
        'with_covers' => true,
        'with_pictures' => true,
        'with_occasions' => true,
        'user_id' => $this->session->userdata('user_id'),
        );
        
        $this->load->model('books');
        $books = $this->books->get_library($books_params);
        
        // si pas de book créé, on l'envoie en créer un
        if(!isset($books) || count($books) == 0) { redirect('book/create_book'); } 
        
        $data['view'] = "books/my_books";
        $data['books'] = $books;
        
        $this->config->load('facebook'); 
        $data['app_id'] = $this->config->item('facebook_appId'); 
        
        
        $this->load->view("common/templates/main-fixed",$data);              
    }
    
    
    
    /**
     * Edite le book indiqué
     * 
     */
    function edit($id) {

        $this->load->model('user');        
        $this->user->login_test(); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        
        
        $this->load->model('books');
        
        if($this->input->post('submit')) {
            $this->books->update($this->input->post());
        }

        $params = array(
        'with_pictures' => true,
        'with_flowers' => true
        );
        
        $data['book'] = $this->books->get_book($id, $params);        
        
        //code($data['book']);
        
        $data['view'] = 'books/edit-book';       
        $this->load->view('common/templates/main-fixed',$data);        
    }


    /**
     * Supprime une photo dans un book
     * 
     */
    function del_picture($picture_id) {
       // on teste si l'utilisateur est loggué, puis qu'il est bien le propriétaire de la photo
       $this->load->model('user');
       $this->user->login_test();   
       if($this->user->is_pic_owner($picture_id)) {
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
        $this->load->model('user');        
        $this->user->login_test(); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        
        
        // vérifie que l'utilisateur est bien le propriétaire
        if($this->user->is_book_owner($id)) {           
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
        $this->load->model('user');        
        $this->user->login_test(); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.
        
        
        if($this->input->post()) {
                        
            $this->load->library('form_validation');  
            $this->form_validation->set_rules('book_name', 'Le nom de votre florBook est nécessaire !', 'required');  
            $this->form_validation->set_rules('description', 'Veuillez entrer une description', 'required');  
             
            $this->form_validation->set_message('required', '%s');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><strong>Attention : </strong> ', '</div>');
                  
            if($this->form_validation->run() != FALSE) :            
                       
                $this->load->model('books');
                $new_book_id = $this->books->create($this->input->post());
                
                redirect('book/add_pics/'.$new_book_id);
                 
            endif;                
        }  
        
        $this->load->model('liste');
        $data['occasions_list'] = $this->liste->occasions();
        $data['user_id'] = $this->user->user_id;
        
        //stop_code($data);
                
        $data['view'] = 'books/create-book';
        $this->load->view('common/templates/main-fixed',$data);        
        
    }
    
    
    
    
    /**
     * Ajout d'images
     * 
     */
    function add_pics($book_id) {
        $this->load->model('user');        
        $this->user->login_test(); // vérifie si l'utilisateur est connecté et le boule s'il ne l'est pas.        

        $this->load->model('books');
        
        $data['book'] = $this->books->get_book($book_id, array('with_pictures' => true));

        $data['view'] = 'books/add-pic';
        $this->load->view('common/templates/main-fixed',$data);                  
        
    }
        
    
    
    
    function edit_book_name($book_id) {
        
        $this->load->model('books');
        
        if($this->input->post('submit')) {
            $this->books->ajax_update($this->input->post());
            redirect('book/my_books');
        } else {
                        
            $data['book'] = $this->books->get_book($book_id);         
                      
            $this->load->view('books/edit_book_name',$data);
        }
    }   
      
    function edit_book_desc($book_id) {
        
        $this->load->model('books');
        
        if($this->input->post('submit')) {

            $this->books->ajax_update($this->input->post());
            redirect('book/my_books');
        } else {
                        
            $data['book'] = $this->books->get_book($book_id);                   
            $this->load->view('books/edit_book_desc',$data);
        }        
    }
    
    
    
    function add_flowers($pic_id) {
        
        $data['pic_id'] = $pic_id;

        $this->load->model('liste');        
        $data['fleurs'] = $this->liste->flowers('fr');
        
        $this->load->model('books');
        $this->books->set_lang('fr');
        
        if($this->input->post('submit')) {
            
            $this->books->save_pic_flower($pic_id, $this->input->post('flower'));
            
        }
        
        $data['pic'] = $this->books->get_pic_by_id($pic_id);
        
        $data['view'] = 'books/add-flowers';
        $this->load->view('common/templates/main-fixed',$data);
        
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
    
    
    
    function update_cover($book_id, $pic_id) {
        $this->load->model('books');
        $this->books->update_cover_pic($book_id, $pic_id);
        redirect('book/edit/'.$book_id);
    }
    
    
    
    
    
    
    
    function show($book_id, $type = 'classic', $pic_id = null, $option = null) {

            switch($type) {
                case 'classic' : // le book complet avec toutes les miniatures
                    
                    $this->load->model('books');
                    $params = array(
                    'with_pictures' => true,
                    'with_owner' => true,
                    'with_comments' => true,
                    'with_flowers' => true,
                    'with_fav_count' => true,
                    'with_is_your_fav' => true,        
                    );                     
                    $data = $this->books->get_book($book_id, $params);                    
                    
                    // appId Facebook
                    $this->config->load('facebook'); 
                    $data->app_id = $this->config->item('facebook_appId');                    
                    
                    // on regarde si l'utilisateur est loggué
                    $this->load->library('tank_auth');
        
                    if($this->tank_auth->is_logged_in()) { // l'utilisateur est loggué
                        $data->logged_in = true; 
                    
                        // dans ce cas on regarde si le book est dans les favoris de l'utilisateur                
                        $this->load->model('social_model'); 
                        $infos_fav = array(
                        'user_id' => $this->session->userdata('user_id'),
                        'book_id' => $book_id,
                        );
                        $data->is_fav = $this->social_model->is_fav($infos_fav);
                    
                        // on regarde aussi si l'utilisateur est le propriétaire
                        $this->load->model('user');
                        if($this->user->is_book_owner($book_id)) { // l'utilisateur est le propriétaire du book
                            $data->viewer_is_owner = true;                
                        } else {
                            $data->viewer_is_owner = false;
                        } 

                    } else { // si l'utilisateur n'est pas loggué, il n'est pas non plus considéré comme le propriétaire
                            $data->viewer_is_owner = false;
                            $data->logged_in = false;
                    }                    
                    
                    // on charge le template                                        
                    $data->view = 'books/templates/new_book_tpl';
                    $this->load->view('common/templates/book-viewer', $data); 
                    break;
                
                case 'picture' :
                    // On charge les infos de la photo à afficher
                    $this->load->model('picture_model','picture');
                    $params = array(
                        'with_comments' => true,
                        'with_flowers' => true,
                    );
                    $data = $this->picture->get_pic($pic_id, $params);
                    
                    // adresse de la visionneuse
                    $data->pic_url = $this->picture->get_pic_view_url($book_id, $pic_id);
                    
                    // appId Facebook
                    $this->config->load('facebook'); 
                    $data->app_id = $this->config->item('facebook_appId');
                    
                    //code($data);
                    
                    // on charge le template
                    $data->view = 'books/templates/new_book_pic_tpl';
                    $this->load->view('common/templates/viewer',$data);
                    break;  
                    
                case 'diaporama' :
                    // On charge les infos de la couverture
                    $this->load->model('books');
                    $params = array(
                        'with_comments' => true,
                        'with_flowers' => true,
                    );
                    $data = $this->books->get_cover($book_id, $params);
                    
                    // adresse de la visionneuse
                    $data->pic_url = $this->picture->get_pic_view_url($book_id, $pic_id);                    
                    // appId Facebook
                    $this->config->load('facebook'); 
                    $data->app_id = $this->config->item('facebook_appId'); 
                    
                    // on charge le template
                    $data->view = 'books/templates/new_book_pic_tpl';
                    $this->load->view('common/templates/viewer',$data);
                    break;                                     
            }
    }

    // renvoie sur la page de la photo suivante du book
    function next_pic($book_id, $pic_id) {
        $this->load->model('books');
        //$next_pic = $this->books->get_next_pic($book_id, $pic_id);
        $next_pic = $this->books->get_another_pic('next', $book_id, $pic_id);
        redirect('book/show/'.$book_id.'/picture/'.$next_pic);
    }
    
    // renvoie sur la page de la photo précédente
    function previous_pic($book_id, $pic_id) {
        $this->load->model('books');
        //$previous_pic = $this->books->get_previous_pic($book_id, $pic_id);
        $previous_pic = $this->books->get_another_pic('previous', $book_id, $pic_id);
        redirect('book/show/'.$book_id.'/picture/'.$previous_pic);
    }
    
    
}