<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Publicgrivances_model extends CI_Model{    
    function get_row($id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("grievance_redressal"); 
        $this->db->where("g_id", $id ); 
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()
    
    function get_rows(){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("grievance_redressal"); 
        $this->db->order_by("g_id","DESC");  
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
    
    
    function get_urgr(){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("grievance_redressal_conv"); 
        $this->db->join("grievance_redressal", "grievance_redressal_conv.g_id = grievance_redressal.g_id");
        $this->db->order_by("grievance_redressal_conv.g_id","DESC");  
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }//End of get_urgr()
}//End of Publicgrivances_model