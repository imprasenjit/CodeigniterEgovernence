<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Einspections_model extends CI_Model{
    function add_row($data, $dept_code){
        $this->load->database($dept_code, TRUE);
        $this->db->insert("einspections_assigned", $data);
        $this->db->close();
    }//End of add_row()
    
     public function edit_row($id, $data, $dept_code){
        $this->load->database($dept_code, TRUE);
        $this->db->where("inspection_id", $id);
        $this->db->update("einspections_assigned", $data);
        $this->db->close();
        return true;
    }//End of edit_row()
    
    function get_row($id, $dept_code){
        $this->load->database($dept_code, TRUE);
        $this->db->select("*");
        $this->db->from("einspections_assigned"); 
        $this->db->where("inspection_id", $id ); 
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()
    
    function get_rows($dept_code){
        $this->load->database($dept_code, TRUE);
        $this->db->select("*");
        $this->db->from("einspections_assigned"); 
        $this->db->order_by("inspection_id","DESC");  
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
    
    function delete_row($id, $dept_code){
        $this->load->database($dept_code, TRUE);
        $this->db->where("inspection_id", $id);
        $this->db->delete("einspections_assigned");
        $this->db->close();
    }//End of if delete_row()
}//End of Einspections_model