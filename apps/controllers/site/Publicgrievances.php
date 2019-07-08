<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Publicgrievances extends Eodb {

    function __construct() {
        parent::__construct();
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->helper(array('form', 'url'));
    }

//End of constructor

    function index() {
        $this->load->model("site/publicGrivances_model");
        $this->load->view("site/requires/header");
        $this->load->view("site/publicgrivances/publicgrivances");
        $this->load->view("site/requires/footer");
    }

//End of Index()

    function checkUain() {
        $this->load->model("site/publicGrivances_model");
        $uain = $this->input->get("uain");
        $this->publicGrivances_model->checkuain($uain);
    }

//End of checkUain()

    function checkGrievance() {
        $grievance_token_no = $this->input->get("grievance_token_no");
        $this->load->model("site/publicGrivances_model");
        $this->publicGrivances_model->checkgrievance($grievance_token_no);
    }

//End of checkGrivance()

    function appealGrievance() {
        $this->load->model("site/publicGrivances_model");
        $this->publicGrivances_model->appealgrievance();
    }

//End of appealGrievance()

    function storeGrievance() {
        $this->load->model("site/publicGrivances_model");
        $this->publicGrivances_model->storegrievance();
    }

// End of storeGrivence()		

    function grievancetrack() {
        $this->load->model("site/publicGrivances_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->model("eodbfunctions/getUser_model");
        $this->load->view("site/requires/header");
        $this->load->view("site/publicgrivances/grievancetrack");
        $this->load->view("site/requires/footer");
    }

//End of GrievanceTrack();

    function grievanceappeal() {
        $this->load->model("site/publicGrivances_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->model("eodbfunctions/getUser_model");
        $this->load->view("site/requires/header");
        $this->load->view("site/publicgrivances/grievanceappeal");
        $this->load->view("site/requires/footer");
    }

//End of GrievanceTrack();

    function storeAppealGrievance() {
        $this->load->model("site/publicGrivances_model");
        $this->publicGrivances_model->storeAppealGrievance();
    }

//End of storeAppealGrievance()
}
