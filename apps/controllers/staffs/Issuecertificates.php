<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Issuecertificates extends Eodbs {

    public $dept_code;
    public $dept_name;
    public $staff_id;
    public $frmtbl;
    public $form_id;
    public $form_no;
    public $uain;
    public $swr_id;

    function __construct() {
        parent::__construct();
        $this->dept_code = $this->session->staff_dept;
        $this->staff_id = $this->session->staff_id;
        $this->load->helper("sendmail");
        $this->load->helper("encode");
        $this->load->helper("security");
        $this->load->model("staffs/deptusers_model");
        $this->load->model("staffs/offices_model");
        $this->load->model("staffs/utypes_model");
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("staffs/forms_model");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/applicationsir_model");
        $this->load->model("staffs/formprocess_model");
        $this->dept_name = $this->subdepartments_model->get_deptbycode($this->dept_code)->name;
    }//End of construct()

    function updateprocess($uain, $form_table, $form_id) {
        $process = "I";
        $nowTime = date("Y-m-d H:i:s");
        $approw = $this->applicationsup_model->get_uainrow($this->dept_code, $uain);
        if ($approw) {
            $unit_id = $approw->unit_id;
            $unit_name = $approw->unit_name;
            $office_id = $approw->office_id;
            $irData = array(
                "unit_id" => $unit_id,
                "unit_name" => $unit_name,
                "uain" => $uain,
                "process_date" => $nowTime,
                "processed_by" => $this->staff_id,
                "process" => $process,
                "office_id" => $office_id
            );
            $this->applicationsir_model->add_row($irData, $this->dept_code);
            $this->applicationsup_model->delete_uainrow($this->dept_code, $uain);
        }
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $this->staff_id
        ); //End of addData
        $this->formprocess_model->add_row($addData, $this->dept_code, $form_table);
        $deptuserRow = $this->deptusers_model->get_row($this->staff_id, $this->dept_code);
        $staff_name = ($deptuserRow) ? $deptuserRow->user_name : "Staff Member";
        $this->sendemail($form_table, $form_id, "Certificate/License/NOC Uploaded", $staff_name);
    }

    function sdc_form1() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $formCertData["license_no21"] = $this->security->xss_clean($this->input->post("license_no21"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function sdc_form7() { // Form 7,8,36
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["valid_upto"] = $this->security->xss_clean(date("Y-m-d", strtotime($this->input->post("valid_upto"))));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function sdc_form9() { //Form 9,10,11
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["valid_upto"] = $this->security->xss_clean(date("Y-m-d", strtotime($this->input->post("valid_upto"))));
        $formCertData["lic_no"] = $this->security->xss_clean($this->input->post("lic_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function sdc_form13() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function sdc_form27() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["valid_upto"] = $this->security->xss_clean(date("Y-m-d", strtotime($this->input->post("valid_upto"))));
        $formCertData["lic_no"] = $this->security->xss_clean($this->input->post("lic_no"));
        $formCertData["regd_no"] = $this->security->xss_clean($this->input->post("regd_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function sdc_issue_certificate_common() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $formCertData["remarks"] = $this->security->xss_clean($this->input->post("remarks"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	 function dma_form1() { // For Form 2,3
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["file_auth_num"] = $this->security->xss_clean($this->input->post("file_auth_num"));
		$formCertData["reg_no"] = $this->security->xss_clean($this->input->post("reg_no"));
		
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
 function land_form1() { // Form 1,5
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["file_auth_num"] = $this->security->xss_clean($this->input->post("file_auth_num"));        
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }


    function rfs_form1() { // Form 1,5
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["reg_number"] = $this->security->xss_clean($this->input->post("reg_number"));
        $formCertData["issue_number"] = $this->security->xss_clean($this->input->post("issue_number"));
        $formCertData["from_the_year"] = $this->security->xss_clean($this->input->post("from_the_year"));
        $formCertData["to_the_year"] = $this->security->xss_clean($this->input->post("to_the_year"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function rfs_form2() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["regn_no"] = $this->security->xss_clean($this->input->post("regn_no"));
        $formCertData["from_the_year"] = $this->security->xss_clean($this->input->post("from_the_year"));
        $formCertData["to_the_year"] = $this->security->xss_clean($this->input->post("to_the_year"));
        $formCertData["date_of_filling"] = $this->security->xss_clean($this->input->post("date_of_filling"));
        $formCertData["c_business_nature"] = $this->security->xss_clean($this->input->post("c_business_nature"));
        $formCertData["date_of_o_n_c"] = $this->security->xss_clean($this->input->post("date_of_o_n_c"));
        $formCertData["alter_name"] = $this->security->xss_clean($this->input->post("alter_name"));
        $formCertData["alter_principal_place"] = $this->security->xss_clean($this->input->post("alter_principal_place"));
        $formCertData["alter_other_place"] = $this->security->xss_clean($this->input->post("alter_other_place"));
        $formCertData["c_remarks"] = $this->security->xss_clean($this->input->post("c_remarks"));

        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function rfs_form10() { //For Form 10,18,19
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["reg_number"] = $this->security->xss_clean($this->input->post("reg_number"));
        $formCertData["issue_number"] = $this->security->xss_clean($this->input->post("issue_number"));
        $formCertData["reg_date"] = $this->security->xss_clean($this->input->post("reg_date"));
        $formCertData["reg_name"] = $this->security->xss_clean($this->input->post("reg_name"));
        $formCertData["from_the_year"] = $this->security->xss_clean($this->input->post("from_the_year"));
        $formCertData["to_the_year"] = $this->security->xss_clean($this->input->post("to_the_year"));
        
		if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }   
        if ($this->input->post("validity_extended_upto")) {
            $formCertData["validity_extended_upto"] = date("Y-m-d", strtotime($this->input->post("validity_extended_upto")));
        } 
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function rfs_form13() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["reg_number"] = $this->security->xss_clean($this->input->post("reg_number"));
        $formCertData["issue_number"] = $this->security->xss_clean($this->input->post("issue_number"));
        $formCertData["reg_date"] = $this->security->xss_clean($this->input->post("reg_date"));
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $formCertData["from_the_year"] = $this->security->xss_clean($this->input->post("from_the_year"));
        $formCertData["to_the_year"] = $this->security->xss_clean($this->input->post("to_the_year"));
        
		if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }   
        if ($this->input->post("validity_extended_upto")) {
            $formCertData["validity_extended_upto"] = date("Y-m-d", strtotime($this->input->post("validity_extended_upto")));
        } 
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function rfs_form15() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["reg_number"] = $this->security->xss_clean($this->input->post("reg_number"));
        $formCertData["issue_number"] = $this->security->xss_clean($this->input->post("issue_number"));
        $formCertData["from_the_year"] = $this->security->xss_clean($this->input->post("from_the_year"));
        $formCertData["to_the_year"] = $this->security->xss_clean($this->input->post("to_the_year"));
        if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        } 
        if ($this->input->post("validity_extended_upto")) {
            $formCertData["validity_extended_upto"] = date("Y-m-d", strtotime($this->input->post("validity_extended_upto")));
        } 		
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function rfs_form16() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["regn_no"] = $this->security->xss_clean($this->input->post("regn_no"));
        $formCertData["issue_number"] = $this->security->xss_clean($this->input->post("issue_number"));
        $formCertData["from_the_year"] = $this->security->xss_clean($this->input->post("from_the_year"));
        $formCertData["to_the_year"] = $this->security->xss_clean($this->input->post("to_the_year"));
        $formCertData["date_of_filling"] = $this->security->xss_clean($this->input->post("date_of_filling"));
        $formCertData["reg_date"] = $this->security->xss_clean($this->input->post("reg_date"));
        $formCertData["reg_name"] = $this->security->xss_clean($this->input->post("reg_name"));
        $formCertData["other_place"] = $this->security->xss_clean($this->input->post("other_place"));
        $formCertData["date_of_o_n_c"] = $this->security->xss_clean($this->input->post("date_of_o_n_c"));
        $formCertData["c_business_nature"] = $this->security->xss_clean($this->input->post("c_business_nature"));
        $formCertData["c_remarks"] = $this->security->xss_clean($this->input->post("c_remarks"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function rfs_form17() {  //Form 11, 17
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $formCertData["lic_place"] = $this->security->xss_clean($this->input->post("lic_place"));

		if ($this->input->post("sub_date")) {
            $formCertData["sub_date"] = date("Y-m-d", strtotime($this->input->post("sub_date")));
        }
		if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	
	 function rfs_form12() {  
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $formCertData["lic_place"] = $this->security->xss_clean($this->input->post("lic_place"));
if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
 function dsedu_form1() { // Form 2, 4
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["file_auth_no"] = $this->security->xss_clean($this->input->post("file_auth_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function factory_form2() { // Form 2, 4
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["lic_no"] = $this->security->xss_clean($this->input->post("lic_no"));
        $formCertData["consist_of"] = $this->security->xss_clean($this->input->post("consist_of"));
        $formCertData["plan_no"] = $this->security->xss_clean($this->input->post("plan_no"));
        $formCertData["plan_no_date"] = $this->security->xss_clean($this->input->post("plan_no_date"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function factory_form1() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["file_no"] = $this->security->xss_clean($this->input->post("file_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }


    function doa_form13() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }
		$this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function doa_form14() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $formCertData["valid_upto"] = $this->security->xss_clean($this->input->post("valid_upto"));
        $formCertData["seeds_detail"] = $this->security->xss_clean($this->input->post("seeds_detail"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function doa_form17() {  //form21, 31, 1
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
       
		$this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function doa_form22() { //For Form 22, 25
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        
		if ($this->input->post("certificate_no")) {
            $formCertData["certificate_no"] = $this->input->post("certificate_no");
        }
		if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }
		if ($this->input->post("renewed_upto")) {
            $formCertData["renewed_upto"] = date("Y-m-d", strtotime($this->input->post("renewed_upto")));
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function doa_form23() { //For Form 23, 24, 27, 26
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["registration_no"] = $this->security->xss_clean($this->input->post("registration_no"));
        if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }
        $formCertData["challan_number"] = $this->security->xss_clean($this->input->post("challan_number"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }


    function pcb_form1() { // Form 1,2,3,47,48,49,50
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["production_capacity"] = $this->security->xss_clean($this->input->post("production_capacity"));
        $formCertData["act"] = $this->security->xss_clean($this->input->post("act"));
if ($this->input->post("valid_date")) {
            $formCertData["valid_date"] = date("Y-m-d", strtotime($this->input->post("valid_date")));
        }         
		$formCertData["industry_category"] = $this->security->xss_clean($this->input->post("industry_category"));
        $formCertData["annexure"] = $this->security->xss_clean($this->input->post("annexure"));
        $formCertData["terms"] = $this->security->xss_clean($this->input->post("terms"));
        $formCertData["lic_exp_year"] = $this->security->xss_clean($this->input->post("lic_exp_year"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function pcb_form13() { //For Form 13, 16
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["auth_no"] = $this->security->xss_clean($this->input->post("auth_no"));
		if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }     
			
		$formCertData["e_quantity"] = $this->security->xss_clean($this->input->post("e_quantity"));
        $formCertData["e_nature"] = $this->security->xss_clean($this->input->post("e_nature"));
        $formCertData["e_manner"] = $this->security->xss_clean($this->input->post("e_manner"));
        $formCertData["e_treated_at"] = $this->security->xss_clean($this->input->post("e_treated_at"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function pcb_form21() { //form 21,24
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
	if ($this->input->post("auth_details")) {
            $formCertData["auth_details"] = $this->input->post("auth_details");
        }	
	if ($this->input->post("term")) {
            $formCertData["term"] = $this->input->post("term");
        }	
	if ($this->input->post("auth_details")) {
            $formCertData["auth_details"] = $this->input->post("auth_details");
        }	
        $formCertData["file_no"] = $this->security->xss_clean($this->input->post("file_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function pcb_form43() { //For Form 43,44
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["file_auth_num"] = $this->security->xss_clean($this->input->post("file_auth_num"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function ayush_form1() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["file_no"] = $this->security->xss_clean($this->input->post("file_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function ayush_form2() { // Form 2,3,4,5
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["lic_no"] = $this->security->xss_clean($this->input->post("lic_no"));
        $formCertData["issue_number"] = $this->security->xss_clean($this->input->post("issue_number"));
        if ($this->input->post("valid_from")) {
            $formCertData["valid_from"] = date("Y-m-d", strtotime($this->input->post("valid_from")));
        } 
		if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }      
		$this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function boiler_form1() { // Form 1,3,4,5,6,9,7,8
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["max_evaporation"] = $this->security->xss_clean($this->input->post("max_evaporation"));
        $formCertData["tested_on"] = $this->security->xss_clean($this->input->post("tested_on"));
        $formCertData["remarks"] = $this->security->xss_clean($this->input->post("remarks"));
        $formCertData["repairs"] = $this->security->xss_clean($this->input->post("repairs"));
        $formCertData["ibs_no"] = $this->security->xss_clean($this->input->post("ibs_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function boiler_form2() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
if ($this->input->post("valid_from")) {
            $formCertData["valid_from"] = date("Y-m-d", strtotime($this->input->post("valid_from")));
        }        
if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }        
		$formCertData["reg_number"] = $this->security->xss_clean($this->input->post("reg_number"));
        $formCertData["max_evaporation"] = $this->security->xss_clean($this->input->post("max_evaporation"));
        $formCertData["boiler_type"] = $this->security->xss_clean($this->input->post("boiler_type"));
        $formCertData["repairs"] = $this->security->xss_clean($this->input->post("repairs"));
        $formCertData["remarks"] = $this->security->xss_clean($this->input->post("remarks"));
        $formCertData["tested_on"] = $this->security->xss_clean($this->input->post("tested_on"));
        $formCertData["loading_of"] = $this->security->xss_clean($this->input->post("loading_of"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function boiler_form8() { // From 8,9
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["reg_number"] = $this->security->xss_clean($this->input->post("reg_number"));
        $formCertData["max_evaporation"] = $this->security->xss_clean($this->input->post("max_evaporation"));
        $formCertData["repairs"] = $this->security->xss_clean($this->input->post("repairs"));
        $formCertData["remarks"] = $this->security->xss_clean($this->input->post("remarks"));
        $formCertData["tested_on"] = $this->security->xss_clean($this->input->post("tested_on"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function clm_form1() { //For Form 1,5,2
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
		if ($this->input->post("licensed_area")) {
            $formCertData["licensed_area"] = $this->input->post("licensed_area");
        }
		if ($this->input->post("lic_no")) {
            $formCertData["lic_no"] = $this->input->post("lic_no");
        }
        
		$this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function clm_form3() { // From 3,6
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["lic_no"] = $this->security->xss_clean($this->input->post("lic_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function clm_form7() { //form 8, 9
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["reg_no"] = $this->security->xss_clean($this->input->post("reg_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function clm_form10() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["hear_dt "] = $this->security->xss_clean($this->input->post("hear_dt "));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function clm_form11() { //form 14, 12
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["concern_ins "] = $this->security->xss_clean($this->input->post("concern_ins "));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	
	 function excise_form1() { // From 3,6
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["reg_no"] = $this->security->xss_clean($this->input->post("reg_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	
	function dhedu_form1() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["lic_no "] = $this->security->xss_clean($this->input->post("lic_no"));
		$this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function dic_form10() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        //$formCertData["actual_area "] = $this->security->xss_clean($this->input->post("actual_area "));
        
		$formCertData["area_alloted "] = $this->security->xss_clean($this->input->post("area_alloted"));
        $formCertData["dev_charge "] = $this->security->xss_clean($this->input->post("dev_charge"));
        $formCertData["spec_charge "] = $this->security->xss_clean($this->input->post("spec_charge"));
        $formCertData["ann_grnd_rent "] = $this->security->xss_clean($this->input->post("ann_grnd_rent"));
        $formCertData["security_money "] = $this->security->xss_clean($this->input->post("security_money"));
        $formCertData["total_security_money "] = $this->security->xss_clean($this->input->post("total_security_money"));
        $formCertData["total_charge"] = $this->security->xss_clean($this->input->post("total_charge"));
        $formCertData["total_dev_charge"] = $this->security->xss_clean($this->input->post("total_dev_charge"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	function dic_form1() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["lic_no "] = $this->security->xss_clean($this->input->post("lic_no"));
        $formCertData["issue_remarks "] = $this->security->xss_clean($this->input->post("issue_remarks"));
		$this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function excise_form9() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["lic_no"] = $this->security->xss_clean($this->input->post("lic_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	
	 function fcs_form1() { 
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
		$formCertData["godown_place"] = $this->security->xss_clean($this->input->post("godown_place"));
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $formCertData["lic_place"] = $this->security->xss_clean($this->input->post("lic_place"));
		
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	
	function fcs_form2() { 
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
		$formCertData["validity_date_from"] = $this->security->xss_clean(date("Y-m-d", strtotime($this->input->post("validity_date_from"))));
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $formCertData["validity_date_to"] = $this->security->xss_clean(date("Y-m-d", strtotime($this->input->post("validity_date_to"))));
		
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }


    function fcs_form3() { //For Form 3,4
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function fcs_form10() { //FROM 10,24
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $formCertData["valid_upto"] = $this->security->xss_clean($this->input->post("valid_upto"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function fcs_form13() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
		$formCertData["valid_upto"] = $this->security->xss_clean(date("Y-m-d", strtotime($this->input->post("valid_upto"))));
        $formCertData["lic_place"] = $this->security->xss_clean($this->input->post("lic_place"));
        $formCertData["godown_place"] = $this->security->xss_clean($this->input->post("godown_place"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	function fcs_form14() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        $formCertData["lic_place"] = $this->security->xss_clean($this->input->post("lic_place"));
        $formCertData["godown_place"] = $this->security->xss_clean($this->input->post("godown_place"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function labour_form2() { //For Form 2,3
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["other_particlr"] = $this->security->xss_clean($this->input->post("other_particlr"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function labour_form4() { //For Form 4,9,12
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["reg_no"] = $this->security->xss_clean($this->input->post("reg_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function labour_form6() { //For Form 6,7,8,10,11
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["lic_no"] = $this->security->xss_clean($this->input->post("lic_no"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function mines_form22() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
		if ($this->input->post("file_auth_num")) {
            $formCertData["file_auth_num"] = $this->input->post("file_auth_num");
        }
        $formCertData["file_auth_num"] = $this->security->xss_clean($this->input->post("file_auth_num"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function tcp_form1() {//For Form 1,2,3,4,5,6,7,8,9
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        if ($this->input->post("lic_no")) {
            $formCertData["lic_no"] = $this->input->post("lic_no");
        }
		$formCertData["a_built_plan"] = $this->security->xss_clean($this->input->post("a_built_plan"));

       if ($this->input->post("sub_date")) {
            $formCertData["sub_date"] = date("Y-m-d", strtotime($this->input->post("sub_date")));
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function society_form1() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["lic_place"] = $this->security->xss_clean($this->input->post("lic_place"));
		$formCertData["license_no"] = $this->security->xss_clean($this->input->post("license_no"));
        if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }         
		$this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function society_form2() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["reg_no"] = $this->security->xss_clean($this->input->post("reg_no"));
        if ($this->input->post("valid_upto")) {
            $formCertData["valid_upto"] = date("Y-m-d", strtotime($this->input->post("valid_upto")));
        }  
        $formCertData["opp_area"] = $this->security->xss_clean($this->input->post("opp_area"));

		$this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function forest_form1() { //form 2
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["plan_no"] = $this->security->xss_clean($this->input->post("plan_no"));
        $formCertData["consist_of"] = $this->security->xss_clean($this->input->post("consist_of"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function forest_form2() {
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $formCertData["c_species"] = $this->security->xss_clean($this->input->post("c_species"));
        $formCertData["c_gbh"] = $this->security->xss_clean($this->input->post("c_gbh"));
        $formCertData["c_height"] = $this->security->xss_clean($this->input->post("c_height"));
        $formCertData["c_tree_vol"] = $this->security->xss_clean($this->input->post("c_tree_vol"));
        $formCertData["c_piece_no"] = $this->security->xss_clean($this->input->post("c_piece_no"));
        $formCertData["c_measurement"] = $this->security->xss_clean($this->input->post("c_measurement"));
        $formCertData["c_vol"] = $this->security->xss_clean($this->input->post("c_vol"));
        $formCertData["c_details_firewood"] = $this->security->xss_clean($this->input->post("c_details_firewood"));
        $formCertData["c_tp"] = $this->security->xss_clean($this->input->post("c_tp"));
        $formCertData["c_rel_piece_no"] = $this->security->xss_clean($this->input->post("c_rel_piece_no"));
        $formCertData["c_remarks"] = $this->security->xss_clean($this->input->post("c_remarks"));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
function fire_form1() {
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
		
        $formCertData["compl_report_no"] = $this->input->post("compl_report_no");
        $formCertData["compl_report_date"] = $this->input->post("compl_report_date");
        $formCertData["certificate_for"] = $this->input->post("certificate_for");
   
		//$occupation_details=Array();
		$formCertData["occupation_details"]=implode("&",$this->input->post("occupation_details"));
		
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

	function fire_form12() {
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
		
        $formCertData["duration"] = $this->input->post("duration");
        $formCertData["fire_tenders_used"] = $this->input->post("fire_tenders_used");
        $formCertData["fire_report_no"] = $this->input->post("fire_report_no");
        $formCertData["forwarding_no"] = $this->input->post("forwarding_no");
        $formCertData["call_datetime"] = $this->input->post("call_date");
		$formCertData["call_datetime"] = $this->input->post("call_time");
	    $formCertData["remarks"] = $this->input->post("remarks");
		$formCertData["station_names"]=implode("&",$this->input->post("station_names"));

        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
    function cei_form1() { //For Form 1, 2, 3
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        if ($this->input->post("lic_no")) {
            $formCertData["lic_no"] = $this->input->post("lic_no");
        }
        if ($this->input->post("approv_no")) {
            $formCertData["approv_no"] = $this->input->post("lic_no");
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function cei_form6() {//For Form 6,20,25
        $nowTime = date("Y-m-d H:i:s");
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        if ($this->input->post("license_no")) {
            $formCertData["license_no"] = $this->input->post("license_no");
        }
        if ($this->input->post("autho_no")) {
            $formCertData["autho_no"] = $this->input->post("autho_no");
        }
        $frmdt = $this->input->post("validity_date_from");
        $todt = $this->input->post("validity_date_to");
        $formCertData["validity_date_from"] = date("Y-m-d", strtotime($frmdt));
        $formCertData["validity_date_to"] = date("Y-m-d", strtotime($todt));
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function deedu_form1() { //For Form 1
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        if ($this->input->post("lic_no")) {
            $formCertData["lic_no"] = $this->input->post("lic_no");
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function power_form1() { //For Form 1
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        if ($this->input->post("license_no")) {
            $formCertData["license_no"] = $this->input->post("license_no");
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }

    function pwd_form1() { //For Form 1
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        if ($this->input->post("reg_no")) {
            $formCertData["reg_no"] = $this->input->post("reg_no");
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	
	
	  function gmc_form1() { //For Form 1
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
		  
		  $formCertData["licence_type"] = $this->security->xss_clean($this->input->post("licence_type"));
		  $formCertData["reg_no"] = $this->security->xss_clean($this->input->post("reg_no"));
       
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	  function gmc_form5() { //For Form 5
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
		  
		  $formCertData["file_auth_num"] = $this->security->xss_clean($this->input->post("file_auth_num"));
		  $formCertData["reg_no"] = $this->security->xss_clean($this->input->post("reg_no"));
       
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	
	
	function jdl_form1() { //For Form 1
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        if ($this->input->post("file_auth_num")) {
            $formCertData["file_auth_num"] = $this->input->post("file_auth_num");
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	
	function health_form1() { //For Form 1
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        if ($this->input->post("file_auth_num")) {
            $formCertData["file_auth_num"] = $this->input->post("file_auth_num");
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	
	 function water_form1() { //For Form 1
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        if ($this->input->post("file_auth_num")) {
            $formCertData["file_auth_num"] = $this->input->post("file_auth_num");
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	
	
    function tourism_form1() { //For Form 1
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        if ($this->input->post("file_auth_num")) {
            $formCertData["file_auth_num"] = $this->input->post("file_auth_num");
        }
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	 function dmedu_form1() { 
        $uain = $this->input->post("uain");
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
		
		$formCertData["production_capacity"] = $this->security->xss_clean($this->input->post("production_capacity"));
		$formCertData["act"] = $this->security->xss_clean($this->input->post("act"));
		$formCertData["inspection_category"] = $this->security->xss_clean($this->input->post("inspection_category"));
		$formCertData["terms"] = $this->security->xss_clean($this->input->post("terms"));
		
        
        $this->load->model("staffs/formcertifcates_model");
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        $this->updateprocess($uain, $form_table, $form_id);
    }
	

    function sendemail($form_table, $form_id, $process, $user_designation) {
        $this->load->model("staffs/cafs_model");
        $this->dept_code = $this->session->staff_dept;
        $frmRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
        $unit_id = $frmRow->user_id;
        $uain = $frmRow->uain;
        $cafRow = $this->cafs_model->get_row($unit_id);
        $entp = $cafRow->Name;
        $ubin = $cafRow->ubin;
        $email = $cafRow->b_email;
        $form_name = "Application";
        $dept_name = $this->subdepartments_model->get_deptbycode($this->dept_code)->name;

        $sub = "Application " . $process . " : " . $ubin;
        $msg = "Dear " . $entp . ",<br/><p>Your " . $form_name . " with Unique Application Identification Number : <b>" . $uain . "</b> has been forwarded by <b>" . $user_designation . " , " . $dept_name . "</b> for further processing. This is for your information only and does not require any action at your end.<br/>You may check the status and/or track your application form under ‘My Applications’, by logging onto &nbsp;<a href='https://easeofdoingbusinessinassam.in' target='_blank'>easeofdoingbusinessinassam.in </a>&nbsp;with your registered username and password.</p>";
        //sendmail($email, $sub, $msg);
        return $email . " : " . $sub . " : " . $msg;
    }

}
