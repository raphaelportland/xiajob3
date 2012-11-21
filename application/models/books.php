<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Classe Books
 * 
 * Définit les books utilisés sur le site
 * 
 * @package florBooks
 * @subpackage models
 * @author Raphaël Malaizé
 */
class Books extends CI_Model {
 
 
    /**
     * Identifiant du book
     * @var int $id
     */
    public $id;
    
    /**
     * Titre du book
     * @var string $name
     */
    public $name;
    
    /**
     * Description du book
     * @var string $description
     */
    public $description;
    
    /**
     * Adresse bitly du book
     * @var string $short_url
     */
    public $short_url;
    
    /**
     * Occasion du book (mariage, autre)
     * @var object $occasion
     */
    public $occasion;
    
    /**
     * Propriétaire du book
     * @var object $owner
     */
    public $owner;    
    
    /**
     * Tableau des photos du book
     * @var array $pictures
     */
    public $pictures;
    
    
    
      
    
    
    
    /**
     * Pas utilisés
     * @deprecated
     */
    public $order;
    
    /**
     * @deprecated
     */ 
    public $private_key;        


    // la langue à utiliser, notamment pour les fleurs
    private $lang;
    
 
 
    /**
     * Librairie de books, 
     * 
     * utilisée quand on sort une collection de books
     * contient d'autres attributs (latest, featured...)
     * 
     * @var array $books
     */   
    public $books;
    
    
    /**
     * Constructeur
     * 
     * @param int $owner
     */
    function __construct($owner = null) {
        
        parent::__construct();   
        
        if($owner == null) {
            $this->owner = $this->tank_auth->get_user_id();            
        } else {
            $this->owner = $owner;
        } 
        
        $this->owner = new stdClass();
        $this->books = new stdClass();
        $this->data = new stdClass();
        $this->temp = new stdClass();
        $this->occasion = new stdClass();
    } 
   
    

    /**
     * Getters et Setters
     */    

    function set_owner($user_id) { $this->owner->id = $user_id; }    
    function get_owner() { return $this->owner; }  
        
    function set_lang($lang) { $this->lang = $lang; }

    
    
    
     
    
    
    /**
     * Récupère les books les plus récents
     * et les place dans data->latest
     * 
     * @param int $nb
     * @return object
     */
    function get_recent($nb = 'all') {
        
        
        $this->db->select('*, user_book.id as book_id, occasions.id as occasion_id');
        $this->db->from('user_book');
        $this->db->join('occasions', 'occasions.id = user_book.id_occasion');          
        
        
        $this->db->order_by('user_book.id','desc');
                
        if($nb != 'all') {
            $this->db->limit($nb);
        }
                
        $q = $this->db->get();

        $result = $q->result();
                               
        foreach ($result as $key => $book) {
            
            $result[$key]->pictures = $this->get_pictures($book->book_id);
            
        }      
        
        $this->books->latest = $result;
        return $this->books->latest;
    } 
    
    
    
    /**
     * Renvoie les books mis en avant par l'équipe florbook
     * 
     */
    function get_featured_books($nb = 'all') {
        
        $this->db->select('book_id')->order_by('id','desc');
                
        if($nb != 'all') {
            $this->db->limit($nb);
        } 
        
        $q = $this->db->get('featured_books');
        
        $result = $q->result();
        
        // la librairie de books vide
        $books = array();
                               
        foreach ($result as $key => $book) {          
            $books[$key] = $this->get_book_by_id($book->book_id);           
        }
        
        //code($books);
        
        $this->books->featured = $books;
        return $this->books->featured;        
    }
    
    
    
    
    /**
     * Ajoute les miniatures aux books chargés
     * 
     */
    function prepare_thumbs() {
        
        // Pour les books plus récents
        foreach ($this->data->latest as $key => $book) {
            $q = $this->db
                    ->where('book_id', $book->id)
                    ->limit(1)
                    ->get('book_pics');
                    
            $book->cover = $q->row();
        }
        
    }    
 
 

    
    
    
    /**
     * Récupère le prochain numéro d'ordre des
     * books de l'utilisateur
     * renvoie 1 si pas encore de book
     * 
     */
    function get_next_book_order($user_id) {  
       $q = $this->db
                ->select('order')
                ->from('user_book')
                ->where('user_id', $user_id)
                ->get();
                
       if($q->num_rows() > 0) {
           return $q->row()->order + 1;
       } else {
           return 1;
       }       
    }
        
    
    
