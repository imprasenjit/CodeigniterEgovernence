<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Inspectionreports_model extends CI_Model {
    function add_row($data, $dept_code, $form_no){
        $tbl = "pcb_form".$form_no."_insp_report";
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->insert($tbl, $data);
        $dept_db->close();
    }//End of add_row()
    
    function edit_row($report_id, $dept_code, $form_no, $data){
        $tbl = "pcb_form".$form_no."_insp_report";
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("report_id", $report_id);
        $dept_db->update($tbl, $data);
        $dept_db->close();
        return true;
    }//End of edit_row()
    
    function get_row($report_id, $dept_code, $form_no){
        $tbl = "pcb_form".$form_no."_insp_report";
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($tbl); 
        $dept_db->where("report_id", $report_id); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()
    
    function get_rows($dept_code, $form_no){
        $tbl = "pcb_form".$form_no."_insp_report";
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($tbl); 
        $dept_db->order_by("office_name","ASC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
    
    function delete_row($report_id, $dept_code, $form_no){
        $tbl = "pcb_form".$form_no."_insp_report";
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->where("report_id", $report_id);
        $dept_db->delete($tbl);
        $dept_db->close();
    }//End of if delete_row()
}//End of Inspectionreports_model