<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Deptusers_model extends CI_Model{
    function add_row($data, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->insert("users", $data);
        $dept_db->close();
    }//End of add_row()
    
     public function edit_row($id, $data, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("user_id", $id);
        $dept_db->update("users", $data);
        $dept_db->close();
        return true;
    }//End of edit_row()
    
    function get_row($id, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("users"); 
        $dept_db->where("user_id", $id ); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()
    
    function get_rows($dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("users"); 
        $dept_db->order_by("user_id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
    
    function get_officerows($dept_code, $office_id){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("users"); 
        $dept_db->where("office_id", $office_id ); 
        $dept_db->order_by("user_name","ASC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_officerows()
    
    function delete_row($id, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("user_id", $id);
        $dept_db->delete("users");
        $dept_db->close();
    }//End of if delete_row()
}//End of Deptusers_model