<?php
defined("BASEPATH") OR exit("No direct script access allowed!");
class Test extends CI_Controller {

    public $dept_code="doa";

    function index() {
	$staff_id = $this->session->staff_id;
	$this->load->model("staffs/deptusers_model");
	$staffRow = $this->deptusers_model->get_row($staff_id, $this->dept_code);
	$office_id=$staffRow?$staffRow->office_id:"Not found";

	//die($staff_id." : ".$office_id." => ".$this->dept_code);

	$this->load->model("staffs/offices_model"); 
	$officeRow = $this->offices_model->get_row($office_id, $this->dept_code);
	$office_name = $officeRow?$officeRow->office_name : "Not found";
	die($staff_id." : ".$office_id." => ".$office_name);
    }//End of index()
}//End of Test
