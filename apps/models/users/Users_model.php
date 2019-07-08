<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Users_model extends CI_Model{
    function add_row($data){
        $this->load->database();
        $this->db->insert("users", $data);
        $this->db->close();
    }//End of add_row()
    
     public function edit_row($id, $data){
        $this->load->database();
        $this->db->where("id", $id);
        $this->db->update("users", $data);
        $this->db->close();
        return true;
    }//End of edit_row()
    
    function get_row($id ){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("users"); 
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
    
    function get_rows(){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("users"); 
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
    
    function delete_row($id){
        $this->load->database();
        $this->db->where("id", $id);
        $this->db->delete("users");
        $this->db->close();
    }//End of if delete_row()
}//End of Users_model