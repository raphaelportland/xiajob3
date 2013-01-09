<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH. 'models/tank_auth/users.php');

class Generic_user extends Users {

    /**
     * L'id de l'utilisateur dans la table users
     */
    public $user_id;
  
    /**
     * Prénom
     */
    public $first_name;
    
    /**
     * Nom de famille
     */
    public $last_name;
    
    /**
     * Nom complet
     */
    public $full_name;
    
    /**
     * Pseudo, utilisé pour communiquer anonymement
     */
    public $username;
    
    /**
     * Date de naissance
     */
    public $dob;
    
    /**
     * Type de compte (candidat, admin, recruteur...)
     */
    public $profile;   
    
    /**
     * Email de contact
     */    
    public $email;  
    
    /**
     * Téléphone mobile
     */   
    public $mobile_phone;
    
    /**
     * La description, cf. statut
     */
    public $description;
    
    /**
     * Adresse postale
     * Comprend plusieurs sous-attributs
     */
    public $address;
   
    /**
     * CV / Profil pro
     * Comprend plusieurs sous-attributs
     */
    public $resume = null;

    /**
     * Books
     * Contient le tableau des books, voir la classe Books
     */
    public $books;
    
    /**
     * Options
     * Contient le tableau des options
     */
    public $options;    
    
    
    /**
     * Constructeur de la classe
     * 
     * @param int
     */
    function __construct($user_id = null) {
        
        parent::__construct();   
        
        if(!isset($user_id)) {
            $this->user_id = $this->tank_auth->get_user_id();            
        } else {
            $this->user_id = $user_id;
        }
        
    }
    
    /**
     * Récupère les données sur l'utilisateur
     * en fonction de la liste des paramètres demandés
     * -Complétée par la fonction get_candidat() de la classe Candidat
     * 
     * @param int $user_id
     * @param array $params
     * @return object
     */
    function get_user($params = null) {
                
        if(isset($params)) {
            extract($params);
        }
        
        // si l'id n'est pas défini dans les paramètres, on prend celui de l'objet (celui de l'utilisateur courant)
        if(!isset($user_id)) { $user_id = $this->user_id; }

        // dans tous les cas on récupère les infos de base
        if($user = $this->get_user_basic_infos($params)) {
        
            // récupération des options           
            if(isset($with_options)) :
                
                $q = $this->db
                        ->where('user_id',$user_id)
                        ->get('user_options');
                
                if(!isset($user->options)) $user->options = new stdClass();
                
                if($q->num_rows() > 0) :
                    foreach ($q->result() as $key => $option) {
                        
                       $opt_name = $option->option;
                       $opt_value = $option->value;
                        
                       $user->options->$opt_name = $opt_value;
                    } 
                endif;
            endif;
            
            // récupération des books
            if(isset($with_books)) :
                $this->load->model('books', 'book_model');
                
                if(!isset($books_params)) :
                    $books_params = array();
                endif;
                
                $user->books = $this->book_model->get_library($books_params);
                
              
                
               // $user->books = $this->get_all_user_books($user_id);
            endif;     
            
            // récupération des favoris
            if(isset($with_favorites)) :
                $this->load->model('social_model');
                $user->favorites = $this->social_model->get_user_favs($user_id);
            endif;
            
                   
            
            if(isset($with_address)) :
                // récupération de l'adresse
                $q = $this->db
                        ->where('user_id', $user_id)
                        ->get('user_address');
                
                if($q->num_rows() > 0) :
                    
                    $ad = $q->row();
                    
                    $user->address = new stdClass();
                                    
                    $user->address->street = $ad->street;
                    $user->address->complement = $ad->complement;
                    $user->address->postcode = $ad->postcode;
                    $user->address->city = $ad->city;
                    $user->address->country = $ad->country;
                    
                else:
                    $user->address = null;
                    
                endif;
                
                
                // description
                if(isset($with_description)) {
                    $q = $this->db->where('user_id', $user->id)->get('user_description');
                    if($q->num_rows() == 1 && $q->row()->description != '') {
                        $user->description = $q->row()->description;
                    } else {
                        $user->description = 'aucune description';
                    }
                }
                
                
            endif;
                
            // resume : dans la classe Candidat
            if(isset($with_resume)) :                
                $this->load->model('candidat');
                $user->resume = new stdClass();
                
                if(isset($with_awards)) :
                    $user->resume->awards = $this->candidat->get_awards();
                endif;
                       
                if(isset($with_diplomas)) :
                    $user->resume->diplomas = $this->candidat->get_diplomas();
                endif;
                
                if(isset($with_xppro)) :       
                    $user->resume->xppro = $this->candidat->get_xppro();
                endif;
                
                if(isset($with_skills)) :       
                    $user->resume->skills = $this->candidat->get_skills();                
                endif;  
                
                if(isset($with_computer_skills)) :       
                    $user->resume->computer_skill = $this->candidat->get_computer_skill();
                endif;    
            endif;            
                  
            if(isset($with_description)) :
                $user->description = $this->candidat->get_description();
            endif;      
            
            return $user;
            
        } else { return false; }             
        
        
    }



