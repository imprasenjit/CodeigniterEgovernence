<?php

/**
 * Description of State_model
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class State_model extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function getAllStates() {
        $this->load->database();
        $this->db->select("DISTINCT(state)");
        $this->db->from("states");
        $this->db->order_by("state_name", "ASC");        
        $query = $this->db->get();
        return $query->result_array();
    }

// End of getAllState()

    function getdistrictofastate($state) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("states");
        $this->db->where('state_id',$state);
        $this->db->order_by("state_name", "ASC");
        $query = $this->db->get();
        return $query->result_array();
    }
    //End of getdistrictofastate()

}
