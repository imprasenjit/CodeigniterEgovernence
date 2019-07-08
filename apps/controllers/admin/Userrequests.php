<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Userrequests extends Eodba {
    function index() {
        $this->load->model("admin/userrequests_model");
        $this->load->view("admin/userrequests_view");
    }//End of index()
}//End of Userrequests