<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Formcertifcates_model extends CI_Model{
    function add_row($data, $dept_code, $form_table){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->insert($form_table."_certificates", $data);
        $dept_db->close();
    }//End of add_row()
        
    function edit_row($data, $dept_code, $form_table, $form_id){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("form_id", $form_id);
        $dept_db->update($form_table."_certificates", $data);
        $dept_db->close();
        return TRUE;
    }//End of edit_rowp()    
    
    function get_row($dept_code, $form_table, $form_id){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($form_table."_certificates");
        $dept_db->where("form_id", $form_id); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()
    
    function get_rows($dept_code, $form_table){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($form_table."_certificates");
        $dept_db->order_by("form_id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
    
    function delete_row($dept_code, $form_table, $form_id){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("form_id", $form_id);
        $dept_db->delete($form_table."_certificates");
        $dept_db->close();
    }//End of if delete_row()
}//End of Formcertifcates_model