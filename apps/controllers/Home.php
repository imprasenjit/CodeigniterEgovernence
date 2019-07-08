<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Home extends Eodb {
    function index() {
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");

        $this->load->view("site/requires/header");
        $this->load->view("site/home");
        $this->load->view("site/requires/footer");
    }//End of index()
}
