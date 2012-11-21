<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once "facebook/facebook.php";


class Fbconnect extends Facebook {
    
    public $user = null;
    public $user_id = null;
    public $fb = false;
    public $fbSession = false;
    public $appkey = 0;    
    
    function __construct() {
        
        $CI =& get_instance();       
        $CI->config->load('facebook');
        
        $this->config['appId'] = $CI->config->item('facebook_appId');
        $this->config['secret'] = $CI->config->item('facebook_secret');
        $this->config['fileUpload'] = $CI->config->item('facebook_fileUpload'); // optional  
        $this->scope = $CI->config->item('facebook_scope');
             
        parent::__construct($this->config);
        
        $this->user_id = $this->getUser();
        
        $me = null;
        
        if($this->user_id) {
            try {
                $me = $this->api('/me');
                $this->user = $me;
            }
            catch (FacebookApiException $e) {
                 error_log($e);
            }
        }
        
    }
    
}

?>
