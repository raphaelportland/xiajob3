<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


require_once(APPPATH. 'models/generic_user.php');

/**
 * Classe Candidat 
 * 
 * gère les utilisateurs de type candidat
 * 
 * @package florBooks
 * @subpackage models
 * @author Raphaël Malaizé
 */
class Candidat extends Generic_user {
    
    /**
     * CV
     * @var object $resume
     */
    public $resume;
    
    
     
    

    
    function __construct($user_id = null) {
        
        parent::__construct();   
        
        $this->resume = new stdClass();
        
    }   
    
    
    
    /**
     * Renvoie toutes les données sur le candidat
     * 
     * @param int
     * @return object
     */
    function get_candidat($user_id = null) {
        
       if($user_id) {
           $this->set_id($user_id);
       }     
       
       $this->get_user();    // generic_user   
       $this->get_awards();       
       $this->get_diplomas();       
       $this->get_xppro();      
       $this->get_description();      
       $this->get_skills();    
       if($this->resume->skills == null) {
           $this->setup_skills();
       }
       
         
       $this->get_computer_skill();
       $this->all_options();
       
       return $this;
        
    } 
    
    
    
    
    
    
    
    /**
     * Renvoie le nom complet de l'utilisateur
     * 
     */
    function full_name() {       
        return('a re-coder');     
    } 
    
    
    





    /**
     * Enregistrement du formulaire d'inscription 'profil pro'
     * 
     */
    function record_profile_pro($source) {
        
        // on retire la valeur "register" qui est inutile
        unset($source['register']);
        
        // on monte un tableau :
        
        $options = array();
        
        foreach ($source as $option => $value) {           
            $opt = array(
                'user_id' => $this->user_id,
                'option' => $option,
                'value' => $value,
            );            
            $options[] = $opt;    
        }
        
        $this->db->insert_batch('user_options',$options);
    }
    
    
    
    
    
    /**
     * Enregistre les récompenses, les formations
     * et les expériences professionnelles du
     * formulaire d'inscription
     * 
     */
    function record_expe($source) {
        
        // on cherche s'il y a des récompenses
        if($source['year_recomp1'] != '') {
            
            // il y a au moins une récompense
            
            $recompenses = array();
            $i = 1;
            
            while(isset($source['year_recomp'.$i]) && $source['year_recomp'.$i] !='') :                
                $recomp = array(
                    'user_id'       => $this->user_id,
                    'year_recomp'   => $source['year_recomp'.$i],
                    'recompense'    => $source['recomp'.$i],
                    'autre_recomp'  => $source['autre_recomp'.$i],
                );                 
                $recompenses[] = $recomp;                                                                                         
                $i++;                                               
            endwhile;
            
            $this->db->insert_batch('user_recomp',$recompenses);                     
        }
        
        // on cherche les formations
        if($source['year_diplome1'] != '') {
            // il y a au moins une formation

            $formations = array();
            $i = 1;
            
            while(isset($source['year_diplome'.$i]) && $source['year_diplome'.$i] !='') :                                 
                $form = array(
                    'user_id'           => $this->user_id,
                    'annee_diplome'     => $source['year_diplome'.$i],
                    'formation_id'      => $source['formation'.$i],
                    'autre_formation'   => $source['custom_formation'.$i],
                    'diplome_id'        => $source['diplome'.$i],
                    'autre_diplome'     => $source['custom_diplome'.$i],                  
                );                               
                $formations[] = $form;                                                             
                $i++;                
            endwhile;
            
            $this->db->insert_batch('user_formations',$formations);                         
        }                        
        
        // on cherche les expériences pro
        if($source['custom_lieu1'] != '') {
            // il y a au moins une expé

            $experiences = array();
            $i = 1;
            while(isset($source['custom_lieu'.$i]) && $source['custom_lieu'.$i] !='') {

                $expe = array(
                    'user_id'           => $this->user_id,
                    'etablissement'     => $source['custom_lieu'.$i],
                    'poste'             => $source['poste'.$i],
                    'type_etab'         => $source['type'.$i],
                    'month_start'       => $source['month_start'.$i],
                    'year_start'        => $source['year_start'.$i], 
                    'month_end'         => $source['month_end'.$i],
                    'year_end'          => $source['year_end'.$i],
                );
                $experiences[] = $expe;                                                                              
                $i++;                
            }
            
            $this->db->insert_batch('user_expepro', $experiences);                     
        }                                 
    }





