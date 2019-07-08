<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Sentonquery extends Eodbs {
    function index() {
        $this->load->helper("encode");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/queriedapplications_model");
        $this->load->view("staffs/queriedapplications_view");
    }//End of index()
}//End of Sentonquery
