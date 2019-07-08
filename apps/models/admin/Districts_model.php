<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Districts_model extends CI_Model {
    function add_row($data){
        $this->load->database();
        $this->db->insert("district", $data);
        $this->db->close();
    }//End of add_row()
    
     public function edit_row($dist_id, $data){
        $this->load->database();
        $this->db->where("dist_id", $dist_id);
        $this->db->update("district", $data);
        $this->db->close();
        return true;
    }//End of edit_row()
    
    function get_row($dist_id ){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("district"); 
        $this->db->where("dist_id", $dist_id ); 
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
        $this->db->from("district"); 
        $this->db->order_by("district","ASC");  
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
    
    function delete_row($dist_id){
        $this->load->database();
        $this->db->where("dist_id", $dist_id);
        $this->db->delete("district");
        $this->db->close();
    }//End of if delete_row()
}//End of Districts_model