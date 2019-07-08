<?php

/**
 * Description of Caf
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Caf extends Eodbc {

    function __construct() {
        parent::__construct();
    }

//End of __construct()

    function unapproved() {
        $this->load->library('breadcrumb');
        $this->breadcrumb->add('Home', base_url() . "cms/");
        $this->breadcrumb->add('Unapproved CAF', base_url('caf/unapproved'));
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->view("cms/requires/header", array("title" => "Unapproved"));
        $this->load->view("cms/caf/unapprovedcaf", array("breadcrumbs" => $this->breadcrumb->render()));
        $this->load->view("cms/requires/footer");
    }

//End of unapproved()

    function viewcaf() {
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->model("site/registration_model");
        $this->load->view("cms/requires/header", array("title" => "View CAF"));
        $this->load->view("cms/caf/viewcaf");
        $this->load->view("cms/requires/footer");
    }

//End of viewcaf()

    function underquery() {
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->view("cms/requires/header", array("title" => "UNDERQUERY CAF"));
        $this->load->view("cms/caf/underquerycaf");
        $this->load->view("cms/requires/footer");
    }

//End of underquery()

    function approvedcaf() {
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->view("cms/requires/header", array("title" => "Approved Caf"));
        $this->load->view("cms/caf/approvedcaf");
        $this->load->view("cms/requires/footer");
    }

    //End of approvedcaf()

    function getapprovedcaf() {
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->caf_model->getApprovedCaf();
    }

    //End of getapprovedcaf()

    function getunapprovedcaf() {
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->caf_model->getUnApprovedCaf();
    }

    //End of getapprovedcaf()

    function getunderquerycaf() {
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->caf_model->getUnderQueryCaf();
    }

    //End of getunderquerycaf()

    function editcaf() {
        $this->load->model("eodbfunctions/state_model");
        $this->load->model("site/registration_model");
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->view("cms/requires/header", array("title" => "Edit CAF"));
        $this->load->view("cms/caf/editcaf");
        $this->load->view("cms/requires/footer");
    }

    //End of editcaf()

    function storeeditcaf() {
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->caf_model->storeeditcaf();
    }

    //End of storeeditcaf()

    function approvecaf() {
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->caf_model->approvecaf();
    }

    //End of approvecaf()

    function querycaf() {
        $this->load->model("cms/caf_model");
        $this->caf_model->querycaf();
    }

    //End of querycaf()

    /**
     * 
     */
    function unverifiedcaf() {
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->view("cms/requires/header", array("title" => "Unverified Caf"));
        $this->load->view("cms/caf/unverifiedcaf");
        $this->load->view("cms/requires/footer");
    }

    /**
     * 
     */
    function getunverified() {
        $this->load->model("eodbfunctions/address_model");
        $this->load->model("cms/caf_model");
        $this->caf_model->getunverified();
    }

    /**
     * 
     */
    function rejectedcaf() {
        $this->load->model("cms/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->load->view("cms/requires/header", array("title" => "Rejected Caf"));
        $this->load->view("cms/caf/rejectedcaf");
        $this->load->view("cms/requires/footer");
    }

    /**
     * 
     */
    function getrejectedcaf() {
        $this->load->model("eodbfunctions/address_model");
        $this->load->model("cms/caf_model");
        $this->caf_model->getRejectedCaf();
    }

}
