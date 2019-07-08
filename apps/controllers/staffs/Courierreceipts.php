<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Courierreceipts extends Eodbs {
    function __construct() {
        parent::__construct();
        $this->load->helper("encode");
        $this->load->model("staffs/applicationsup_model");
    }
    
    function index() { //die($this->session->staff_id);
        $this->load->helper("encode");
        $this->load->model("staffs/forms_model");
        $this->load->view("staffs/courierreceipts_view");
    }//End of index()
    
    function receive() {
        $staff_id = $this->session->staff_id;
        $dept_code = $this->session->staff_dept;
        $nowTime=date("Y-m-d H:i:s");
        $ids = $this->input->post("ids");
        $pcs = explode("|||", $ids);
        $frmtbl = $pcs[0];
        $uain = $pcs[1];
        $this->load->model("staffs/forms_model");
        $this->load->model("staffs/applicationsup_model");
        $this->forms_model->edit_uainrow(array("received_date"=>$nowTime), $dept_code, $frmtbl, $uain);
        $this->applicationsup_model->edit_uainrow(array("process_date"=>$nowTime, "processed_by"=>$staff_id, "process"=>"RC"), $dept_code, $uain);
        echo "Courier has been successfully received on ".$nowTime;
    }//End of receive()
}//End of Courierreceipts
