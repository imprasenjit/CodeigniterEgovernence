<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Approvals extends Eodb {
    function __construct() {
        parent::__construct();
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
    }

    function index() {
        $this->load->view("site/requires/header");
        $this->load->view("site/approvals/approvals");
        $this->load->view("site/requires/footer");
    }//End of index()

    function getsubdept() {
        $this->load->view("site/approvals/getsubdepartment");
    }

    function getapprovals() {
        $this->load->model("site/getApproval_model");
        $this->load->view("site/approvals/getapprovals");
    }

    function viewapproval() {
        $this->load->model("eodbfunctions/getApprovalusingId_model");
        $this->load->model("site/getApproval_model");
        $this->load->view("site/requires/header");
        $this->load->view("site/approvals/viewapproval");
        $this->load->view("site/requires/footer");
    }

	function onlineverification($uainencoded=NULL) {
		$this->load->helper("encode");
        $this->load->helper("unittype");
        $this->load->helper("formprocesses");
		$this->load->model("staffs/forms_model");
        $this->load->model("staffs/formprocess_model");
        $this->load->model("users/caf_model");
		$this->load->model('users/unit_model');
		$this->load->model('ovs_model');
		$this->load->model('eodbfunctions/address_model');
        $this->load->model("staffs/queriedapplications_model");
		$data["token"] = $this->input->post("token"); 
		$this->load->view("site/requires/header");
		$this->load->view("site/online_verification_view",$data);
		$this->load->view("site/requires/footer");
    } 
	
	
	function ovs($uainencoded=NULL) {
		$this->load->helper("encode");
        $this->load->helper("unittype");
        $this->load->helper("formprocesses");
		$this->load->model("staffs/forms_model");
        $this->load->model("staffs/formprocess_model");
        $this->load->model("users/caf_model");
		$this->load->model('users/unit_model');
		$this->load->model('ovs_model');
		$this->load->model('eodbfunctions/address_model');
        $this->load->model("staffs/queriedapplications_model");
		$this->load->view("site/requires/header");
		$data["token"] = $this->input->get("token"); 
		$this->load->view("site/online_verification_view",$data);
		$this->load->view("site/requires/footer");
    } 
	
	
	
	
	
}
