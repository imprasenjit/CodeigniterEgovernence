<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Courierreceipts extends Eodbs {
    function index() {
        $this->load->helper("encode");
        $this->load->model("staffs/cafs_model");
        $this->load->model("staffs/applicationreports_model");
        $this->load->view("staffs/courierreceipts_view");
    }//End of index()
    
    function receive() {
        $dept_code = $this->session->staff_dept;
        $nowTime=date("Y-m-d H:i:s");
        $ids = $this->input->post("ids");
        $pcs = explode("|||", $ids);
        $form_table = $pcs[0];
        $form_id = $pcs[1];
        $this->load->model("staffs/forms_model");
        $this->forms_model->edit_row(array("received_date"=>$nowTime), $dept_code, $form_table, $form_id);
        echo "Courier has been successfully received on ".$nowTime;
    }//End of receive()
}//End of Courierreceipts