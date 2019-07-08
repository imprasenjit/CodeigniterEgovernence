<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Verificationschedule_model extends CI_Model{    
    function get_rows($dept_code, $current_userid){
        $dt = date("Y-m-d");
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("current_userid", $current_userid);
        $dept_db->where("process", "V");
        $dept_db->or_where("process", "UVR");
        $dept_db->from("applications_up");
        $dept_db->order_by("process_date","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() > 0) {
            $dept_db->close();
            return $query->result();
        } else {
            $dept_db->close();
            return FALSE;
        }//End of if else
    }//End of get_rows()
    
    function get_staffrows($dept_code, $current_userid){
        $dt = date("Y-m-d");
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("current_userid", $current_userid);
        $dept_db->where("process", "V");
        $dept_db->where("DATE(process_date) > ", $dt);
        $dept_db->from("applications_up");
        $dept_db->order_by("process_date","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() > 0) {
            $dept_db->close();
            return $query->result();
        } else {
            $dept_db->close();
            return FALSE;
        }//End of if else
    }//End of get_staffrows()
}//End of Verificationschedule_model