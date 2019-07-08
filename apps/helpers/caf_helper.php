<?php

defined("BASEPATH") OR exit("No direct script access allowed");

if (!function_exists("get_caf")) {
/**
 * 
 * @param type $user_id
 * @return boolean
 */
    function get_caf($user_id) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->select("*");
        $ci->db->from("caf");
        $ci->db->where("user_id",$user_id);
        $query=$ci->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

}
if (!function_exists("get_caf_info")) {
/**
 * 
 * @param type $user_id
 * @return boolean
 */
    function get_caf_info($caf_id) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->select("*");
        $ci->db->from("caf");
        $ci->db->where("caf_id",$caf_id);
        $query=$ci->db->get();
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return FALSE;
        }
    }

}
if (!function_exists("get_caf_queries")) {
/**
 * 
 * @param type $user_id
 * @return boolean
 */
    function get_caf_queries($caf_id) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->select("*");
        $ci->db->from("caf_query");
        $ci->db->where("caf_id",$caf_id);
        $ci->db->order_by("id","DESC");
        $query=$ci->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return FALSE;
        }
    }

}