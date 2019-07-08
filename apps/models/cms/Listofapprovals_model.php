<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Listofapprovals_model extends CI_Model{
    function add_row($data){
        $cms = $this->load->database("cms", TRUE);
        $cms->insert("list_of_approvals", $data);
        $cms->close();
    }//End of add_row()
    
     public function edit_row($id, $data){
        $cms = $this->load->database("cms", TRUE);
        $cms->where("id", $id);
        $cms->update("list_of_approvals", $data);
        $cms->close();
        return true;
    }//End of edit_row()
    
    function get_row($id){
        $cms = $this->load->database("cms", TRUE);
        $cms->select("*");
        $cms->from("list_of_approvals"); 
        $cms->where("id", $id); 
        $query = $cms->get(); 
        if($query->num_rows() == 0) {
            $cms->close();
            return FALSE;
        } else {
            $cms->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()
    
    function get_formdetails($sub_dept, $form_no){
        $cms = $this->load->database("cms", TRUE);
        $cms->select("*");
        $cms->from("list_of_approvals"); 
        $cms->where("sub_dept", $sub_dept); 
        $cms->where("form_no", $form_no); 
        $query = $cms->get(); 
        if($query->num_rows() == 0) {
            $cms->close();
            return FALSE;
        } else {
            $cms->close();
            return $query->row();
        }//End of if else        
    }//End of get_formdetails()
    
    function get_rows($dept_code){
        $cms = $this->load->database("cms", TRUE);
        $cms->select("*");
        $cms->from("list_of_approvals"); 
        $cms->order_by("id","DESC");  
        $query = $cms->get(); 
        if($query->num_rows() == 0) {
            $cms->close();
            return FALSE;
        } else {
            $cms->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
    
    function delete_row($id){
        $cms = $this->load->database("cms", TRUE);
        $cms->where("id", $id);
        $cms->delete("list_of_approvals");
        $cms->close();
    }//End of if delete_row()
}//End of Listofapprovals_model