<?php

/**
 * Description of Home_model
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

    function getpaymentcodes($id=NULL) {
        $cms = $this->load->database();
        $this->db->select("*");
        $this->db->from("Treasury_payment_details");

        if ($id == NULL) {
            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->where("ID", $id);
            $query = $this->db->get();
            return $query->row();
        }
    }
    //End of getpaymentcodes

}
