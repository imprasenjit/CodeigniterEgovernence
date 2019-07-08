<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Performancereports_model extends CI_Model{
    function get_deptrows($dept_code){
        $this->load->database();
        $this->db->select("*");
        $this->db->where("dept_code", $dept_code);
        $this->db->from("performence_report");
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else        
    }//End of get_deptrows()
    
    function get_rows(){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("performence_report");
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else        
    }//End of get_rows()
    
    function tot_rows(){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("performence_report");
        $query = $this->db->get(); 
        $this->db->close();
        return $query->num_rows();
    }//End of tot_rows()
    
    function all_rows($limit, $start, $col, $dir){
        $this->load->database();
        $this->db->select("*");
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from("performence_report");
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }//End of all_rows()
    
    function search_rows($limit, $start, $search, $col, $dir){
        $this->load->database();
        $this->db->select("*");
        $this->db->like("challan_no", $search); 
        $this->db->or_like("uain", $search);
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from("performence_report");
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }//End of search_rows()
    
    function tot_search_rows($search){
        $this->load->database();
        $this->db->select("*");
        $this->db->like("challan_no", $search); 
        $this->db->or_like("uain", $search);
        $this->db->from("performence_report");
        $query = $this->db->get(); 
        $this->db->close();
        return $query->num_rows();
    }//End of tot_search_rows()
}//End of Performancereports_model