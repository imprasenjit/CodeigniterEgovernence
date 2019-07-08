<?php

/**
 * Description of Landbank
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Landbank_model extends CI_Model {

    function get_agency() {
        $this->load->database();        
        $this->db->distinct();
        $this->db->select("Name_of_the_infrastructure_with_location");
        $this->db->from("LandBank");
        $query=$this->db->get();
        return $query->result_array();
    }

}