    /**
     * Renvoie la liste des fleurs identifiées
     * sur une photo
     * 
     */
    function get_pic_flowers($pic_id) {
       
       // on récupère les fleurs de la base officielle      
       
       $q = $this->db->select('*')->from('fleurs')->join('pic_flowers', 'pic_flowers.flower_id = fleurs.id')
       ->where('pic_flowers.pic_id',$pic_id)->get();
       
       $flowers = null;
       
       if($q->num_rows() > 0) { $flowers['official'] = $q->result(); }
       
       // on récupère les fleurs de la base utilisateurs
       
       $q = $this->db->where('pic_id',$pic_id)->get('user_flowers');
       
       if($q->num_rows() > 0) { $flowers['custom'] = $q->result(); }
       
       return $flowers;
        
    }
    
    /**
     * Récupère une photo
     * 
     * @param int
     * @param bool
     * @param bool
     * @return object
     */
    function get_pic_by_id($pic_id, $with_comments = false, $with_flowers = true) {
        
        $this->pic_data = new stdClass();
      
        $q = $this->db
            ->where('id', $pic_id)
            ->get('book_pics'); 
            
        if($q->num_rows() > 0) :
        
            $this->pic_data = $q->row();
            if($with_flowers) $this->pic_data->flowers = $this->get_pic_flowers($pic_id);
            
            if($with_comments) :
                $this->load->model('comments_model');
                $this->pic_data->comments = $this->comment_model->get_pic_comments($pic_id);
            endif;
            
            return $this->pic_data;
        else :
            return false;
        endif;      
    }
    
    
    
    
    /**
     * Récupère l'adresse de la miniature de l'image
     * 
     */
    function get_pic_thumb($pic_id) {
        $q = $this->db
        ->select('th_url')
        ->where('id', $pic_id)
        ->get('book_pics');
        
        if($q->num_rows() > 0){
            return $q->row()->th_url;
        } else {
            return false;
        }
    }
    
    
    
    
    
    /**
     * Efface l'association entre la fleur et la photo
     * agit sur la base officielle
     * 
     */
    function del_pic_flower($pic_id, $flower_id) {
        $this->db
        ->where('pic_id',$pic_id)
        ->where('flower_id',$flower_id)
        ->delete('pic_flowers');
    }
    
    /**
     * Efface l'association entre la fleur et la photo
     * agit sur la base custom
     * 
     */
    function del_pic_custom_flower($pic_id, $flower_id) {
        $this->db
        ->where('pic_id',$pic_id)
        ->where('id',$flower_id)
        ->delete('user_flowers');
    }
    
   
        
    /**
     * Enregistre une fleur sur une image
     */
    function save_pic_flower($pic_id, $flower_complete_name) {
        
        $this->temp->pic_id = $pic_id;
        
        $flower = $this->get_flower_by_complete_name($flower_complete_name);
        
        if($flower == false) :
                    
            // la fleur n'existe pas en base, on l'ajoute à la base "crade" : user_flowers
            $this->add_new_custom_flower($flower_complete_name);
            
        else :
            
            //code($this->temp);
            
            $this->add_pic_flower();
        
        endif;
  
    }
    