    /**
     * Enregistre le formulaire d'inscription
     * "Compétences"
     * 
     */
    function record_competences($source) {
        
        unset($source['register']); // register est inutile, on l'enlève

        // enregistrement de la description
        
        $desc = array(
            'user_id' => $this->user_id,
            'description' => $source['description'],
        );

        $this->db->insert('user_description',$desc);  
        
        unset($source['description']); // la description est enregistrée, on l'enlève
                
        
        // récupère toutes les compétences        
        $competences = array();
        
        $i = 1;
        while(isset($source[$i])) { // on passe en revue les compétences par leur index
            
            $comp = array(
                'user_id' => $this->user_id,
                'competence' => $i,
                'score' => $source[$i],
            );
            
            $competences[] = $comp;
            unset($source[$i]); // on les retire au fur et à mesure
            $i++;
        }
        
        $this->db->insert_batch('user_autoevaluation', $competences);
        
        // l'éventuel logiciel
        
        if($source['informatique'] != '') {
            
            $info = array(
                'user_id' => $this->user_id,
                'custom_comp_type' => 1, // index de l'informatique dans les custom_comp_types
                'comp_name' => $source['informatique'],
            );
            
            $this->db->insert('user_custom_comp',$info);            
                       
        }

        unset($source['informatique']);
        
        // enregistrement des compétences diverses                
        // tout ce qui reste doit être placé dans les options
        // avec faux si absent

        $data = array(); // on prend un autre tableau car au passage on retire les '-'
        
        if(isset($source['libreservice'])) { $data['libreservice'] = 1; } else { $data['libreservice'] = 0; }
        if(isset($source['even'])) { $data['even'] = 1; } else { $data['even'] = 0; }
        if(isset($source['design'])) { $data['design'] = 1; } else { $data['design'] = 0; }
        if(isset($source['tradi'])) { $data['tradi'] = 1; } else { $data['tradi'] = 0; }
        if(isset($source['pieton'])) { $data['pieton'] = 1; } else { $data['pieton'] = 0; }
        if(isset($source['permisb'])) { $data['permisb'] = 1; } else { $data['permisb'] = 0; }
        if(isset($source['permisc'])) { $data['permisc'] = 1; } else { $data['permisc'] = 0; }
        if(isset($source['word'])) { $data['word'] = 1; } else { $data['word'] = 0; }
        if(isset($source['excel'])) { $data['excel'] = 1; } else { $data['excel'] = 0; }

        $options = array();

        foreach ($data as $key => $value) {
            $option = array(
                'user_id' => $this->user_id,
                'option' => $key,
                'value' => $value,
            );
            $options[] = $option;
        }

        $this->db->insert_batch('user_options',$options);     
                
    }





    /**
     * Récupère les compétences de l'utilisateur
     * 
     */
    function get_skills() {
        
        $q = $this->db
        ->select('score, nom, picto, competences.id as skill_id')
        ->from('user_autoevaluation')
        ->join('competences', 'competences.id = user_autoevaluation.competence')
        ->where('user_id',$this->user_id)
        ->get();        
            
        if($q->num_rows() > 0) {
            $competences = $q->result();            
        } else {
            $competences = null;
        }            

        $this->resume->skills = $competences;
        
        return($competences);        
    }  






