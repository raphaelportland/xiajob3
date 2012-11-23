<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controleur global
 * Ne sert qu'à rediriger entre les controleur Fleurjob(candidat)
 * et recruteur
 * 
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
            
            $this->load->model('generic_user');            
            if($this->generic_user->is_facebook_member($facebook_user['id'])) {
                // l'utilisateur a déjà un compte via facebook
                $this->generic_user->facebook_log_in($facebook_user);
                redirect('fleurjob');
            } else {                
                if($this->generic_user->is_site_member($facebook_user['email'])) {
                    // l'utilisateur a déjà un compte sur le site, mais pas via facebook
                    $this->generic_user->facebook_merge_account($facebook_user);
                    $this->generic_user->facebook_log_in($facebook_user);
                    redirect('fleurjob');
                } else {
                    // l'utilisateur n'a pas de compte du tout    
                    $this->generic_user->facebook_sign_in($facebook_user);
                    $this->generic_user->facebook_log_in($facebook_user);
                    redirect('fleurjob');
                }
            }
        }
        else {
            echo("Connexion via facebook impossible");
        }
        
    }
    
}
   