<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Applicationsup_model extends CI_Model{
    function add_row($data, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->insert("applications_up", $data);
        $dept_db->close();
    }//End of add_row()
    
     function edit_row($up_id, $data, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("up_id", $up_id);
        $dept_db->update("applications_up", $data);
        $dept_db->close();
        return true;
    }//End of edit_row()

    function edit_uainrow($data, $dept_code, $uain){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("uain", $uain);
        $dept_db->update("applications_up", $data);
        $dept_db->close();
        return TRUE;
    }//End of edit_uainrow()
    
    function get_row($up_id, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("applications_up"); 
        $dept_db->where("up_id", $up_id); 
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
        $dept_db->from("applications_up"); 
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
        $dept_db->from("applications_up"); 
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
    
    function get_lastrows($dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("applications_up"); 
        $dept_db->order_by("up_id","DESC");
        $dept_db->limit(5);
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_lastrows()
    
    function get_rows($dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("applications_up"); 
        $dept_db->order_by("up_id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
    
    function get_staffrows($dept_code, $current_userid){
        $wherein = array("RC","RD","A","F","QA","U");
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("current_userid", $current_userid);
        $dept_db->where_in("process", $wherein);
        $dept_db->from("applications_up");
        $dept_db->order_by("up_id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_staffrows()
    
    function get_staffprocessrows($dept_code, $current_userid, $process){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("current_userid", $current_userid);
        $dept_db->where("process", $process);
        $dept_db->from("applications_up");
        $dept_db->order_by("up_id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_staffprocessrows()
    
    function delete_row($up_id, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("up_id", $up_id);
        $dept_db->delete("applications_up");
        $dept_db->close();
    }//End of if delete_row()
    
    function delete_uainrow($dept_code, $uain){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("uain", $uain);
        $dept_db->delete("applications_up");
        $dept_db->close();
    }//End of if delete_uainrow()
}//End of Applicationsup_model
