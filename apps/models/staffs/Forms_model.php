<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Forms_model extends CI_Model{
    function add_row($data, $dept_code, $form_table){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->insert($form_table, $data);
        $dept_db->close();
    }//End of add_row()

    function edit_row($data, $dept_code, $form_table, $form_id){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("form_id", $form_id);
        $dept_db->update($form_table, $data);
        $dept_db->close();
        return TRUE;
    }//End of edit_row() 

    function edit_uainrow($data, $dept_code, $form_table, $uain){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("uain", $uain);
        $dept_db->update($form_table, $data);
        $dept_db->close();
        return TRUE;
    }//End of edit_uainrow()    

    function get_formname($dept_id, $form_no){
        $dept_db = $this->load->database("cms", TRUE);
        $dept_db->select("*");
        $dept_db->from("list_of_approvals");
        $dept_db->where("sub_dept", $dept_id); 
        $dept_db->where("form_no", $form_no);
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else 
    }//End of get_formname()

    function get_row($dept_code, $form_table, $form_id){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($form_table);
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

      

    function get_frmrows($dept_code, $form_table, $form_id){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($form_table);
        $dept_db->where("form_id", $form_id); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else        
    }//End of get_frmrows()

    function get_uainrow($dept_code, $form_table, $uain){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($form_table);
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

    function get_rows($dept_code, $form_table){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($form_table);
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
        $dept_db->delete($form_table);
        $dept_db->close();
    }//End of if delete_row()
	
    function get_personalized_rows($dept_code, $form_table, $personalized_array){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($form_table);
		$dept_db->where($personalized_array);
        $dept_db->order_by("form_id","DESC");  
        $query = $dept_db->get(); 
		//echo "<pre>";print_r($form_table);print_r($personalized_array);print_r($query);die();
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
	function get_compliance_report_row($dept_code, $uain){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("compliance_report");
        $dept_db->where("uain", $uain); 
        $dept_db->order_by("comp_id", "desc"); 
        $dept_db->limit(1); 
		
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row() 
}//End of Forms_model
