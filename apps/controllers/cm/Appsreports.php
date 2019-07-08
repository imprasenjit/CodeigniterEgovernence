<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Appsreports extends Eodbc {
    function __construct() {
        parent::__construct();
        $this->load->model("admin/districts_model");
        $this->load->model("admin/offices_model");
        $this->load->model("admin/appsreports_model");
        $this->load->helper("encode");
    }
    
    function index($deptcode=NULL) {        
        $this->load->view("cm/appsreports_view");
    }//End of index()
    
    function dist($dist=NULL, $process=NULL) { 
        $district = decodeme($dist);
        $dept_code = "pcb";//$this->session->staff_dept;
        $data["district"] = $district;
        $officeRow = $this->offices_model->get_distrow($dept_code, $district);
        if($officeRow) {
            $office_id = $officeRow->id;
            if(strlen($process)>0) {
                $rows = $this->appsreports_model->get_officeprocessrows($dept_code, $office_id, $process);
            } else {
                $rows = $this->appsreports_model->get_officerows($dept_code, $office_id);
            }//End of if else
            if($rows) {
                $this->load->model("staffs/subdepartments_model");
                $this->load->model("staffs/forms_model");
                $data["title"] = "District-wise application reports";
                $data["results"] = $rows;
                $this->load->view("cms/distreports_view", $data);
            } else {
                die("No records found for office_id : ".$office_id);
            }//End of if else
        } else {
            die("No office found for District : ". $district);
        }//End of if else
    }//End of dist()
}//End of Appsreports
