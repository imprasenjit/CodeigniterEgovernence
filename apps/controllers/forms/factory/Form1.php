<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Form1 extends Eodbu {
    function __construct() {
        parent::__construct();
        ### HEADER INFO #####
        

    }//End of constructor
    function index() {
        $this->load->model('eodbfunctions/getuserheaderdata');
        $header_data= $this->getuserheaderdata->header_data();
        
        if($this->frmdetails(1)) {
            $data = $this->frmdetails(1);
            
            $data=array_merge($data, $header_data);
            $this->load->model("staffs/subdepartments_model");
            $this->load->model("users/unit_model");
            $this->load->model("forms/common/form_details_model");
            $this->load->model("cms/listofapprovals_model");
            $this->load->view("forms/factory/form1_view", $data);
        } else {
            $this->session->set_flashdata("flashMsg", "Departmet does not exist");
            redirect(site_url("users/"));
        }
    }//End of index()
    
    public function frmdetails($form_no = NULL) {
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("cms/listofapprovals_model");
        $dept_code = $this->uri->segment("2");
        if ($this->subdepartments_model->get_deptbycode($dept_code)) {
            $subdeptrow = $this->subdepartments_model->get_deptbycode($dept_code);
            $dept_name = $subdeptrow->name;
            $subdept_id = $subdeptrow->id;
            if ($this->listofapprovals_model->get_formdetails($subdept_id, $form_no)) {
                $formrow = $this->listofapprovals_model->get_formdetails($subdept_id, $form_no);
                $form_name = $formrow->service_name;
            } else {
                $form_name = "Not found!";
            }
            $arr = array(
                "dept_code" => $dept_code,
                "dept_name" => $dept_name,
                "form_name" => $form_name,
                "form_no" => $form_no
            );
            return $arr;
        } else {
            return FALSE;
        }
    }//End of index()
    
    public function save(){
        $form_id=$this->input->post("form_id");
        $dept_code = $this->uri->segment("2");        
        $this->load->library("form_validation");
        $this->form_validation->set_rules("fac_situation", "Name", "required");
        $this->form_validation->set_rules("pin3", "PIN", "integer|min_length[6]");
        $this->form_validation->set_rules("m_no", "Mobile No.", "integer|min_length[10]");
        $this->form_validation->set_error_delimiters("<font class='error animated fadeIn'>", "</font>");
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("flashMsg", "Invalid does not match");
            $this->index($form_id);
        } else {
            $nowTime = date("Y-m-d H:i:s");
            $unit_id = $this->session->unit_id;
            $fac_situation = $this->input->post("fac_situation");
            $province = $this->input->post("province");
            $vill3 = $this->input->post("vill3");
            $dist3 = $this->input->post("dist3");
            $pin3 = $this->input->post("pin3");
            $m_no = $this->input->post("m_no");
            $n_rail_station = $this->input->post("n_rail_station");
            $particulars = $this->input->post("particulars");
            $is_hazardous = $this->input->post("is_hazardous");
            $data = array(
                "user_id" => $unit_id,
                "sub_date" => $nowTime,
                "fac_situation" => $fac_situation,
                "province" => $province,
                "vill3" => $vill3,
                "dist3" => $dist3,
                "pin3" => $pin3,
                "m_no" => $m_no,
                "n_rail_station" => $n_rail_station,
                "particulars" => $particulars,
                "is_hazardous" => $is_hazardous
            );
            $this->load->model("forms/factory/form1_model");
            if($form_id ==="") {
                $this->form1_model->add_row($data, $dept_code);
                $msg = "Data has been Successfully Saved!";
            } else {
                $this->form1_model->edit_row($form_id, $data, $dept_code);
                $msg = "Data has been Successfully Updated!";
            } // End of if else
            
            $this->session->set_flashdata("flashMsg", $msg);
            redirect(site_url("forms/factory/form1"));
        }
    }//End of save()
}//End of Home
