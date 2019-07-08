<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class GetUser_model extends CI_Model {

    function getUserById($id, $type = NULL) {
        $this->load->database();
        $this->db->select('name,email,phone');
        $this->db->from('users');
        if ($type == "email") {
            $this->db->where('email', $id);
        } else {
            $this->db->where('id', $id);
        }
        $this->db->limit(1);
        $query = $this->db->get();
        $this->db->close();
        return $query->row_array();
    }

//End of getUserById()

    function getUnitIdOfUser($id) {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('caf');
        $this->db->where('user_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        $this->db->close();
        return $query->row_array();
    }

    //End of getUnitIdOfUser()
}

//End of GetUser_model		