    /**
     * Associe une fleur de la base officielle
     * à une photo
     * Les données de la fleur on été mises dans $this->temp->flower par get_flower_by_complete_name()
     * 
     */
    function add_pic_flower() {
        
            $data = array(
                'pic_id' => $this->temp->pic_id,
                'flower_id' => $this->temp->flower->id,
            );
    
            $this->db->insert('pic_flowers',$data);          
    }
    
    
    function get_flower_by_complete_name($flower_name) {
        
        // on teste si la fleur existe dans la base officielle
        
        $q = $this->db
        ->where('name_'.$this->lang, $flower_name)
        ->get('fleurs');
        
        if($q->num_rows() > 0) {
            
            // la fleur existe
            
            $this->temp->flower = $q->row();
            return $this->temp->flower;
            
        } else {

            return false;
        }        
        
    }
    
    
    function add_new_custom_flower($complete_name) {
        
        $data = array(
        'custom_name' => $complete_name,
        'pic_id' => $this->temp->pic_id,
        );
        
        $this->db->insert('user_flowers',$data);
    }
    
    
    
    
    /**
     * Création d'un nouveau book
     * 
     */
    function create($source) {

        $this->load->helper('random_string_generator_helper');
        $book_private_key = random_string_generator(15,true,false,true,false);

        $book = array(
            'user_id' => $source['user_id'],
            'name' => $source['book_name'],
            'description' => $source['description'],
            'order' => $this->get_next_book_order($source['user_id']),
            'private_key' => $book_private_key,
            'id_occasion' => $source['occasion'],
            'short_url' => '',
        );
        
        $this->db->insert('user_book',$book);
        
        $book_id = $this->db->insert_id(); 
        
        //$book_url = base_url().'index.php/book/view/'.$book_id.'/'.$book_private_key;
        
        $book_url = base_url().'index.php/book/view/'.$book_id;
        
        $this->load->library('bitly');
        $short_url = $this->bitly->shorten($book_url); 
        
        $data = array(
            'short_url' => $short_url,
        );
        
        $this->db
            ->where('id',$book_id)
            ->update('user_book',$data);      
        
        return $book_id;
        
    }
    
    
    
    
    
    
    
    /**
     * Charge un book par son id
     * nécessite d'être un book de l'utilisateur
     * 
     * @param int
     * 
     * @return object
     * 
     */
    function load($book_id) {
       $q = $this->db
            ->select('*, user_book.id as book_id, occasions.id as occasion_id')
            ->where('user_book.id',$book_id)
            ->where('user_id',$this->owner)
            ->from('user_book')
            ->join('occasions', 'occasions.id = user_book.id_occasion')
            ->get();
            
       // l'objet book
       $book = new stdClass();     
            
       // les données brutes
       $book = $q->row();     
       $this->books = $book;
       
       // les informations sur le propriétaire
       $book->owner->fullname = $this->get_owner_fullname();
       $this->books->owner_fullname = $book->owner->fullname;
       
       // les photos
       $book->pictures = $this->get_pictures($book_id);
       $this->books->pictures = $book->pictures;        
       
       return $book;
    }
    
    
    
    
    
    
    /**
     * Charge un book par son id
     * 
     * @param int
     * @param bool
     * 
     * @return object
     * 
     */    
    function get_book_by_id($book_id, $comments = false) {
       $q = $this->db
            ->select('*, occasions.id as id_occasion, user_book.id as book_id, user_book.name as book_name')
            ->from('user_book')
            ->join('occasions', 'occasions.id = user_book.id_occasion')
            ->where('user_book.id', $book_id)
            ->get();
             
       if($q->num_rows() == 0) {
           return false;
       }
       
       $this_book = new stdClass();
       $this_book->occasion = new stdClass();
       
       $book = $q->row();
       
       $this_book->id = $book->book_id;
   
       $this_book->occasion->name = $book->occasion_name;

       $this_book->occasion->id = $book->id_occasion;
       
       $this_book->name = $book->name;
       
       $this_book->description = $book->description;
       
       $this_book->short_url = $book->short_url;
       
       // les informations sur le propriétaire
       $this->get_owner_by_id($book->user_id);
       
       // les photos
       $this_book->pictures = $this->get_pictures($book_id, $comments);      
       
       return $this_book;
    }


