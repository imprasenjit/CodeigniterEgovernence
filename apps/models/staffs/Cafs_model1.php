<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Cafs_model extends CI_Model{
    function get_enterprise_details($unit_id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("unit_master_record"); 
        $this->db->where("unit_id", $unit_id ); 
        $query = $this->db->get(); 
        $this->db->close();
        if($query->num_rows() == 0) {            
            return FALSE;
        } else {
            return $query->row();
        }//End of if else 
        
        //$qry = $dbconnect->executeQuery("dicc", "SELECT caf_id,ubin,unit_name,app_email,mobile_no,email_id,landline_std,landline_no,app_name,app_mobile_no,app_email,app_designation,unit_type,dateofcommencement,business_type,address,app_addressid FROM unit_master_record WHERE unit_id='$unit_id'");

    }
    function get_row($id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("singe_window_registration"); 
        $this->db->where("id", $id ); 
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()
    
    function tot_rows(){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("singe_window_registration");
        $query = $this->db->get(); 
        $this->db->close();
        return $query->num_rows();
    }//End of tot_rows()
    
    function all_rows($limit, $start, $col, $dir){
        $this->load->database();
        $this->db->select("*");
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from("singe_window_registration");
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
        $this->db->like("Name", $search); 
        $this->db->or_like("ubin", $search);
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from("singe_window_registration");
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
        $this->db->like("Name", $search); 
        $this->db->or_like("ubin", $search);
        $this->db->from("singe_window_registration");
        $query = $this->db->get(); 
        $this->db->close();
        return $query->num_rows();
    }//End of tot_search_rows()
}//End of Cafs_model