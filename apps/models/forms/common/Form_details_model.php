<?php
class Form_details_model extends CI_Model{
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
    
    function get_row($form_id, $dept_code,$form_no){
        $dept_db = $this->load->database($dept_code, TRUE);
        $table_name    = $dept_code . '_form' . $form_no;
        $dept_db->select("*");
        $dept_db->from($table_name); 
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
    
    function get_save_mode($dept_code,$form_no,$unit_id){
        $dept_db = $this->load->database($dept_code, TRUE);
        
        $table_name = $dept_code . '_form' . $form_no;
        
        //$query = $dept_db->query("select save_mode from $table_name where user_id='$unit_id' and active='1'");
        
        $dept_db->select("save_mode");
        $dept_db->from($table_name); 
        $dept_db->where("user_id", $unit_id); 
        $dept_db->where("active", '1'); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return 0;
        } else {
            $dept_db->close();
            $save_mode = $query->row()->save_mode;
            if($save_mode=="C"){
                return 1;
            }else if($save_mode=="F"){ 
                return 2;
            }else if($save_mode=="P"){
                return 3;
            }else if($save_mode=="D"){
                return 4;
            }else{
                return 0;
            }	
        }//End of if else        
    }//End of get_row()
}
