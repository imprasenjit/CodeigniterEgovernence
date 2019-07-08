<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Reports extends Eodba {
    function index() {
        $this->load->view("admin/reports_view");
    }//End of index()
}//End of Reports