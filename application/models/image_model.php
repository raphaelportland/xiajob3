<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  
 *  Travaille sur les images
 * 
 */
class Image_model extends CI_Model {
    
    
    
    function create_main_image($data) {
        
        $name = $data['file_name'];
        
        
        
        $config['image_library'] = 'gd2';
        $config['source_image'] = '/path/to/image/mypic.jpg';
        $config['maintain_ratio'] = TRUE;
        $config['width']     = 800;
        $config['height']   = 600;
        
        $this->load->library('image_lib', $config); 
        
        $this->image_lib->resize();        
    }
    
    
    
}    