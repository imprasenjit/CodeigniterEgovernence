<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Levels extends Eodba {
    function index($utype_id=NULL){
        $data = array();
        $dept_code = $this->session->staff_dept;
        $this->load->model("staffs/utypes_model");
        if($this->utypes_model->get_row($utype_id, $dept_code)) {
            $data["result"] = $this->utypes_model->get_row($utype_id, $dept_code);
        }//End of if statement
        $this->load->view("admin/levels_view", $data);
    }//End of index()
    
    function save(){
        $dept_code = $this->session->staff_dept;
        $utype_id = $this->input->post("utype_id");
        $this->load->library("form_validation");
        $this->form_validation->set_rules("utype_name", "Name", "required");
        $this->form_validation->set_error_delimiters("<div class='error'>", "</div>");        
        if($this->form_validation->run() == FALSE) {
            $msg="Invalid input(s)";
            $this->index($utype_id);
        } else {
            $utype_name = $this->input->post("utype_name");
            $data = array(
                "utype_name" => $utype_name
            );            
            $this->load->model("staffs/utypes_model");            
            if($utype_id == "") {
                $this->utypes_model->add_row($data, $dept_code);
                $msg="Data has been successfully saved!";  
            } else {
                $this->utypes_model->edit_row($utype_id, $data, $dept_code);
                $msg="Data has been successfully updated!";  
            } // End of if else   
        } // End of if else
        $this->session->set_flashdata("flashMsg", $msg);
        redirect(base_url("admin/levels"));
    } // End of save()
}//End of Levels