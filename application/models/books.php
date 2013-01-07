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

    // la langue à utiliser, notamment pour les fleurs
    private $lang;
    

    /**
     * Getters et Setters
     */     
        
    function set_lang($lang) { $this->lang = $lang; }

    
    
    
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
        
    } 
   
    


    
     
    
    
    /**
     * Récupère les books les plus récents
     * et les place dans data->latest
     * 
     * @param array $params
     * @return object
     */
    function get_latest($limit = null) {
        
        $latest_params = array(
        'order' => array('field' => 'id', 'direction' => 'desc'),
        'with_covers' => true,
        'limit' => $limit,
        );
        
        if($books_list = $this->get_books($latest_params)) {
                    
            $latest_books = array();
            
            $book_params = array(
            'with_pictures' => true,
            'with_fav_count' => true,
            'with_owner' => true,
            );
            
            foreach ($books_list as $key => $book) {          
                $latest_books[] = $this->get_book($book->id, $book_params);
            }
            
            $this->books->latest = $latest_books;
            return $this->books->latest;  
                     
        } else {
            return null;
        }        
    }
    
    
    
    /**
     * Renvoie les books mis en avant par l'équipe florbook
     * 
     */
    function get_featured_books($limit = null) {
        
        $this->db->select('book_id')->order_by('id','desc');
                
        if(isset($limit)) {
            $this->db->limit($limit);
        } 
        
        $q = $this->db->get('featured_books');
        
        if($q->num_rows() > 0) {
 
            $result = $q->result();
            
            // la librairie de books vide
            $books = array();
                                   
            $params = array(
            'with_pictures' => true,
            'with_fav_count' => true,
            'with_owner' => true,
            );                                   
                                   
            foreach ($result as $key => $book) {
                          
                $books[$key] = $this->get_book($book->book_id, $params);  
            }
            
            //code($books);
            
            $this->books->featured = $books;
            
            //code($books);
            return $this->books->featured;  
 
            
        } else {
            return null;
        }        
       
    }
    
    
    
    /**
     * Récupère les books populaires 
     * sur la base des favoris obtenus
     * @param int $limit
     * @return object
     */
    function get_popular($limit = null) {
        
        $this->db
        //->distinct('book_id')
        ->select('book_id, count(fj_user_fav.id) as nb_fav')
        ->group_by('book_id')
        ->from('user_fav');
        
        if(isset($limit)) {
            $this->db->limit($limit);
        }        
        
        $this->db->order_by('nb_fav','desc');
        $q = $this->db->get();
        
        if($q->num_rows() > 0) {
            $result = $q->result();
            
            $fav_books = array();
            
            $params = array(
            'with_pictures' => true,
            'with_fav_count' => true,
            'with_owner' => true,            
            );
            
            foreach ($result as $key => $book) {
                $fav_books[] = $this->get_book($book->book_id, $params);
            }            
            
            $this->books->popular = $fav_books;
            
            return $this->books->popular;

        } else {
            return null;
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
        
        //$this->temp->pic_id = $pic_id;
        
        $flower = $this->get_flower_by_complete_name($flower_complete_name);
        
        if($flower == false) :
                    
            // la fleur n'existe pas en base, on l'ajoute à la base "crade" : user_flowers
            $this->add_new_custom_flower($pic_id, $flower_complete_name);
            
        else :
            $this->add_pic_flower($pic_id, $flower->id);
        
        endif;
  
    }
    
    /**
     * Associe une fleur de la base officielle
     * à une photo
     * Les données de la fleur on été mises dans $this->temp->flower par get_flower_by_complete_name()
     * 
     */
    function add_pic_flower($pic_id, $flower_id) {
        
            $data = array(
                'pic_id' => $pic_id,
                'flower_id' => $flower_id,
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
            $flower = $q->row();
            return $flower;
            
        } else {

            return false;
        }        
        
    }
    
    
    function add_new_custom_flower($pic_id, $complete_name) {
        
        $data = array(
        'custom_name' => $complete_name,
        'pic_id' => $pic_id,
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
            'cover_pic' => 0, // par défaut la couverture vaut 0
            'short_url' => '',
        );
        
        $this->db->insert('user_book',$book);
        
        $book_id = $this->db->insert_id(); 
        
        $book_url = base_url().'index.php/book/show/'.$book_id;
        
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
     * Renvoie les photos enregistrées dans le book
     * 
     */
    function get_pictures($params = null) {
        
        if(isset($params)) {
            extract($params);           
        }

       
       if(!isset($book_id)) :
           return false;
       endif;
        
       $q = $this->db
            ->where('book_id',$book_id)
            ->get('book_pics'); 

       $pictures = $q->result();
       
       // détail en fonction des options passées
       foreach ($pictures as $key => $pic) {
           
           if(isset($with_flowers)) :
                $pictures[$key]->flower_data = $this->get_pic_flowers($pic->id);
           endif;
           
           // on ajoute les commentaires si nécessaire              
           if(isset($with_comments)) {
               $this->load->model('comments_model');
               $pictures[$key]->comments = $this->comments_model->get_pic_comments($pic->id); 
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
        
        // on récupère l'ordre d'image le plus grand du book
        $order = $this->get_max_pic_order($image->book);
        
        $import = array(
        'pic' => $image->name,
        'book_id' => $image->book,
        'pic_url' => $image->url,
        'th_url' => $image->thumbnail_url,
        'order' => $order+1,
        'view_url' => '',
        );
        
        $this->db->insert('book_pics',$import);
        $new_pic_id = $this->db->insert_id();
        
        // on ajoute l'adresse bitly de la visionneuse de l'image
        $this->load->model('picture_model');
        $view_url = $this->picture_model->get_pic_view_url($image->book, $new_pic_id);
        $this->db->where('id',$new_pic_id)->update('book_pics', array('view_url' => $view_url));
        
        // si le book n'a pas de couverture, on utilise l'image qui vient d'être chargée
        if(!$this->has_cover($image->book)) $this->update_cover_pic($image->book, $new_pic_id);
    }
    
    
    // renvoie la plus grande valeur d'ordre des photos du book
    function get_max_pic_order($book_id) {

        $q = $this->db
            ->select('order')
            ->from('book_pics')
            ->where('book_id',$book_id)
            ->order_by('order','desc')
            ->limit(1)
            ->get();
            
        if($q->num_rows() == 1) {
            return $q->row()->order;
        } else {
            return 1;
        }
        
    }
    
    
    
    
    
    
    
    /**
     * Teste si un book a déjà une couverture
     * renvoie true or false
     * @param int $book_id
     * @return bool
     */
    function has_cover($book_id) {
        $q = $this->db->select('cover_pic')
        ->where('id',$book_id)
        ->where('cover_pic !=',0)
        ->get('user_book');
        
        if($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    
    
    
    /**
     * Renvoie la couverture du book
     * 
     */
    function get_cover($book_id, $params = null) {
        
        $q = $this->db
        ->select('cover_pic')
        ->from('user_book')
        ->where('id', $book_id)
        ->get();
        
        if($q->num_rows() == 1) {
            $this->load->model('picture_model', 'picture');            
            $picture = $this->picture->get_pic($q->row()->cover_pic, $params);
            return $picture;
        } else {
            return false;
        }
        
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
     * sert notamment lors de la suppression d'une photo
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
    

    
    
    
    function ajax_update($post) {
        
        //code($post);
        
        $data = array(
            $post['field'] => $post['value'],
        );
        
        $this->db->where('id', $post['id']);
        $this->db->update($post['table'], $data); 
        
    }
    
    
    
    
    
    /**
     * Charge un book avec ses paramètres
     * 
     * @param int
     * @param array
     * 
     * @return object
     * 
     */    
    function get_book($book_id, $params = null) {
           
        if(isset($params)) {
            extract($params);
        }           
           
           
       $this->db
            ->select('*, occasions.id as occasion_id, user_book.id as book_id, user_book.name as book_name,
            user_book.user_id as user_id')
            //->select('count(fj_book_pics.id) as pic_nb')   
            ->from('user_book')
            ->join('occasions', 'occasions.id = user_book.id_occasion')
            //->join('book_pics', 'book_pics.book_id = user_book.id')
            ->where('user_book.id', $book_id);
       
       // le nombre de favoris
       if(isset($with_fav_count)) {
            $this->db->select('count(fj_user_fav.id) as fav_count');          
            $this->db->join('user_fav', 'user_fav.book_id = user_book.id','left');
       }
        
       $q = $this->db->get();
                   
             
       if($q->num_rows() == 0) {
           return false;
       }       
       
       $book = $q->row();  
       
       
       // est-ce que ce book est favori de l'utilisateur ?
       if(isset($with_is_your_fav)) {
           $this->load->model('social_model');
           $info['book_id'] = $book_id;
           $info['user_id'] = $this->session->userdata('user_id');
           $book->is_your_fav = $this->social_model->is_fav($info);
       }       
       
       
       // les informations sur le propriétaire
       if(isset($with_owner)) {
           $user_params = array(
           'user_id' => $book->user_id,
           );
           
           $this->load->model('generic_user');
           $book->owner = $this->generic_user->get_user_basic_infos($user_params);
       }
       
       // la cover
       if($book->cover_pic != 0) {
           $q2 = $this->db->where('id', $book->cover_pic)
           ->get('book_pics');
           
           if($q2->num_rows() > 0) {
               $book->cover = $q2->row(); 
           }
       }
       
       // les photos
       if(isset($with_pictures)) {
           $this->load->model('picture_model');
            $book->pictures = $this->picture_model->get_pics($book_id, $params);  
            
            // nombre de photos
            if(isset($book->pictures) && $book->pictures != null) {
                $book->pic_nb = count($book->pictures);
            } else {
                $book->pic_nb = 0;
            }     
               
       }
       
       $book->id = $book->book_id;
       unset($book->book_id);
       
       return $book;
    }  
    
    
    
    
    /**
     * Renvoie X id de books selon les paramètres renseignés
     * utilisé notamment pour l'affichage de la galerie
     * 
     * @param array $params
     * @return object
     */
    function get_books($params) {
        
        $this->db->select('user_book.id')
        ->from('user_book');
        
        // limite
        if(isset($params['limit'])) {
            $this->db->limit($params['limit']);
        }
        
        if(isset($params['with_covers'])) {
            $this->db->where('user_book.cover_pic !=',0);
        }
        
        // ordre
        if(isset($params['order'])) {
            $this->db->order_by($params['order']['field'], $params['order']['direction']);
        }

        $q = $this->db->get();
        
        if($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }    
    }
    
    
    
    
    
    
    
    /**
     * Renvoie des books selon les paramètres
     * 
     * @param array $params
     * @return array
     */
    function get_library($params = null) {
        
        if(isset($params)) {
            extract($params);
        }
        
        $this->db->select('user_book.id, user_book.name, user_book.description, user_book.short_url');
        $this->db->from('user_book');
        
        if(isset($with_covers)) :
            $this->db->select('user_book.cover_pic');
        endif;
           
        // nombre de favoris de chaque book
        if(isset($with_fav_count)) :
            $this->db->select('count(fj_user_fav.id) as fav_count');          
            $this->db->join('user_fav', 'user_fav.book_id = user_book.id','left');
        endif;
        
        if(isset($with_pictures_count)) :
            $this->db->select('count(fj_book_pics.id) as pic_count');          
            $this->db->join('book_pics', 'book_pics.book_id = user_book.id','left');
        endif;

        if(isset($with_occasions)) :
            $this->db->select('occasions.occasion_name');          
            $this->db->join('occasions', 'occasions.id = user_book.id_occasion','left');
        endif;        
        
        $this->db->group_by('user_book.id'); 
        
        if(isset($user_id)) {
            $this->db->where('user_book.user_id', $user_id);
        }
        
        $q = $this->db->get();
        
        $library = $q->result();
        
        // remontage de l'objet
        foreach ($library as $key => $book) :
            
            if(isset($with_covers)) :
    
                   if($book->cover_pic != '0') {
                       $q2 = $this->db->where('id', $book->cover_pic)
                       ->get('book_pics');
                       
                       if($q2->num_rows() > 0) {
                           $book->cover = $q2->row(); 
                       }
                   }                
            endif;
            
            if(isset($with_pictures)) :
                
                $book_params = array(
                'book_id' => $book->id,
                );
                $book->pictures = $this->get_pictures($book_params);
                
            endif;
            
            
            if(isset($with_occasions)) :
                
                $book->occasion = new stdClass();
                $book->occasion->name = $book->occasion_name;
                
            endif;
            
        endforeach;

        return $library;
        
    }
    
    
    
    
    
    
    
    
    /**
     * Met à jour la couverture de l'album
     * @param int $book_id
     * @param int $pic_id
     * @return none
     */
    function update_cover_pic($book_id, $pic_id) {
        
        $this->db->where('id',$book_id)
        ->update('user_book', array('cover_pic' => $pic_id));
        
    }



    /**
     * Renvoie l'id de la prochaine photo, 
     * ou de la première si on est arrivés à la dernière photo
     * 
     */
    function get_next_pic($book_id, $pic_order) {
        
        $q = $this->db
                ->select('id')
                ->from('book_pics')
                ->where('book_id',$book_id)
                ->where('order', $pic_order + 1)
                ->get();
                
        if($q->num_rows() == 1 ) {
            return $q->row()->id;
        } else { // on a atteint la dernière photo on retourne à la première
            
            $q = $this->db
                    ->select('id')
                    ->from('book_pics')
                    ->where('book_id',$book_id)
                    ->where('order',1)
                    ->get();
                    
            return $q->row()->id;           
        }
        
    }

    /**
     * Renvoie l'id de la photo précédente
     * ou de la dernière si on est arrivé à la première
     * 
     */
    function get_previous_pic($book_id, $pic_order) {
        
        $q = $this->db
                ->select('id')
                ->from('book_pics')
                ->where('book_id',$book_id)
                ->where('order', $pic_order - 1)
                ->get();
                
        if($q->num_rows() == 1 ) {
            return $q->row()->id;
        } else { // on a atteint la première photo on retourne à la dernière
            
            $q = $this->db
                    ->select('id')
                    ->from('book_pics')
                    ->where('book_id',$book_id)
                    ->order_by('order', 'desc')
                    ->limit(1)
                    ->get();
                    
            return $q->row()->id;           
        }
        
    }


   
}