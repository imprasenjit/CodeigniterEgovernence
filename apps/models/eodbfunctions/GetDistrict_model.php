<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class GetDistrict_model extends CI_Model {

    function getAllDistrict() {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('districts');
        $query = $this->db->get();
        $this->db->close();
        return $query->result_array();
    }

}

//End of Subdepartments_model		