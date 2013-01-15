<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Geo
 * 
 * 
 */
class Geo extends CI_Controller
{

    function autocomplete_city() {
        $this->load->model('geo_model');
        $this->geo_model->set_lang('fr');
        $this->geo_model->get_city();
    }
    
}