    /**
     * Met le tableau de skills à zéro
     */
    function setup_skills() {
              
            $this->load->model('liste');
            $comp_list = $this->liste->competences();

            $competences = array();
            
            foreach ($comp_list as $key => $comp) {
                
                $competences[$comp->id] = new stdClass();
                                               
                $competences[$comp->id]->score = 1;    
                $competences[$comp->id]->nom = $comp->nom;
                $competences[$comp->id]->picto = $comp->picto;
                $competences[$comp->id]->skill_id = $comp->id;
            }
          
            $this->resume->skills = $competences;             
    }





 
    
    
    /**
     * Récupère la description de l'utilisateur
     * 
     */
    function get_description() {
        $q = $this->db
            ->where('user_id',$this->user_id)
            ->get('user_description');
        
        if($q->num_rows() > 0) {
            $this->description = $q->row()->description; 
               
        } else {
            $this->description = '';
        }
        
        return($this->description);
    } 
    
    
    
    
    
    
    
    
    
    /**
     * Récupère la valeur de la compétence
     * informatique custom
     * 
     */
    function get_computer_skill() {
        $q = $this->db
            ->where('user_id',$this->user_id)
            ->where('custom_comp_type', 1)
            ->get('user_custom_comp');
            
        if($q->num_rows() > 0) : $this->resume->computer_skill = $q->row()->comp_name;
        else : $this->resume->computer_skill = '';
        endif;
        
        return $this->resume->computer_skill;
    }
    
    
    
    
    
    
    

    
    
    
    
    
    
    
    /**
     * Ajoute les données au profil du candidat
     */
    function add($type, $source) {
         
        switch($type) {
            
            case 'recomp' :
                $data = array(
                    'user_id' => $this->user_id,
                    'year_recomp' => $source['year_recomp1'],
                    'recompense' => $source['recomp1'],
                    'autre_recomp' => $source['autre_recomp1'],
                );
                
                $this->db->insert('user_recomp',$data);
                
                $message = "La récompense a bien été ajoutée";
                $this->session->set_flashdata('message', $message);          
                break;
                
            case 'diplome' :
                $data = array(
                    'user_id' => $this->user_id,
                    'annee_diplome' => $source['year_diplome'],
                    'formation_id' => $source['formation'],
                    'diplome_id' => $source['diplome'],
                    'autre_formation' => $source['custom_formation'],
                    'autre_diplome' => $source['custom_diplome'],                    
                );
                
                $this->db->insert('user_formations',$data);
                
                $message = "La formation a bien été enregistrée";
                $this->session->set_flashdata('message', $message);                  
                break;
                
            case 'xp':
                
            	$data = array(
            	'user_id' => $this->user_id,
            	'etablissement' => $source['custom_lieu1'],
            	'poste' => $source['poste1'],
            	'type_etab' => $source['type1'],
            	'month_start' => $source['month_start1'],
            	'year_start' => $source['year_start1'],
            	'month_end' => $source['month_end1'],
            	'year_end' => $source['year_end1'],
                );
                $this->db->insert('user_expepro',$data);
                
                $message = "L'expérience a bien été enregistrée";
                $this->session->set_flashdata('message', $message);                 
            	break;     
        }
    }