    /**
     * renvoie les infos de base sur un utilisateur
     * @param array
     * @return object
     */
    function get_user_basic_infos($params = null) {
        
        if(isset($params)) {
            extract($params);
        }
        
        // si l'id n'est pas défini dans les paramètres, on prend celui de l'objet (celui de l'utilisateur courant)
        if(!isset($user_id)) { $user_id = $this->user_id; }
        
        $this->db->select('*, user_data.username as pseudo');
                
        $this->db->from('users')
            ->join('user_data','user_data.user_id = users.id')
            ->where('users.id',$user_id);
                
        $q = $this->db->get();
                
        if($q->num_rows() > 0) {
            
            $user = $q->row();
            
            $basic_info = new stdClass();
            $basic_info->id = $user_id;
            $basic_info->first_name = $user->prenom;
            $basic_info->last_name = $user->nom;
            $basic_info->full_name = $user->prenom. ' ' .$user->nom;
            $basic_info->username = $user->pseudo;
            $basic_info->profile = $user->profile;
            $basic_info->email = $user->email;
            
            
            if(isset($with_phone)) :
                $basic_info->mobile_phone = $user->mobile_phone;
            endif;
            
            if(isset($with_dob)) :
                $basic_info->dob = $user->dob;     
            endif;    
            
            if(isset($with_member_since)) {
                $basic_info->member_since = strtotime($user->created);
            }                   
            
            
            // traitement du pseudo
            
            if($basic_info->username == '') {
                if($basic_info->first_name != '') {               
                    $basic_info->username = $basic_info->first_name;
                } else {                
                    $decoup = explode('@',$basic_info->email);
                    $basic_info->username = $decoup[0];
                }
            }        
            
            return $basic_info;
        } else {
            return false;
        }
    }
    
    
    
