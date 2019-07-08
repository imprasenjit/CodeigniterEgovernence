<?php

/**
 * Description of Unit
 * 
 * @author Avantika Innovations PVT LTD
 * Prasenjit Das 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends Eodbu {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->model("users/unit_model");
        $this->load->model("eodbfunctions/state_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->helper("caf");
        $caf = get_caf($this->session->user_id);
        if ($caf) {
            if ($caf->status != 1) {
                redirect(base_url("users/home/"));
            }
        } else {
            redirect(base_url("users/caf/"));
        }
    }

    function index() {
	    //print_r($this->session->userdata());die();
        if ($this->session->user_type === "unit_user") {
            redirect("users/dashboard/view/" . $this->session->unit_id);
        } else {
            $this->load->model("users/unit_model");
            $this->load->model("eodbfunctions/state_model");
            $this->load->model("eodbfunctions/getDistrict_model");

            $this->load->model("users/uain_processes");
            $this->load->model("eodbfunctions/getApprovalusingId_model");
            $this->load->model("eodbfunctions/landbank_model");
            $this->load->helper("unittype_helper");
            $this->load->helper("get_uain_details_helper");

            $unit_id = $this->session->caf_id;
            $user_id = $this->session->user_id;
            $pending_units = $this->unit_model->getallunits("pending");
            $submitted_units = $this->unit_model->getallunits("submitted");
            $rejected_units = $this->unit_model->getallunits("rejected");
            $approved_units = $this->unit_model->getapprovedunits();
            $data = array(
                "title" => "UNITS",
                "user_id" => $user_id,
                "unit_id" => $unit_id,
                "approved_units" => $approved_units,
                "rejected_units" => $rejected_units,
                "submitted_units" => $submitted_units,
                "pending_units" => $pending_units,
            );
            $this->session->unset_userdata('unit_id');
            $this->load->view("users/requires/header", $data);
            $this->load->view("users/unit/myunit", $data);
            $this->load->view("users/requires/footer");
        }
    }

    function getentityfields() {
        $this->load->model("users/unit_model");
        $this->unit_model->getData();
    }

    /**
     * dashboard Function
     */
    function manageunits() {
        $this->load->model("users/unit_model");
        $this->load->model("eodbfunctions/state_model");
        $this->load->model("eodbfunctions/getDistrict_model");

        $this->load->model("users/uain_processes");
        $this->load->model("eodbfunctions/getApprovalusingId_model");
        $this->load->model("eodbfunctions/landbank_model");
        $this->load->helper("unittype_helper");
        $this->load->helper("get_uain_details_helper");

        $unit_id = $this->session->caf_id;
        $user_id = $this->session->user_id;
        $data = array(
            "title" => "MANAGE UNITS",
            "user_id" => $user_id,
            "unit_id" => $unit_id,
        );
        $this->load->view("users/requires/header", $data);
        $this->load->view("users/unit/unit", $data);
        $this->load->view("users/requires/footer", $data);
    }

    function pendingunits() {
        $this->load->model("users/unit_model");
        $this->load->model("eodbfunctions/state_model");
        $this->load->model("eodbfunctions/getDistrict_model");

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

        $this->unit_model->storedetails();
    }

// End of storedetails();

    function getunitdetails() {
        $this->load->model("users/unit_model");
        $this->load->view("users/unit/unitdetailsview");
    }

//End of getunitdetails()


    function storeapplicantdetails() {
        $this->load->model("users/unit_model");

        $this->unit_model->storeapplicantdetails();
    }

//End of storeapplicantdetails()


    function getapplicantdetailsview() {
        $this->load->model("users/unit_model");

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

    function edit() {
        $unitid = $this->input->get("id");
        $this->load->model("users/unit_model");
        $unitdetails = $this->unit_model->getunitdetails($unitid);
        if ($this->unit_model->check_unit_if_valid($unitid)) {
            $this->session->set_userdata('edit_unitid', $unitid);
            $this->manageunits();
        } else {
            redirect(base_url() . "users/unit/");
        }
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

    /**
     * 
     */
    function unitchangepassword() {
        $this->load->helper("unituser");
        $caf_id = $this->session->caf_id;
        $unit_id = $this->input->post("user_id");
        $password = $this->input->post("unit_password");
        if (check_if_unit_belong_to_caf($unit_id, $caf_id)) {
            if ($this->unit_model->change_unit_password($unit_id, $password)) {
                $this->session->set_flashdata("flashMsg", "Password Changed Successfully!");
                redirect(base_url("users/unit/"));
            } else {
                $this->session->set_flashdata("flashMsg", "Something Went wrong!");
                redirect(base_url("users/unit/"));
            }
        } else {
            $this->session->set_flashdata("flashMsg", "Something Went wrong!");
            redirect(base_url("users/unit/"));
        }
    }

}

//End of unit controller