    /**
     * Récupère les infos de base sur le propriétaire du book
     */
    function get_owner_by_id($user_id) {
        
        $this->load->model('generic_user');
        $this->owner = $this->generic_user->get_user_basic_infos($user_id);
         
    }
    
    
    
    
    
    
    


    function get_owner_fullname() {
        $q = $this->db
                ->where('user_id',$this->owner->id)
                ->get('user_options');
                
        $options = new stdClass();                
        foreach ($q->result() as $key => $option) {
            
            // on retire les éventuel "-" pour faire des variables ok
            $name = str_replace('-','',$option->option);
            
            $options->$name = $option->value;;
        } 
        
        $prenom = 'John';
        $nom = 'Doe - Anonyme';
        
        if(isset($options->prenom)) { $prenom = $options->prenom; }
        if(isset($options->nom)) { $nom = $options->nom; }                       
             
        $fullname = $prenom.' '.$nom;
        
        $this->owner_fullname = $fullname;
        
        return($fullname);             
            
        //$this->books->owner_fullname = $q->result()->option->prenom;        
    }
    
    
    
    
    
    
    
    /**
     * Charge tous les books
     */
    function all_books($comments = false) {
        $q = $this->db
                ->where('user_id',$this->owner->id)
                ->get('user_book');
                
                
        if($q->num_rows() > 0) :
            
            foreach ($q->result() as $key => $book) {
                
                $this->books->book_list[] = $this->get_book_by_id($book->id, $comments);
                
            }
            
        else :
            return false;            
        endif;                
                
        return $this->books->book_list;
    }
    
    
    
    
    
    
    
    
    
    
    /**
     * Renvoie les photos enregistrées dans le book
     * 
     */
    function get_pictures($book_id, $comments = false) {
       $q = $this->db
            ->where('book_id',$book_id)
            ->get('book_pics'); 
            
       $pictures = new stdClass();
       
       if(!$q->num_rows() > 0) {
           $pictures->nb = 0;
       } else {
           $pictures->nb = $q->num_rows();           
       }

       $pictures->pics = $q->result();
       
       foreach ($pictures->pics as $key => $pic) {
           
           $pictures->pics[$key]->flower_data = $this->get_pic_flowers($pic->id);
           
           // on ajoute les commentaires si nécessaire              
           if($comments) {
               $this->load->model('comments_model');
               $pictures->pics[$key]->comments = $this->comments_model->get_pic_comments($pic->id); 
           }
          
       }
       
       return $pictures;
    }
    
    
    
    
    

    
    
    /**
     * Supprime le book et toutes les photos associées
     * et les commentaires !
     * 
     */
    function delete($id) {
        // on récupère les photos pour les effacer du disque
        $q = $this->db->select('id, pic_url, th_url')
        ->from('book_pics')
        ->where('book_id', $id)
        ->get();
        
        if($q->num_rows() > 0) :
            foreach ($q->result() as $key => $pic) {
                
                // on efface les photos du disque (principale et thumbnail)
                unlink($pic->pic_url);
                unlink($pic->th_url);
                
                // on efface les commentaires sur la photo
                $this->db->delete('comments',array('pic_id' => $pic->id));
                
                // on supprime les associations de fleurs
                $this->db->delete('pic_flowers', array('pic_id' => $pic->id));
                $this->db->delete('user_flowers', array('pic_id' => $pic->id));   
                
            }
        endif;     
        
        // on supprime les photos de la base de données
        $this->db->delete('book_pics', array('book_id' => $id));  
        
        // on supprime le book de la base de données   
        $this->db->delete('user_book', array('id' => $id));     
    }
    
    
    
    
    
    
    
    
    
    /**
     * Met à jour le book indiqué
     * ainsi que les photos
     * 
     */
    function update($source) {
        
        $i = 0;
        while(isset($source['pic_name'.$i])) :
            
            $pic_update = array(
            'pic_name' => $source['pic_name'.$i],
            'pic_comment' => $source['pic_desc'.$i],
            );
            
            $this->db
                ->where('id',$source['pic_id'.$i])
                ->update('book_pics',$pic_update);
                
            $i++;
            
        endwhile;
   
    }
    
    
    
    
    
