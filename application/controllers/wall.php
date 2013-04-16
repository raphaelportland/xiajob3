<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*
*/


class Wall extends CI_Controller
{
          
    /**
     * Accueil du site Candidat
     * Dispatche les utilisateurs entre loggu�s et non loggu�s
     * 
     */
    function index() {
        $likeDislike=array();
	$likeDislikeNew=array();
        if (!$this->tank_auth->is_logged_in()) {  // si l'utilisateur n'est pas loggu�      
			$this->load->model('books');
			$this->load->model('admin_model');
			$this->load->model('social_model');
			$data['css'] = $this->config->item('css'); 
			$data['word'] = $this->admin_model->abusive_words_list();
			$data['books'] = $this->books->get_popular(4);
			foreach($data['books'] as $newData){
			     $ndata['user_id']=$this->session->userdata('user_id');
				 $ndata['book_id']=$newData->id;
				 
				 $likeDislike[$newData->id] = $this->books->likeDislikeCounter($ndata['book_id']);
				

			}
			$data['likeDislikeCount'] = $likeDislike;
			$data['likeDislikeCountNew'] = $likeDislikeNew;
			$data['likeDislikeCount'] = $likeDislike;
			$data['view'] = 'candidat/wallhome';
            $this->load->view('common/templates/wall-fixed',$data);
        } else { // s'il est loggu�
		
            $this->load->model('books');   
			$this->load->model('admin_model');
			$this->load->model('social_model');
			$data['css'] = $this->config->item('css'); 
			$data['word'] = $this->admin_model->abusive_words_list();
			$data['books'] = $this->books->get_popular(4);
			foreach($data['books'] as $newData){
			     $ndata['user_id']=$this->session->userdata('user_id');
				 $ndata['book_id']=$newData->id;
				 $res[$newData->id] = $this->social_model->is_fav_count($ndata);
				 $likeDislike[$newData->id] = $this->books->likeDislikeCounter($ndata['book_id']);
				 $likeDislikeNew[$newData->id] = $this->books->likeDislikeCounterNew($ndata['book_id'],$ndata['user_id']);

			}
			//print_r($res);
			//$var['like']=$likeDislike;
			//$data['books'] = array_merge($data['books'],$var); 
			$data['favcount'] = $res;
			//print_r($data['favcount']);
			$data['likeDislikeCount'] = $likeDislike;
			$data['likeDislikeCountNew'] = $likeDislikeNew;
			//print_r($data['likeDislikeCount']);
			//	print_r($likeDislikeNew);
			//echo "<pre>";print_r($data['likeDislikeCount']); die;
			$data['likeDislikeUid'] = $this->session->userdata('user_id');
			$data['view'] = 'candidat/wallhome';
            $this->load->view('common/templates/wall-fixed',$data);
        }
	}
	
	
	
