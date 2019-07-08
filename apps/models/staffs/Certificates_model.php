<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Certificates_model extends CI_Model{
    function get_uainrow($uain){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("applications_up"); 
        $this->db->where("uain", $uain ); 
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else        
    }//End of get_uainrow()
    
    function get_rows(){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("applications_up"); 
        $this->db->order_by("id","DESC");  
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
    
    function get_deptrows($dept_id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("applications_up"); 
        $this->db->where("dept_id", $dept_id); 
        $this->db->order_by("id","DESC");  
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }//End of get_deptrows()
}//End of Certificates_model