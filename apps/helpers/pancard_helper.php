<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
/**
 * store_email()
 * @param type $email
 * @return boolean
 */
if (!function_exists("checkpancard")) { 
    function checkpancard($value) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->select("caf_id");
        $ci->db->from("caf");
        $ci->db->where("pan_no", $value);
        $query = $ci->db->get();
        if ($userid = $query->row()) {
            $ci->db->close();
            return $userid->user_id;
        } else {
            $ci->db->close();
            return FALSE;
        }
    }
}
