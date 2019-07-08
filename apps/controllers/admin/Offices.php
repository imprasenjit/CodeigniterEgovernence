<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Offices extends Eodba {
    function index() {
        $this->load->model("admin/offices_model");
        $this->load->model("admin/districts_model");
        $this->load->view("admin/offices_view");
    }//End of index()
}//End of Offices