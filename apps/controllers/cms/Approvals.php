<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Approvals extends Eodbc {
    function __construct() {
        parent::__construct();
    }//End of __construct()

    function index() {
        $this->load->model("eodbfunctions/getDepartments_model");
        $data = array(
            "title" => "approvals"
        );
        $this->load->view("cms/requires/header", $data);
        $this->load->view("cms/approvals/approvals");
        $this->load->view("cms/requires/footer");
    }//End of index()

    function getApprovals() {
        $this->load->model("cms/approvals_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->approvals_model->getApprovals();
    }//End of getApprovals()
    
    function approvalview() {
        $this->load->model("cms/approvals_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->model("eodbfunctions/getDepartments_model");
        $data = array(
            "title" => "view approvals"
        );
        $this->load->view("cms/requires/header", $data);
        $this->load->view("cms/approvals/approvalview");
        $this->load->view("cms/requires/footer");
    }//End of getApproval()
    
    function editapproval() {
        $this->load->model("cms/approvals_model");
        $this->load->model("common_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->model("eodbfunctions/getDepartments_model");
        $data = array(
            "title" => "edit approvals"
        );
        $this->load->view("cms/requires/header", $data);
        $this->load->view("cms/approvals/editapproval");
        $this->load->view("cms/requires/footer");
    }//End of editapproval()
    
    function updateapproval(){
        $this->load->model("cms/approvals_model");
        $this->approvals_model->updateapproval();
    }//End of updateapproval()

    function newapproval() {
        $this->load->model("cms/approvals_model");
        $this->load->model("common_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->view("cms/requires/header",array("title"=>"new approval"));
        $this->load->view("cms/approvals/addlistofapprovals");
        $this->load->view("cms/requires/footer");
    }//End of newapproval()

    function saveapproval() {
        $this->load->model("cms/approvals_model");
        $this->approvals_model->saveapproval();
    }//End of saveapproval()
}//End of Eodbc