    /**
     * Récupère tous les books d'un user
     * 
     * @param int
     * @return object
     */
    function get_all_user_books($user_id) {
        
            
            $q = $this->db->select('id')->from('user_book')->where('user_id', $user_id)->get();
            if($q->num_rows() == 0) {
                return null;
            } else {
                
                $q = $this->db
                ->select('user_book.id, user_book.name, user_book.description, user_book.short_url, 
                occasions.occasion_name')
                ->where('user_book.user_id', $user_id)
                ->select('count(fj_book_pics.id) as pic_nb')
                ->from('user_book')
                ->join('book_pics','book_pics.book_id = user_book.id')
                ->join('occasions','occasions.id = user_book.id_occasion')
                ->get();                
            
                $this->load->model('books','book_model');
                foreach ($q->result() as $key => $book) {
                    
                    $this->books[] = $book;
                    return $this->books;
                }
            }     
    }
    
    
    
    /**
     * Vérifie si l'id facebook est dans la table users
     * 
     */    
    function is_facebook_member($facebook_id) {
        $q = $this->db->where('facebook_id',$facebook_id)->get('users');
        if($q->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    
    
    
    /**
     * Récupère le nom d'usage de l'utilisateur
     * et le place en session
     * @return string
     */
    function get_username($user_id = null) {
        
        if(!isset($user_id)) {
            $user_id = $this->user_id;
        }
        
        if(isset($this->username)) {

            
        } else {
            
            $q = $this->db->select('prenom, nom, user_data.username, users.email')
            ->from('user_data')
            ->join('users', 'users.id = user_data.user_id')
            ->where('users.id', $user_id)
            ->get();
            
            $result = $q->row();
            
            if($result->username != '') {
                $this->username = $result->username;
            } elseif($result->prenom != '') {                            
                $this->username = $result->prenom;                
            } else {                
                $decoup = explode('@',$result->email);
                $this->username = $decoup[0];  
                               
            } 
            
            if($user_id == $this->session->userdata('user_id')) :           
                $this->session->set_userdata('username', $this->username);
            endif;
                         
            return $this->username;
                  
        }
        
        
    }
    
    
    
    
    
    
    /**
     * Vérifie si l'email est dans la table users
     * 
     */
    function is_site_member($email) {
        $q = $this->db->where('email',$email)->get('users');
        if($q->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    
    
    /**
     * Log l'utilisateur qui utilise facebook
     * 
     */
    function facebook_log_in($facebook_user) {
        
        // on récupère l'id de l'utilisateur
        $q = $this->db->select('users.facebook_id, users.id, user_data.optin_cgu')
                ->from('users')
                ->join('user_data', 'users.id = user_data.user_id')
                ->where('facebook_id',$facebook_user['id'])
                ->get();
        
        if($q->num_rows() == 1) :
            
            $user = $q->row();
            
            $this->user_id = $user->id;            
            $username = $this->get_username($user->id);
            
            // on vérifie s'il a accepté les CGU
            if($user->optin_cgu != 1) {
                // si ce n'est pas le cas on le redirige vers les CGU
                $secret_session = serialize(array(
                    'user_id' => $user->id,
                    'user_name' => $username,
                    'status' => '1',
                ));
                    
                $this->session->set_userdata('secret_session',$secret_session);
                redirect('pages/cgu');
            }          
            
            // on met l'utilisateur en session
            $this->session->set_userdata(array(
                    'user_id'   => $user->id,
                    'username'  => $username,
                    'status'    => '1',
            )); 
            
            // on lui crée son autologin
            //$this->load->library('tank_auth');
            //$this->tank_auth->create_autologin($user_id);              
            
            // on met à jour les paramètres de log-in
            $this->update_login_info(
            $user->id,
            $this->config->item('login_record_ip', 'tank_auth'),
            $this->config->item('login_record_time', 'tank_auth'));            
                        
        endif;               
    }
    
    
    function valid_cgu() {
        $secret_session = $this->session->userdata('secret_session');
        $infos = unserialize($secret_session);
        
        // on met à jour la variable optin_cgu
        $this->db->where('user_id', $infos['user_id'])->update('user_data', array('optin_cgu' => 1));        
        
        // on met l'utilisateur en session pour de bon
        $this->session->set_userdata($infos);
            
        // on met à jour les paramètres de log-in
        $this->update_login_info(
        $infos['user_id'],
        $this->config->item('login_record_ip', 'tank_auth'),
        $this->config->item('login_record_time', 'tank_auth'));
        redirect('main');        
    }    
    
    
    
    
    /**
     * L'utilisateur n'a pas de compte, 
     * on lui crée un compte via facebook
     * 
     */
    function facebook_sign_in($facebook_user) {
        
        
        //stop_code($facebook_user);
        
        
        $data['created'] = date('Y-m-d H:i:s');
        $data['activated'] = 1; // les comptes facebook sont directement activés
        $data['password'] = "";
        $data['username'] = "";
        $data['email'] = $facebook_user['email'];
        $data['facebook_id'] = $facebook_user['id'];
        

        $this->db->insert('users', $data);
        $this->user_id = $this->db->insert_id();
        
        $options = array(
            'profile_step' => '1',
        );
        
        $this->register_options($options);
        
        $english_dob = $facebook_user['birthday'];
        $elemt = explode('/',$english_dob);
        $french_dob = $elemt[1].'/'.$elemt[0].'/'.$elemt[2];
        
        $user_data = array(
            'user_id' => $this->user_id,
            'profile' => $facebook_user['profile'],
            'prenom' => $facebook_user['first_name'],
            'nom' => $facebook_user['last_name'],
            'dob' => $french_dob, 
            'username' => $facebook_user['first_name'],                    
        );
         
        $this->register_userdata($user_data);
        
        
        $this->create_profile($this->user_id);
    }
    
    
    
    
    /**
     * Crée le profil de l'utilisateur dans la table user_data
     * @param array
     * 
     */
    function register_userdata($user_data) {
        
        $this->db->insert('user_data', $user_data);
        
    }    
    
    
    
    
    /**
     * L'utilisateur a déjà un compte sur le site,
     * on regroupe ses infos avec les données facebook
     * pour lui permettre la double connexion
     * 
     */
    function facebook_merge_account($facebook_user) {     
        $this->db->where('email',$facebook_user['email'])
        ->update('users', array('facebook_id' => $facebook_user['id']));
    }
    
    
    


    
    
    
    /**
     * Teste qui blackboule l'utilisateur qui n'est pas loggué
     * avec le profil attendu
     * 
     */
    function login_test($expected_profile = null) {
        
        $this->load->library('tank_auth');
        
        if(!$this->tank_auth->is_logged_in()) : 
            redirect('main');
            die;
        else :              
            $profile = $this->profile();
            $this->profile = $profile;
            
            if(($expected_profile != null) && ($profile != $expected_profile)) : redirect('main');
            die;
            endif;
        endif;
    }




    
    
    
    
        
    /**
     * Supprime l'utilisateur
     * de toutes les tables
     * 
     */
    function delete_user() {
        
        $this->db->delete('users', array('id' => $this->user_id)); 
        $this->db->delete('user_profiles', array('user_id' => $this->user_id));
        $this->db->delete('user_autologin', array('user_id' => $this->user_id));
        $this->db->delete('user_options', array('user_id' => $this->user_id));
        $this->db->delete('user_recomp', array('user_id' => $this->user_id));
        $this->db->delete('user_formations', array('user_id' => $this->user_id));
        $this->db->delete('user_expepro', array('user_id' => $this->user_id));
        $this->db->delete('user_description', array('user_id' => $this->user_id));
        $this->db->delete('user_custom_comp', array('user_id' => $this->user_id));
        $this->db->delete('user_autoevaluation', array('user_id' => $this->user_id));  
        $this->db->delete('user_data', array('user_id' => $this->user_id));
        $this->db->delete('comments',array('user_id' => $this->user_id));
        
        $books = $this->get_all_user_books($this->user_id);
        
        if(isset($books)) {
            $this->load->model('books','books_model');
            foreach ($this->books as $key => $book) {
                $this->books_model->delete($book->id);
            }              
        }  
    }   



    
    
    /**
     * Renvoie le profil de l'utilisateur
     * candidat ou recruteur
     * 
     */
    function profile() {
        
        $q = $this->db
        ->select('profile')
        ->from('user_data')
        ->where('user_id', $this->user_id)
        ->get();
        
        if($q->num_rows() == 1) {
            return $q->row()->profile;
        } else {
            return false;
        }
    }    
    
    

    
    
    /**
     * Renvoie l'étape courante d'enregistrement
     * de l'utilisateur
     * 
     */
    function current_register_step() {
        
        if(isset($this->options->profile_step)) {
            return ($this->options->profile_step);     
        }
        
        else {
            $q = $this->db->select('value')
            ->from('user_options')
            ->where('user_id', $this->user_id)
            ->where('option', 'profile_step')
            ->get();
            
            if($q->num_rows() == 1) {
                return $q->row()->value;
            }
            else return false;
        }
         
    }



    
    
    
    /**
     * Met à jour l'étape d'enregistrement
     * et renvoie la nouvelle étape
     * 
     */
    function upgrade_register_step() {
        $current_step = $this->current_register_step();
        
        $profile = $this->profile();
        
        if((($profile == 'candidat') && ($current_step == 6)) || (($profile == 'recruteur') && ($current_step == 4))) : $next_step = 'finished';
        else : $next_step = $current_step + 1;
        endif;
        
        $data = array(
        'option' => 'profile_step',
        'value' => $next_step,
        );

        $this->db
            ->where('user_id',$this->user_id)
            ->where('option','profile_step')
            ->update('user_options',$data);          
        
        return $next_step;
    }
    
    




    /**
     * Récupère toutes les options de l'utilisateur
     * et les renvoie
     * 
     */
    function all_options() {
        
        $q = $this->db
                ->where('user_id',$this->user_id)
                ->get('user_options');
                
        $options = new stdClass();  
        
        if($q->num_rows() > 0) :
                      
            foreach ($q->result() as $key => $option) {
                
                // on retire les - pour faire des variables ok
                $name = str_replace('-','',$option->option);
                
                $options->$name = $option->value;;
            }
        
        else :
            $options = null;
            
        endif;
        
        return($options);   
    }
    
    
    
    
    
    
    
    
    
    
    
    /**
     * Met à jour les options
     * de l'utilisateurs qui sont passées
     * en source
     * 
     */
    function update_options($source) {

        foreach ($source as $key => $option) {

            $option['user_id'] = $this->user_id;
            
            // il faut d'abord récupérer les options
            $current_options = $this->all_options();
                    
            if(isset($current_options->$option['option'])) :
                $this->db
                    ->where('user_id',$this->user_id)
                    ->where('option',$option['option'])
                    ->update('user_options',$option);                             
            else :
                
                $this->db->insert('user_options',$option);
                
            endif;

        }        
        $flashmessage = "Options mises à jour.";
        $this->session->set_flashdata('message', $flashmessage); 
    }
    
 
 
 
 
 
 
 
    /**
     * Enregistre les options en base de données
     * Attention, il s'agit d'un insert, ce n'est pas adapté pour un update.
     * 
     * 
     */
    function register_options($data) {
        
        $options = array();
        
        $i = 0;
        
        foreach ($data as $option => $value) {
            $options[$i]['user_id'] = $this->user_id;
            $options[$i]['option'] = $option;
            $options[$i]['value'] = $value;
            $i++;
        }
        
        $this->db->insert_batch('user_options',$options);
        
    } 
    
     
    
    
    
    
    
    

    
    /**
     * Vérifie si l'utilisateur a un book,
     * renvoie true ou false
     * 
     */
    function has_book() {
        
        $q = $this->db
                ->where('user_id',$this->user_id)
                ->get('user_book');
                
        if($q->num_rows() > 0) {
            
            return true;
            
        }
        else {
            return false;
        }
        
    }


    
    
    
    
      
    
    
    
    

        
    
    






    
    
    /**
     * change l'id du candidat
     * 
     * @param int
     */
    function set_id($user_id) {
        $this->user_id = $user_id;
    }
    
    
    /**
     * Vérifie que l'utilisateur est propriétaire
     * de la photo indiquée
     * 
     */
    function is_pic_owner($pic_id) {
        
        $q = $this->db
                ->from('user_book')
                ->join('book_pics', 'book_pics.book_id = user_book.id')
                ->where('user_id',$this->user_id)
                ->where('book_pics.id',$pic_id)
                ->get();
                
        if($q->num_rows() > 0) { return true; }               
        else { return false; }       
    }
    
    
    /**
     * Renvoie vrai si l'utilisateur est bien le propriétaire du book
     * faux si ce n'est pas le cas
     * 
     */
    function is_book_owner($book_id) {
        $q = $this->db
            ->where('user_id', $this->user_id)
            ->where('id', $book_id)
            ->get('user_book');
            
        if($q->num_rows() > 0) { return true; } 
        else { return false; }
    }
    
    
    
    /**
     * Met à jour le profil de l'utilisateur
     * 
     * @param int
     * @param array
     */
    function update_profile($step, $source) {
        unset($source['register']);
        
        switch ($step) {
            
            case '0': // LE PROFIL DE BASE
                         
                // on enregistre les options si elles existent
                $options = array();
                
                if(isset($source['status'])) {
                    $options[0]['option'] = 'status';
                    $options[0]['value'] = $source['status'];
                    
                    unset($source['status']);
                }              
                $this->update_options($options);

                
                // on enregistre l'adresse
                if(isset($source['ad1'])) { $address['street'] = $source['ad1']; }
                else { $address['street'] = ''; }
                
                if(isset($source['ad2'])) { $address['complement'] = $source['ad2']; }
                else { $address['complement'] = ''; }
                
                if(isset($source['postcode'])) { $address['postcode'] = $source['postcode']; }
                else { $address['postcode'] = ''; }
                
                if(isset($source['city'])) { $address['city'] = $source['city']; }
                else { $address['city'] = ''; }
                
                if(isset($source['country'])) { $address['country'] = $source['country']; }
                $this->update_address($address);

                 
                // on enregistre les user_data
                if(isset($source['prenom'])) { $user_data['prenom'] = $source['prenom']; }
                else { $user_data['prenom'] = ''; }
                
                if(isset($source['nom'])) { $user_data['nom'] = $source['nom']; }
                else { $user_data['nom'] = ''; }
                
                if(isset($source['username'])) {
                    $this->session->set_userdata('username', $source['username']);
                    $user_data['username'] = $source['username']; 
                }
                else { $user_data['username'] = ''; }
                


                if(isset($source['dob'])) { $user_data['dob'] = $source['dob']; }
                else { $user_data['dob'] = ''; }

                if(isset($source['mobile'])) { $user_data['mobile_phone'] = $source['mobile']; }
                else { $user_data['mobile_phone'] = ''; }
                
                $this->update_userdata($user_data);
                
                               
                break;
            
            default:
                
                break;
        }
    }

    /**
     * Met à jour ou ajoute l'adresse de l'utilisateur
     * 
     * @param array
     */
    function update_address($address) {
        
        $address['user_id'] = $this->user_id;                 
                   
        if(!$this->address) {
           $this->db->insert('user_address', $address);
        } else {
           $this->db
           ->where('user_id', $this->user_id)
           ->update('user_address',$address);
        } 
       
    }
    
    /**
     * Met à jour la table user_data avec les informations passées
     * 
     * @param array
     */
    function update_userdata($user_data) {
        
        $this->db->where('user_id', $this->user_id)
        ->update('user_data', $user_data);
        
    }
    
    
    
    /**
     * Teste si l'utilisateur est administrateur
     * 2013/01/07
     * 
     * @return bool
     */
    function is_admin() {
        
        if (!$this->tank_auth->is_logged_in()) {  // si l'utilisateur n'est pas loggué 
        
            return false;
        
        } else {        
        
            $user_id = $this->session->userdata('user_id');
            
            $q = $this->db->where('user_id', $user_id)
            ->where('option', 'is_admin')
            ->where('value', 1)
            ->get('user_options');
            
            if($q->num_rows() == 1) {
                return true;
            } else {
                return false;
            }
        }
    }
    

    
}