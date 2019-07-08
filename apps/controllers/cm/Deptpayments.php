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
        $this->load->view("cm/deptpayments_view");
    }//End of index()
}//End of Deptpayments