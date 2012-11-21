<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur des books
 * 
 * 
 */
class Comments extends CI_Controller
{
    
    function show_by_pic($pic_id, $ajax = null) {
        $this->load->model('comments_model');
        $data['comments'] = $this->comments_model->get_pic_comments($pic_id);
        
        if($this->input->post('ajax') || isset($ajax)) {
            $data['comments']->pic_id = $pic_id;
            $data['comments']->max_comments_to_display = 3;
            $this->load->view('comments/pic_comments_mini',$data['comments']); 
        } else {
            $this->load->model('books');
            $data['pic'] = $this->books->get_pic_by_id($pic_id);
            $data['view'] = 'comments/pic_comments';
            $this->load->view('candidat/templates/public',$data);
        }
    }
    
    /**
     * Enregistre le commentaire
     * @param int
     */
    function save_comment($pic_id) {
        
        $this->load->model('comments_model');
        
        if($this->input->post('ajax')) {
            
            $data['pic_id'] = $pic_id;
            $data['user_id'] = $this->session->userdata('user_id');
            $data['comment'] = $this->input->post('comment');    
            
            $this->comments_model->save_comment($data);        
            
            redirect('comments/show_by_pic/'.$pic_id.'/ajax');
            
        } elseif($this->input->post('submit')) {
            
            $data['pic_id'] = $pic_id;
            $data['user_id'] = $this->session->userdata('user_id');
            $data['comment'] = $this->input->post('comment');   
            
            $this->comments_model->save_comment($data);
            
            redirect('comments/show_by_pic/'.$pic_id);
            
        } else {
            
            return 'error';
            
        } 
            
        

        
    }
    
    
}
