<?php
if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Address_model extends CI_Model {

    function save($data) {
        $this->load->database();
        $this->db->insert("address", $data);
        return $this->db->insert_id();
    }//End of save()

    function get($id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("address");
        $this->db->where("id", $id);
        $query = $this->db->get();
        return $query->row();
    }//End of get()

    function getAddressIdOfCaf($id) {
        $this->load->database();
        $this->db->select("address");
        $this->db->from("caf");
        $this->db->where("caf_id", $id);
        $query = $this->db->get();
        $row = $query->row();
        return $row->address;
    }//End of getAddressIdOfCaf()
    
    function update($data,$id){
        $this->load->database();
        $this->db->where("id",$id);
        $this->db->update("address", $data);
        return $id;
    }//End of update()
}
