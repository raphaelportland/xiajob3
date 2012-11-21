<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Picture_model
 * 
 * Définition des photos utilisées dans les books
 * tables : 
 * book_pics
 * 
 * @package florBooks
 * @subpackage models
 * @author Raphaël Malaizé
 * 
 */
class Picture_model extends CI_Model {
    
    /**
     * Id unique de la photo
     * @var int $id
     */
    public $id;
    
    /**
     * 
     */
    public $pic;
    
    
}