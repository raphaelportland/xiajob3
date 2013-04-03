<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*
*/

class Wall2 extends CI_Controller
{
          
    /**
     * Accueil du site Candidat
     * Dispatche les utilisateurs entre loggués et non loggués
     * 
     */
    function index() {
         
        if (!$this->tank_auth->is_logged_in()) {  // si l'utilisateur n'est pas loggué      
			$this->load->model('books');
			$this->load->model('admin_model');
			$this->load->model('social_model');
			$data['css'] = $this->config->item('css'); 
			$data['word'] = $this->admin_model->abusive_words_list();
			$data['books'] = $this->books->get_popular(4);
			$likeDislike=array();
			
			foreach($data['books'] as $newData){
			     $ndata['user_id']=$this->session->userdata('user_id');
				 $ndata['book_id']=$newData->id;
				 
				 $likeDislike[$newData->id] = $this->books->likeDislikeCounter($ndata['book_id']);
				

			}
			$data['likeDislikeCount'] = $likeDislike;
			$data['likeDislikeCountNew'] = $likeDislikeNew;
			$data['likeDislikeCount'] = $likeDislike;
			$data['view'] = 'candidat/wallhome';
            $this->load->view('common/templates/wall-fixed2',$data);
        } else { // s'il est loggué
		
            $this->load->model('books');   
			$this->load->model('admin_model');
			$this->load->model('social_model');
			$data['css'] = $this->config->item('css'); 
			$data['word'] = $this->admin_model->abusive_words_list();
			$data['books'] = $this->books->get_popular(4);
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
			$data['view'] = 'candidat/wallhome';
            $this->load->view('common/templates/wall-fixed2',$data);
        }
	}
	
	function abusive_comment(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtholder', 'Not To Be Blank', 'required');
		$this->load->model('books');
		$this->load->model('admin_model');
		$data['css'] = $this->config->item('css'); 
		$data['sliderjs'] = $this->config->item('sliderjs');
		$data['word'] = $this->admin_model->abusive_words_list();
		$data['books'] = $this->books->get_popular(4);
		$data['view'] = 'candidat/wallhome';
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('common/templates/wall-fixed',$data);
		}else{
 		    $abusiveComments['caomment'] = $_REQUEST['txtholder'];
			$abusiveComments['id'] = $_REQUEST['reportAbuseCategory'];
			$abusiveComments['bookid'] = $_REQUEST['bookId'];
			$insert_id = $this->admin_model->abusive_comment($abusiveComments);
			if(isset($insert_id)){
			     $data['msg']="Comment Reported Sucessfully!";
			}else{
				$data['msg']="Comment Is Not Reported Sucessfully!";	
			}
			$this->load->view('common/templates/wall-fixed',$data);
		}
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
        $data['book_id'] = $book_id;
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