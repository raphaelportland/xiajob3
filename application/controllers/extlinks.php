<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Contrôleur des liens externes au site
 * gère l'authentification via facebook
 * 
 */
class ExtLinks extends CI_Controller
{
    
    public function facebook_request($profile) {
        
        $this->load->library('fbconnect');
        
        $data = array(
            'redirect_uri' => site_url('extlinks/handle_facebook_login/'.$profile),
            'scope' => $this->fbconnect->scope,
            
        );
      
        redirect($this->fbconnect->getLoginUrl($data));
        
    }
    
    public function handle_facebook_login($profile) {
        
        $this->load->library('fbconnect');
        
        if($this->fbconnect->user) {            
            
            $facebook_user = $this->fbconnect->user;
            $facebook_user['profile'] = $profile;
            
            $this->load->model('user');            
            if($this->user->is_facebook_member($facebook_user['id'])) {
                // l'utilisateur a déjà un compte via facebook
                $this->user->facebook_log_in($facebook_user);
                redirect('main');
            } else {                
                if($this->user->is_site_member($facebook_user['email'])) {
                    // l'utilisateur a déjà un compte sur le site, mais pas via facebook
                    $this->user->facebook_merge_account($facebook_user);
                    $this->user->facebook_log_in($facebook_user);
                    redirect('main');
                } else {
                    // l'utilisateur n'a pas de compte du tout    
                    $this->user->facebook_sign_in($facebook_user);
                    $this->user->facebook_log_in($facebook_user);
                    redirect('main');
                }
            }
        }
        else {
            echo("Connexion via facebook impossible");
        }
        
    }
    
}
   