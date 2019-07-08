<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Offices_model extends CI_Model{
    function add_row($data, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->insert("offices", $data);
        $dept_db->close();
    }//End of add_row()
    
     public function edit_row($id, $data, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("id", $id);
        $dept_db->update("offices", $data);
        $dept_db->close();
        return true;
    }//End of edit_row()
    
    function get_row($id, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("offices"); 
        $dept_db->where("id", $id ); 
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
        $dept_db->from("offices"); 
        $dept_db->order_by("id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
    
    function delete_row($id, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("id", $id);
        $dept_db->delete("offices");
        $dept_db->close();
    }//End of if delete_row()
}//End of Offices_model