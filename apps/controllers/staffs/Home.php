<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Home extends Eodbs {
    function index() {
        $this->load->helper("encode");
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("staffs/applicationreports_model");
        $this->load->view("staffs/home_view");
    }//End of index()
    
    function test() {
        $dept_code = $this->session->staff_dept;
        $this->load->model("staffs/applicationreports_model");
        $res = $this->applicationreports_model->get_formprocesstables($dept_code);
        echo "Insede Controller :".count($res)."<br /><br /><br />";
        var_dump($res);
        die();
    }//End of test()
    
    function is_connected() {
        $connected = @fsockopen("www.google.com", 80);
        if ($connected) {
            $is_conn = true;
            fclose($connected);
            die("Online");
        } else {
            $is_conn = false;
            die("Offline");
        }//End of if else
        return $is_conn;
    }//End of is_connected()
}//End of test