	 /**
     * Accueil du site Candidat
     * Dispatche les utilisateurs entre loggu�s et non loggu�s
     * 
     */
    function bestbook() {
         
        if (!$this->tank_auth->is_logged_in()) {  // si l'utilisateur n'est pas loggu�      
			$this->load->model('books');
			$this->load->model('admin_model');
			$this->load->model('social_model');
			$data['css'] = $this->config->item('css'); 
			$data['word'] = $this->admin_model->abusive_words_list();
			$data['books'] = $this->books->get_bestbook(4);
			$likeDislike=array();
			
			foreach($data['books'] as $newData){
			     $ndata['user_id']=$this->session->userdata('user_id');
				 $ndata['book_id']=$newData->id;
				 
				 $likeDislike[$newData->id] = $this->books->likeDislikeCounter($ndata['book_id']);
				

			}
			$data['likeDislikeCount'] = $likeDislike;
			$data['likeDislikeCountNew'] = $likeDislikeNew;
			$data['likeDislikeCount'] = $likeDislike;
			$data['view'] = 'candidat/bookhome';
            $this->load->view('common/templates/wall-fixed',$data);
        } else { // s'il est loggu�
		
            $this->load->model('books');   
			$this->load->model('admin_model');
			$this->load->model('social_model');
			$data['css'] = $this->config->item('css'); 
			$data['word'] = $this->admin_model->abusive_words_list();
			$data['books'] = $this->books->get_bestbook(4);
			$likeDislike=array();
			$likeDislikeNew=array();
			foreach($data['books'] as $newData){
			     $ndata['user_id']=$this->session->userdata('user_id');
				 $ndata['book_id']=$newData->id;
				 $res[$newData->id] = $this->social_model->is_fav_count($ndata);
				 $likeDislike[$newData->id] = $this->books->likeDislikeCounter($ndata['book_id']);
				 $likeDislikeNew[$newData->id] = $this->books->likeDislikeCounterNew($ndata['book_id'],$ndata['user_id']);

			}
			//print_r($res);
			//$var['like']=$likeDislike;
			//$data['books'] = array_merge($data['books'],$var); 
			$data['favcount'] = $res;
			//print_r($data['favcount']);
			$data['likeDislikeCount'] = $likeDislike;
			$data['likeDislikeCountNew'] = $likeDislikeNew;
			//print_r($data['likeDislikeCount']);
			//	print_r($likeDislikeNew);
			//echo "<pre>";print_r($data['likeDislikeCount']); die;
			$data['likeDislikeUid'] = $this->session->userdata('user_id');
			$data['view'] = 'candidat/bookhome';
            $this->load->view('common/templates/wall-fixed',$data);
        }
	}
	
	
	
	function abusive_comment(){
	         if(!$this->session->userdata('user_id')){
            redirect('auth/login');
            }
	       	$this->load->helper(array('form', 'url'));
		    $this->load->model('books');
		    $this->load->model('admin_model');
            $abusiveComments['caomment'] = $this->input->post('txtholder');
			$abusiveComments['id'] = $this->input->post('reportAbuseCategory');
			$abusiveComments['bookid'] = $this->input->post('bookId');
			$insert_id = $this->admin_model->abusive_comment($abusiveComments);
			if($insert_id !='')
			{
			$msg="success";
			}
			var_dump($msg);
			
			
			
			//header('HTTP/1.0 200 OK');
			//exit;

		    
	}
	
	function add_fav($book_id = null) {
        
        if(!$this->session->userdata('user_id')){
            redirect('auth/login');
        }
        
        if($this->input->post('book_id')){
			$data['book_id'] = $this->input->post('book_id');
            $data['user_id'] = $this->session->userdata('user_id');
            $this->load->model('social_model');
            $result = $this->social_model->add_fav($data);
            
            switch($result){
                case '1' :
                    $msg = "Ce book a bien �t� ajout� � vos favoris";
                    break;
                case '2' : 
                    $msg = "Ce book est d�j� dans vos favoris";
                    break;
                case '3' :
                    $msg = "Error";
                    break;
            } 
            echo($msg);  
        }else{
            if(isset($book_id)) {
                $data['book_id'] = $book_id;
                $data['user_id'] = $this->session->userdata('user_id');
                $this->load->model('social_model');
                $result = $this->social_model->add_fav($data);    
                redirect('wall');
            }
        }
    }
	
	function del_fav($book_id, $origin = null) {
        $this->load->model('social_model');
        $data['book_id'] = $this->input->post('book_id');
        $data['user_id'] = $this->session->userdata('user_id');
        $this->social_model->del_fav($data);
        if(isset($origin)) {
            switch($origin) {
                case 'book' :
                    redirect('book/show/'.$book_id);
                    break;
            }
        }else{
            redirect('social/favorites');
        }
    }
	
	
	function likeDislikeInser(){
	
	if(!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
	    $this->load->model('books');
		$data['status'] = $_POST['like'];
		$data['user_id'] = $_POST['likeUserId'];
		$data['book_id'] = $_POST['likeBookId'];
		$datakll['sucess']  = 'sucess';
		$result = $this->books->likeDislike($data); 
        redirect('wall',$datakll);
		
	}

}	
?>
