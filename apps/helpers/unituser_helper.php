<?php

defined("BASEPATH") OR exit("No direct script access allowed");

if (!function_exists("check_if_unit_belong_to_caf")) {

    /**
     * 
     * @param type $unit_master_record_id
     * @param type $caf_id
     * @return boolean
     */
    function check_if_unit_belong_to_caf($unit_master_record_id, $caf_id) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->select("caf_id");
        $ci->db->from("unit_master_record");
        $ci->db->where("caf_id", $caf_id);
        $ci->db->where("unit_id", $unit_master_record_id);
        $query = $ci->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_unit_user($unit_master_record_id) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->from("unit_master_record");
        $ci->db->where("unit_master_record_id", $unit_master_record_id);
        $query = $ci->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

}
