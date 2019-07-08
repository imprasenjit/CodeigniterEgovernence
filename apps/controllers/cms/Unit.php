<?php

/**
 * Description of Unit
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends Eodbc {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model("cms/unit/unit_model");
        $this->load->model("eodbfunctions/address_model");
    }

    function approved() {
        $this->load->view("cms/requires/header", array("title" => "Approved"));
        $this->load->view("cms/unit/approvedunit");
        $this->load->view("cms/requires/footer");
    }

    function getapprovedunit() {
  
        $this->unit_model->getapprovedunit();
    }

    function unapproved() {
       
        $this->load->view("cms/requires/header", array("title" => "Unapproved"));
        $this->load->view("cms/unit/unapprovedunit");
        $this->load->view("cms/requires/footer");
    }

    function getunapprovedunit() {
        
        $this->unit_model->getunapprovedunit();
    }
    function modified() {
       
        $this->load->view("cms/requires/header", array("title" => "Modified"));
        $this->load->view("cms/unit/modifiedunit");
        $this->load->view("cms/requires/footer");
    }

    function getmodifieddunit() {
        
        $this->unit_model->getmodifiedunit();
    }

    function underquery() {
        
        $this->load->view("cms/requires/header", array("title" => "Underquery"));
        $this->load->view("cms/unit/underqueryunit");
        $this->load->view("cms/requires/footer");
    }

    function getunderqueryunit() {
       
        $this->unit_model->getunderqueryunit();
    }

    function rejected() {
       
        $this->load->view("cms/requires/header", array("title" => "Rejected"));
        $this->load->view("cms/unit/rejectedunit");
        $this->load->view("cms/requires/footer");
    }

    function getrejectedunit() {
       
        $this->unit_model->getrejectedunit();
    }

    function edit($unitid) {
        $this->load->model("users/unit_model");
       
        $unitdetails = $this->unit_model->getunitdetails($unitid);
        if ($unitid) {
            $this->session->set_userdata('edit_unitid', $unitid);
            $this->manageunits($unitid);
        } else {
            redirect(base_url() . "users/unit/");
        }
    }


    function manageunits($unitid) {
        $this->load->model("users/unit_model");
        $this->load->model("eodbfunctions/state_model");
        $this->load->model("eodbfunctions/getDistrict_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->model("users/uain_processes");
        $this->load->model("eodbfunctions/getApprovalusingId_model");
        $this->load->model("eodbfunctions/landbank_model");
        $this->load->helper("unittype_helper");
        $this->load->helper("get_uain_details_helper");
        $this->session->set_userdata("edit_unitid",$unitid);
        $data = array(
            "title" => "VIEW UNITS",
        );
        $this->load->view("cms/requires/header", $data);
        $this->load->view("cms/unit/unit", $data);
        $this->load->view("cms/requires/footer", $data);
    }
    
    function action($actiontype){
         $this->load->model("cms/unit/unit_model");
        
         if($actiontype=="approve"){
             $this->unit_model->approveunit();
         }else if($actiontype=="reject"){
             $this->unit_model->rejectunit();
         }else if($actiontype=="edit"){
             $this->unit_model->resetunit();
         }
    }

    function index() {
        
        $this->unapproved();
//        $this->load->model("users/unit_model");
//        $this->load->model("eodbfunctions/state_model");
//        $this->load->model("eodbfunctions/getDistrict_model");
//        $this->load->model("eodbfunctions/address_model");
//        $this->load->model("users/uain_processes");
//        $this->load->model("eodbfunctions/getApprovalusingId_model");
//        $this->load->model("eodbfunctions/landbank_model");
//        $this->load->helper("unittype_helper");
//        $this->load->helper("get_uain_details_helper");
//
//        $unit_id = $this->session->caf_id;
//        $user_id = $this->session->user_id;
//        $pending_units = $this->unit_model->getallunits();
//        $approved_units = $this->unit_model->getallunits("approved");
//        $data = array(
//            "title" => "UNITS",
//            "user_id" => $user_id,
//            "unit_id" => $unit_id,
//            "units" => $approved_units,
//            "pending_units" => $pending_units,
//        );
//        $this->load->view("users/requires/header", $data);
//        $this->load->view("users/unit/myunit", $data);
//        $this->load->view("users/requires/footer");
    }

    function getentityfields() {
        $this->load->model("users/unit_model");
        $this->unit_model->getData();
    }

    function pendingunits() {
        $this->load->model("users/unit_model");
        $this->load->model("eodbfunctions/state_model");
        $this->load->model("eodbfunctions/getDistrict_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->model("users/uain_processes");
        $this->load->model("eodbfunctions/getApprovalusingId_model");
        $this->load->model("eodbfunctions/landbank_model");
        $this->load->helper("unittype_helper");
        $this->load->helper("get_uain_details_helper");

        $unit_id = $this->session->unit_id;
        $user_id = $this->session->user_id;

        $pending_units = $this->unit_model->getallunits();
        $pending_units = $this->unit_model->getallunits();
        $data = array(
            "title" => "PENDING UNITS",
            "user_id" => $user_id,
            "unit_id" => $unit_id,
            "units" => $pending_units,
            "pending_units" => $pending_units,
        );
        $this->load->view("users/requires/header", $data);
        $this->load->view("users/unit/pendingunits", $data);
        $this->load->view("users/requires/footer", $data);
    }

//End of getentityfields()

    function storedetails() {
        $this->load->model("users/unit_model");
        $this->load->model("eodbfunctions/address_model");
        $this->unit_model->storedetails();
    }

// End of storedetails();

    function getunitdetails() {
        $this->load->model("users/unit_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->view("users/unit/unitdetailsview");
    }

//End of getunitdetails()


    function storeapplicantdetails() {
        $this->load->model("users/unit_model");
        $this->load->model("eodbfunctions/address_model");
        $this->unit_model->storeapplicantdetails();
    }

//End of storeapplicantdetails()


    function getapplicantdetailsview() {
        $this->load->model("users/unit_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->view("users/unit/applicantdetailsview");
    }

//End of getapplicantdetailsview()

    function storelanddetails() {
        $this->load->model("users/unit_model");
        $this->unit_model->storelanddetails();
    }

//End of storelanddetails()

    function getlanddetailsview() {
        $this->load->model("users/unit_model");
        $this->load->view("users/unit/landdetailsview");
    }

//End of getlanddetailsview()

    function getbusinesstypes() {
        $this->load->model("users/unit_model");
        $sectorid = $this->input->post("sector");
        $businesstypes = $this->unit_model->getbusinesstypes($sectorid);
        foreach ($businesstypes as $businesstype) {
            echo '<option value="' . $businesstype->business_id . '">' . $businesstype->business_type . '</option>';
        }
    }

//End of getbusinesstypes()

    function storeotherdetails() {
        $this->load->model("users/unit_model");
        $this->unit_model->storeotherdetails();
    }

//End of storeotherdetails()

    function getotherdetailsview() {
        $this->load->model("users/unit_model");
        $this->load->view("users/unit/otherdetailsview");
    }

//End of getlanddetailsview()


    function submitfinalunit() {
        $this->load->model("users/unit_model");
        $this->unit_model->submitfinalunit();
    }

//End of submitfinalunit()


    function add() {
        $this->session->unset_userdata('edit_unitid');
        $this->manageunits();
    }

//End of edit()



    function storedocuments() {
        $this->load->model("users/unit_model");
        $this->unit_model->storedocuments();
    }

//End of storedocuments()

    function getunitdocuments() {
        $this->load->model("users/unit_model");
        $this->unit_model->getunitdocuments();
    }

}
