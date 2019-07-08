<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Queriedapplications_model extends CI_Model{
    function add_row($data){
        $this->load->database();
        $this->db->insert("queries", $data);
        $this->db->close();
    }//End of add_row()
    
    function edit_row($data, $id){
        $this->load->database();
        $this->db->where("query_id", $id);
        $this->db->update("queries", $data);
        $this->db->close();
        return true;
    }//End of edit_row()
    
    function get_uainrow($uain){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("queries"); 
        $this->db->where("uain", $uain); 
        $this->db->order_by("q_date","DESC");
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else        
    }//End of get_uainrow()
    
    function get_uainrows($uain){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("queries"); 
        $this->db->where("uain", $uain); 
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else        
    }//End of get_uainrows()
}//End of Queriedapplications_model
