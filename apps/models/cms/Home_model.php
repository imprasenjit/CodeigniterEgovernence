<?php

/**
 * Description of Home_model
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    function getTotalUsers() {
        $this->load->database();
        $this->db->select("id");
        $this->db->from("users");
        $this->db->close();
        return $this->db->count_all_results();
    }

    function getVerifiedUsers() {
        $this->load->database();
        $this->db->select("users.id");
        $this->db->from("users");
        $this->db->join("emails", "users.email=emails.email", "inner");
        $this->db->where("emails.verification_status", "1");
        //echo $this->db->get_compiled_select();die();
        $this->db->close();
        return $this->db->count_all_results();
    }

    /**
     * 
     * @return type
     */
    function getTotalCaf() {
        $this->load->database();
        $this->db->select("unit_id");
        $this->db->from("caf");
        $this->db->close();
        return $this->db->count_all_results();
    }

//End of getTotalCaf()
//End of getUnverifiedCafs()

    /**
     * 
     * @return type number
     */
    function getUnapprovedCaf() {
        $this->load->database();
        $this->db->select("unit_id");
        $this->db->from("caf");
        $this->db->where("status", "0");
        $this->db->where("query_status", "0");
        $this->db->close();
        return $this->db->count_all_results();
    }

// End of getUnapprovedCaf()

    function getQueridCaf() {
        $this->load->database();
        $this->db->select("unit_id");
        $this->db->from("caf");
        $this->db->where("status", "0");
        $this->db->where("query_status", "1");
        $this->db->close();
        return $this->db->count_all_results();
    }

// End of getQueridCaf()

    function getRejectedcafs() {
        $this->load->database();
        $this->db->select("unit_id");
        $this->db->from("caf");
        $this->db->where("status", "2");
        $this->db->close();
        return $this->db->count_all_results();
    }

    function getApprovedCaf() {
        $this->load->database();
        $this->db->select("unit_id");
        $this->db->from("caf");
        $this->db->where("status", "1");
        $this->db->close();
        return $this->db->count_all_results();
    }

// End of getApprovedCaf()

    function getTotalListOfApprovals() {
        $this->load->database("cms");
        $this->db->select("id");
        $this->db->from("list_of_approvals");
        $this->db->where("status", "1");
        $this->db->close();
        return $this->db->count_all_results();
    }

// End of getTotalListOfApprovals()

    function getNotifications() {
        $this->load->database();
        $this->db->select("id");
        $this->db->from("post");
        $this->db->where("type", "1");
        $this->db->close();
        return $this->db->count_all_results();
    }

// End of getNotifications()

    function getDraftNotifications() {
        $this->load->database();
        $this->db->select("id");
        $this->db->from("post");
        $this->db->where("type", "2");
        $this->db->close();
        return $this->db->count_all_results();
    }

// End of getDraftNotifications()

    /**
     * 
     * @return type number
     */
    function getTotalUnit() {
        $this->load->database();
        $this->db->select("unit_id");
        $this->db->from("unit");
        $this->db->where("submitstatus", "1");
        $this->db->close();
        return $this->db->count_all_results();
    }

    /**
     * @return type number
     */
    function getUnapprovedUnit() {
        $this->load->database();
        $this->db->select("unit_id");
        $this->db->from("unit");
        $this->db->where("approvalstatus", "0");
        $this->db->where("submitstatus", "1");
        $this->db->close();
        return $this->db->count_all_results();
    }

    function getModifiedUnit() {
        $this->load->database();
        $this->db->select("unit_id");
        $this->db->from("unit");
        $this->db->where("approvalstatus", "3");
        $this->db->where("submitstatus", "1");
        $this->db->close();
        return $this->db->count_all_results();
    }

    /**
     * 
     * @return type number
     */
    function getQueridUnit() {
        $this->load->database();
        $this->db->select("unit_id");
        $this->db->from("unit");
        $this->db->where("query_status", "1");
        $this->db->where("approvalstatus", "0");
        $this->db->where("submitstatus", "1");
        $this->db->close();
        return $this->db->count_all_results();
    }

    /**
     * 
     * @return type number
     */
    function getApprovedUnit() {
        $this->load->database();
        $this->db->select("unit_id");
        $this->db->from("unit");
        $this->db->where("query_status", "0");
        $this->db->where("approvalstatus", "1");
        $this->db->where("submitstatus", "1");
        $this->db->close();
        return $this->db->count_all_results();
    }

    /**
     * 
     */
    function getRejectedUnit() {
        $this->load->database();
        $this->db->select("unit_id");
        $this->db->from("unit");
        $this->db->where("query_status", "0");
        $this->db->where("approvalstatus", "2");
        $this->db->where("submitstatus", "1");
        $this->db->close();
        return $this->db->count_all_results();
    }

}