    /**
     * Charge l'image dans le book
     *
     */
    function import_img($image) {
        
        $import = array(
        'pic' => $image->name,
        'book_id' => $image->book,
        'pic_url' => $image->url,
        'th_url' => $image->thumbnail_url,
        );
        
        $this->db->insert('book_pics',$import);
    }
    
    
    
    /**
     * Renvoie le lien privé d'accès au book
     * 
     */
    function get_private_key($book_id) {

        $q = $this->db
                ->select('private_key')
                ->from('user_book')
                ->where('user_id', $this->owner)
                ->where('id',$book_id)
                ->get();
                
        $infos = new stdClass();                
                            
        if($q->num_rows() > 0) {
            $infos->success = true;
            $infos->private_link = base_url().'index.php/book/view/'.$book_id.'/'.$q->row()->private_key;
        } else {
            $infos->success = false;
        }               
       
        return $infos;
       
    }
    
    
    
    /**
     * Effectue des recherches dans les books
     * 
     */
    function search($input) {
       
       //code($input);
       
       // on doit éclater l'input
       $keywords = explode(' ',$input);
       
       //code($keywords);
       
       $temp_result = array();
       
       // pour chaque mot clé on fait un recherche
       foreach ($keywords as $key => $keyword) {
           
           $sql = "SELECT * FROM fj_user_book WHERE name LIKE %".$keyword."%";
           
           
           
           $temp_result[] = $q->result()->id;
       }
       
       $result = $temp_result;
       
       $this->data->search = $result;
       return($result);
    }
    
    /**
     * Renvoie l'id du book contenant la photo indiquée
     * 
     */
    function parent_book($picture_id) {
        $q = $this->db
                ->select('user_book.id')
                ->from('user_book')
                ->join('book_pics', 'book_pics.book_id = user_book.id')
                ->where('book_pics.id',$picture_id)
                ->get();
                
        return $q->row()->id;
    }
    
    
    
    /**
     * Supprime la photo
     * renvoie l'id du book de la photo qui a été supprimée
     * 
     */
    function delete_pic($id) {
        $pic = $this->get_picture_urls($id);
        $return_book = $pic->book_id;
        // on supprime la photo du disque
        unlink($pic->pic_url);
        unlink($pic->th_url);
         
        // on supprime la photo de la base de données            
        $this->db->delete('book_pics', array('id' => $id));       
        
        // on supprime les associations de fleurs
        $this->db->delete('pic_flowers', array('pic_id' => $id));
        $this->db->delete('user_flowers', array('pic_id' => $id));    
            
        return $return_book;
    }
    
    
    
    /**
     * Renvoie les url de l'image et de sa miniature
     * pour une image donnée
     * @param int $pic_id
     * @return object;
     */
    function get_picture_urls($pic_id) {
        // on récupère les photos pour les effacer du disque
        $q = $this->db->select('id, pic_url, th_url, book_id')
        ->from('book_pics')
        ->where('id', $pic_id)
        ->get();
        
        if($q->num_rows() > 0) {
            return $q->row();
        } else {
            return null;
        }
        
    }
    
    /**
     * Renvoie les urls des images et des miniatures
     * pour un book donné
     * @param int $book_id
     * @return object
     */
    function get_book_pictures_urls($book_id) {
        // on récupère les photos pour les effacer du disque
        $q = $this->db->select('id, pic_url, th_url')
        ->from('book_pics')
        ->where('book_id', $book_id)
        ->get();
        
        if($q->num_rows() > 0) {
            return $q->result();
        } else {
            return null;
        }
    }    
    
    
    
    
    
    function ajax_update($post) {
        
        //code($post);
        
        $data = array(
            $post['field'] => $post['value'],
        );
        
        $this->db->where('id', $post['id']);
        $this->db->update($post['table'], $data); 
        
    }

    
}