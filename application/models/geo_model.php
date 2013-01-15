<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Geo model
 * 
 */
class Geo_model extends CI_Model
{
    /**
     * La langue à utiliser
     */
    private $lang;
    
    /**
     * Le prefixe de table à utiliser
     */
    private $prefix;
    
    
    /**
     * Constructeur de la classe
     */
    function __construct() {
        parent::__construct();
       
    }
    
    
    /**
     * Défini la langue à utiliser
     * @param string $lang
     */
    function set_lang($lang = 'fr') {
        $this->lang = $lang;            
        $this->prefix = 'geo_'.$this->lang.'_';               
    }
    
    
    /**
     * Renvoie une liste de villes
     * en fonction du nom partiel donné
     * 
     */
    function get_city($partial_name = null) {
        
        //$partial_name = "l'Abergement clémen";
        
        if (isset($_GET['q'])) {
            
            $partial_name = $_GET['q'];
        }
        
        //code($partial_name);
        
        $this->load->helper('text');
        
        // la chaîne miniaturisée, les espaces au milieu remplacés par des tirets
        $match_elmt = str_replace(' ', '-', strtolower(trim($partial_name)));
        
        
        if(substr($match_elmt,0,2) == "l'") {
            $match_elmt = substr($match_elmt, 2);
        }
        
        $match_elmt = convert_accented_characters($match_elmt);
        
        //code($match_elmt);
        
        $q = $this->db
        ->select("geo_".$this->lang."_city.id, geo_".$this->lang."_city.name_city, geo_".$this->lang."_city.cp,
        geo_".$this->lang."_province.name_province")
        ->from("geo_".$this->lang."_city")
        ->join('geo_'.$this->lang."_province", "geo_".$this->lang."_province.code = geo_".$this->lang."_city.id_province")
        ->like("city_slug", $match_elmt, 'after')
        ->get();
        
        if($q->num_rows() > 0) {
            
            $result = $q->result();
            
            $arr = array();
            
            foreach ($result as $key => $city) {
               $arr[] = "{\"id\": \"".$city->id."\", \"value\": \"".$city->name_city.', '.$city->name_province."\", \"info\": \"\"}";
            }
            
            echo "{\"results\": [";
            echo implode(', ', $arr);
            echo "]}";
            
        } else {
            echo('pas de résultats');
        }
        
    }
    
    
}