<?php

defined("BASEPATH") OR exit("No direct script access allowed");
/**
 * store_email()
 * @param type $email
 * @return boolean
 */
if (!function_exists("store_email")) {

    function store_email($email) {
        $ci = & get_instance();
        $ci->load->database();
        $time = date("Y-m-d H:i:s");
        $email_verify_tag = mt_rand(10000000, 99999999);
        $data = array(
            "email" => $email,
            "email_verify_code" => $email_verify_tag,
            "entry_time" => $time,
        );
        $ci->db->insert("emails", $data);
        if ($ci->db->affected_rows() > 0) {
            return $email_verify_tag;
        } else {
            return FALSE;
        }
    }

}

/**
 * checkemail()
 * @param type $value
 * @return boolean
 */
if (!function_exists("checkemail")) {

    function checkemail($email) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->select("email");
        $ci->db->from("emails");
        $ci->db->where("email", $email);
        $query = $ci->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

//End of checkemail()
/**
 * 
 * @param type $email
 * @return boolean
 */
if (!function_exists("verify_email")) {

    function verify_email($email) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->select("email");
        $ci->db->from("emails");
        $ci->db->where("email", $email);
        $ci->db->where("verification_status", "1");
        $query = $ci->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

/**
 * 
 * @param type $tag
 * @return boolean
 */
if (!function_exists("verify_tag")) {

    function verify_tag($tag) {
        $ci = & get_instance();
        $ci->load->database();
        $time = date("Y-m-d H:i:s");
        $data = array(
            "email_verify_code" => "NULL",
            "verification_status" => 1,
            "verified_time" => $time,
        );
        $ci->db->where("email_verify_code", $tag);
        $ci->db->update("emails", $data);
        if ($ci->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    if (!function_exists("checkuseremail")) {

        function checkuseremail($email) {
            $ci = & get_instance();
            $ci->load->database();
            $ci->db->select("email");
            $ci->db->from("users");
            $ci->db->where("email", $email);
            $query = $ci->db->get();
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

    }

    if (!function_exists("get_email")) {

        function get_email($email) {
            $ci = & get_instance();
            $ci->load->database();
            $ci->db->select("*");
            $ci->db->from("emails");
            $ci->db->where("email", $email);
            $query = $ci->db->get();
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return FALSE;
            }
        }

    }
}
