<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Applicationsir_model extends CI_Model{
    function add_row($data, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->insert("applications_ir", $data);
        $dept_db->close();
    }//End of add_row()
    
     function edit_row($ir_id, $data, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("ir_id", $ir_id);
        $dept_db->update("applications_ir", $data);
        $dept_db->close();
        return true;
    }//End of edit_row()

    function edit_uainrow($data, $dept_code, $uain){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("uain", $uain);
        $dept_db->update("applications_ir", $data);
        $dept_db->close();
        return TRUE;
    }//End of edit_uainrow()
    
    function get_row($ir_id, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("applications_ir"); 
        $dept_db->where("ir_id", $ir_id); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()
    
    function get_uainrow($dept_code, $uain){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("applications_ir"); 
        $dept_db->where("uain", $uain); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else        
    }//End of get_uainrow()
    
    function check_row($uain, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("applications_ir"); 
        $dept_db->where("uain", $uain); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else        
    }//End of check_row()
    
    function get_rows($dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("applications_ir"); 
        $dept_db->order_by("ir_id","DESC");  
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
        $dept_db->where("office_id", $office_id);
        $dept_db->from("applications_ir");
        $dept_db->order_by("ir_id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_officerows()
    
    function get_officeprocessrows($dept_code, $office_id, $process){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("office_id", $office_id);
        $dept_db->where("process", $process);
        $dept_db->from("applications_ir");
        $dept_db->order_by("ir_id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_officeprocessrows()
    
    function get_staffrows($dept_code, $processed_by){
        $wherein = array("C","I","R");
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("processed_by", $processed_by);
        $dept_db->where_in("process", $wherein);
        $dept_db->from("applications_ir");
        $dept_db->order_by("ir_id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_staffrows()
    
    function get_staffprocessrows($dept_code, $processed_by, $process){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("processed_by", $processed_by);
        $dept_db->where("process", $process);
        $dept_db->from("applications_ir");
        $dept_db->order_by("ir_id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_staffprocessrows()
    
    function delete_row($ir_id, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("ir_id", $ir_id);
        $dept_db->delete("applications_ir");
        $dept_db->close();
    }//End of if delete_row()
    
    function delete_uainrow($dept_code, $uain){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("uain", $uain);
        $dept_db->delete("applications_ir");
        $dept_db->close();
    }//End of if delete_uainrow()
}//End of Applicationsir_model