<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Distreports extends Eodba {
    function index() {
        $this->load->model("admin/districts_model");
        $this->load->view("admin/distreports_view");
    }//End of index()
    
    function dists() {
        $this->load->model("staffs/applicationreports_model");
        $res = $this->applicationreports_model->get_distApplications("pcb");
        echo "<pre>";
        var_dump($res);
        echo "</pre>";
    }//End of save()
}//End of Distreports