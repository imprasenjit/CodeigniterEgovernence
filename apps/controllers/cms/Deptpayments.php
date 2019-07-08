<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Deptpayments extends Eodbc {
    function __construct() {
        parent::__construct();
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("cms/paymentrequests_model");
        $this->load->model("cms/paymentresponses_model");
        $this->load->helper("text");
    }//End of __construct()
    
    function index() {
        $this->load->view("cms/requires/header", array("title" => "Departmentwise Payment Reports"));
        $this->load->view("cms/deptpayments_view");
        $this->load->view("cms/requires/footer");
    }//End of index()
}//End of Deptpayments