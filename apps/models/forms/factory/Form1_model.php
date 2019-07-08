<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Form1_model extends CI_Model{
    function add_row($data, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->insert("factory_form1", $data);
        $dept_db->close();
    }//End of add_row()
    
    public function edit_row($form_id, $data, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("form_id", $form_id);
        $dept_db->update("factory_form1", $data);
        $dept_db->close();
        return true;
    }//End of edit_row()
    
    function get_row($form_id, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("factory_form1"); 
        $dept_db->where("form_id", $form_id ); 
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
        $dept_db->from("factory_form1"); 
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
    
    function delete_row($form_id, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("form_id", $form_id);
        $dept_db->delete("factory_form1");
        $dept_db->close();
    }//End of if delete_row()
}//End of Form1_model