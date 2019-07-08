<?php

defined("BASEPATH") OR exit("No direct script access allowed");

if (!function_exists("get_caf_user")) {
    function get_caf_user($user_id) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->select('*');
        $ci->db->from('users');
        $ci->db->where("id",$user_id);
        $ci->db->limit(1);
        $query = $ci->db->get();
        $ci->db->close();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
}