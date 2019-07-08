<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Forms1_model extends CI_Model{
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
    }//End of edit_rowp()    

    function get_uainrow($dept_code, $form_table, $uain){
	
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($form_table);
        $dept_db->where("uain", $uain); 
        $query = $dept_db->get(); 
		//echo $query = "select * from $form_table where uain='$uain'";echo "<br/>";
		//echo $dept_db->query($query);
		
		//print_r();
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else        
    }//End of get_uainrow()
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
}//End of Forms_model