    /**
     * Récupère toutes les récompenses de l'utilisateur
     * 
     */
    function get_awards() {
       
       $q = $this->db
            ->select('
            user_recomp.id as user_recomp_id, 
            name, year_recomp, 
            autre_recomp, 
            recompenses.id as recomp_id')
            ->from('user_recomp')
            ->join('recompenses', 'recompenses.id = user_recomp.recompense')
            ->where('user_recomp.user_id', $this->user_id)  
            ->order_by('year_recomp','desc')                   
            ->get();
            
       if(!isset($this->resume->awards)) $this->resume->awards = new stdClass();
              
       $this->resume->awards = $q->result();   
                      
       return $this->resume->awards;
        
    }
    
    
    
    
    
    
    
    
    /**
     * Récupère tous les diplômes de l'utilisateur
     * 
     */
    function get_diplomas() {
        $q = $this->db
             ->select('
             user_formations.id as user_form_id, 
             annee_diplome,
             user_formations.diplome_id as user_diplome_id,
             user_formations.formation_id,
             autre_formation,
             user_formations.diplome_id,
             autre_diplome,
             nom,
             diplome')
             ->from('user_formations')
             ->join('formations', 'formations.formation_id = user_formations.formation_id')
             ->join('diplomes', 'diplomes.diplome_id = user_formations.diplome_id')
             ->where('user_formations.user_id', $this->user_id)
             ->order_by('annee_diplome','desc')             
             ->get();
             
        if(!isset($this->resume->diplomas)) $this->resume->diplomas = new stdClass();
             
        $this->resume->diplomas = $q->result();      
          
        return $this->resume->diplomas;
    } 
    
    
    
    
    
    
    
    /**
     * Récupère toutes les expé pro de l'utilisateur
     */
    function get_xppro() {        
        $q = $this->db
        ->select('
        user_expepro.id as user_xp_id,
        etablissement,
        month_start,
        year_start,
        month_end,
        year_end,
        postes.poste_id,
        postes.poste as poste_name,
        type_etablissement.type_etab as type_name,
        type_etablissement.id as type_etab_id
        ')
        ->from('user_expepro')
        ->join('postes', 'postes.poste_id = user_expepro.poste')
        ->join('type_etablissement', 'type_etablissement.id = user_expepro.type_etab')
        ->where('user_expepro.user_id', $this->user_id)
        ->order_by('year_end','desc')
        ->order_by('month_end','desc')          
        ->get();
        
        $this->resume->xppro = $q->result();
        return $this->resume->xppro;       
    }    
    
    
    
    
   
    
    
    
    

    /**
     * Efface une donnée d'un certain type
     * dans la table correspondante
     * 
     */
    function delete_info($type,$id) {
                
        switch($type) {
            case 'recomp' :
                $this->db
                    ->where('id',$id)
                    ->where('user_id',$this->user_id)
                    ->delete('user_recomp');            
                break;
                
            case 'formations' :
                $this->db
                    ->where('id',$id)                
                    ->where('user_id',$this->user_id)
                    ->delete('user_formations');
                break;
                
            case 'expepro' :
                $this->db
                    ->where('id',$id)                
                    ->where('user_id',$this->user_id)  
                    ->delete('user_expepro');              
                break;
        }
    }
    
    
    
    
    
    
    
    
    /**
     * Pour récupérer une récompense,
     * une formation ou une expérience pro
     * 
     */
    function get_attrib($type, $id) {
        
        $q = $this->db
                ->where('user_id',$this->user_id)
                ->where('id', $id)
                ->get('user_'.$type);
                
        $result = $q->row();
        
        return $result;        
    }
    
    
    
    
    
    
    
    
    
    /**
     * Met à jour l'attribut
     * 
     */
    function update_attrib($type,$id,$source) {
       
       switch($type) {
           case 'recomp' :
               $attrib = array(
                    'user_id' => $this->user_id,
                    'year_recomp' => $source['year_recomp1'],
                    'recompense' => $source['recomp1'],
                    'autre_recomp' => $source['autre_recomp1'],
               );
               break;
               
           case 'formations' :
               $attrib = array(
                    'user_id' => $this->user_id,
                    'annee_diplome' => $source['year_diplome'],
                    'formation_id' => $source['formation'],
                    'diplome_id' => $source['diplome'],
                    'autre_formation' => $source['custom_formation'],
                    'autre_diplome' => $source['custom_diplome'],                
               );
               break;
               
            case 'expepro' :
                $attrib = array(
                    'user_id' => $this->user_id,
                    'etablissement' => $source['custom_lieu1'],
                    'poste' => $source['poste1'],
                    'type_etab' => $source['type1'],
                    'month_start' => $source['month_start1'],
                    'year_start' => $source['year_start1'],
                    'month_end' => $source['month_end1'],
                    'year_end' => $source['year_end1'],                
                );
                break; 

       }       
       
       $this->db
            ->where('user_id', $this->user_id)
            ->where('id', $id)
            ->update('user_'.$type, $attrib);
    }









    /**
     * Met à jour les informations du profil compétences
     * 
     * PB : on doit d'abord créer avant d'updater
     * 
     */
    function update_competences($source) {
        
        // on retire le submit inutile
        unset($source['submit']);
        
        // description
        
        $old_desc = $this->get_description();
        
        $desc = array(
        'user_id' => $this->user_id,
        'description' => $source['description'],
        );
        
        if(isset($old_desc) && ($old_desc != '')) :
                
            $this->db
                ->where('user_id',$this->user_id)
                ->update('user_description',$desc);
                
        else :
            
            $this->db->insert('user_description', $desc);
            
        endif;
            
        unset($source['description']);

        // compétences          
        $actual_comp = $this->get_skills();
        
        $old_comp = array();
        
        if($actual_comp) {
            foreach ($actual_comp as $key => $comp) {               
                $old_comp[$comp->skill_id] = $comp->score;
            }            
        }
        
        //code('old comp');
        //stop_code($old_comp);
        
        $i = 1;
        while(isset($source[$i])) {

            $comp = array(
                'user_id' => $this->user_id,
                'competence' => $i,
                'score'=> $source[$i],            
            );            
            
            if(isset($old_comp[$i])) :
                // update
                $this->db
                    ->where('user_id',$this->user_id)
                    ->where('competence', $i)
                    ->update('user_autoevaluation',$comp);
            
            else : 
                // insert               
                $this->db->insert('user_autoevaluation',$comp);
                
            endif;
            
            unset($source[$i]);
            $i++;              
        }
         
        // informatique
        
        $old_informatique = $this->get_computer_skill();
        
        $info = array(
        'user_id' => $this->user_id,
        'custom_comp_type' => 1, // informatique
        'comp_name' => $source['informatique'],
        );
        
        
        if(isset($old_informatique) && ($old_informatique != '')) : 
            
            $this->db
                ->where('user_id',$this->user_id)
                ->where('custom_comp_type', 1)
                ->update('user_custom_comp', $info);
                
        else :
            
            $this->db->insert('user_custom_comp', $info);
            
        endif;
        
        unset($source['informatique']);
        
        // Autres options
        
        
        if(!isset($this->options)) {
            $old_other_options = $this->all_options();            
        } else {
            $old_other_options = $this->options;
        }
        
        if(!isset($old_other_options->libreservice)) {
            $this->setup_attrib();
        }

        $data = array(); // on prend un autre tableau car au passage on retire les '-'
        
        if(isset($source['libreservice'])) { $data['libreservice'] = 1; } else { $data['libreservice'] = 0; }
        if(isset($source['even'])) { $data['even'] = 1; } else { $data['even'] = 0; }
        if(isset($source['design'])) { $data['design'] = 1; } else { $data['design'] = 0; }
        if(isset($source['tradi'])) { $data['tradi'] = 1; } else { $data['tradi'] = 0; }
        if(isset($source['pieton'])) { $data['pieton'] = 1; } else { $data['pieton'] = 0; }
        if(isset($source['permisb'])) { $data['permisb'] = 1; } else { $data['permisb'] = 0; }
        if(isset($source['permisc'])) { $data['permisc'] = 1; } else { $data['permisc'] = 0; }
        if(isset($source['word'])) { $data['word'] = 1; } else { $data['word'] = 0; }
        if(isset($source['excel'])) { $data['excel'] = 1; } else { $data['excel'] = 0; }

        foreach ($data as $key => $value) {
            $option = array(
                'user_id' => $this->user_id,
                'option' => $key,
                'value' => $value,
            );
            
            $this->db
                ->where('user_id',$this->user_id)
                ->where('option', $key)
                ->update('user_options',$option);           
        }      
    }



    /**
     * Remplis par défaut les options annexes à zéro
     * 
     */
    function setup_attrib() {
        $data['libreservice'] = 0; 
        $data['even'] = 0;
        $data['design'] = 0;
        $data['tradi'] = 0;
        $data['pieton'] = 0;
        $data['permisb'] = 0;
        $data['permisc'] = 0;
        $data['word'] = 0;
        $data['excel'] = 0;

        foreach ($data as $key => $value) {
            $option = array(
                'user_id' => $this->user_id,
                'option' => $key,
                'value' => 0,
            );
            
            $this->db->insert('user_options',$option);           
        }          
    }



}
    