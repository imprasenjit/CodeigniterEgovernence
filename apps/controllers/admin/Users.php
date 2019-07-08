<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Users extends Eodba {
    function index() {
        $this->load->model("staffs/deptusers_model");
        $this->load->model("staffs/utypes_model");
        $this->load->view("admin/users_view");
    }//End of index()
}//End of Users