<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Jurisdictions extends Eodba {
    function index() {
        $this->load->model("admin/offices_model");
        $this->load->view("admin/jurisdictions_view");
    }//End of index()
}//End of Jurisdictions