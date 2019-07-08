<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Rejectedapplications extends Eodbs {
    public $dept_code;
    public $staff_id;
    
    function __construct() {
        parent::__construct();        
        $this->dept_code = $this->session->staff_dept;
        $this->staff_id = $this->session->staff_id;
        $this->load->helper("encode");
        $this->load->helper("sendmail");
        $this->load->model("staffs/applicationsir_model");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/formprocess_model");
        $this->load->model("staffs/deptusers_model");
    }
    function index() {
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("staffs/forms_model");
        $this->load->view("staffs/rejectedapplications_view");
    }//End of index()
    
    function reject(){
        $process = "R";
        $nowTime=date("Y-m-d H:i:s");        
        $uain = $this->input->post("uain");
        $form_table = uainexplode($uain, "form_table");
        $form_id = uainexplode($uain, "form_id");
        $remarks = $this->input->post("remarks");
        $reasons = $this->input->post("reasons");
        //die($this->dept_code.", ".$form_table.", ".$form_id.", ".$reasons);
        $approw = $this->applicationsup_model->get_uainrow($this->dept_code, $uain);
        if($approw) {
            $unit_id = $approw->unit_id;
            $unit_name = $approw->unit_name;
            $office_id = $approw->office_id;            
            $irData = array(
                "unit_id" => $unit_id,
                "unit_name" => $unit_name,
                "uain" => $uain,
                "process_date" => $nowTime,
                "processed_by" => $this->staff_id,
                "process" => $process,
                "office_id" => $office_id
            );
            $this->load->model("staffs/applicationsir_model");
            $this->applicationsir_model->add_row($irData, $this->dept_code);
            
            $frmprocessData = array(
                "form_id" => $form_id,
                "p_date" => $nowTime,
                "process_type" => $process,
                "user_id" => $this->staff_id,
                "remark" => $remarks
            );
            $this->formprocess_model->add_row($frmprocessData, $this->dept_code, $form_table);
            
            $this->applicationsup_model->delete_uainrow($this->dept_code, $uain);
            
            $deptuserRow = $this->deptusers_model->get_row($this->staff_id, $this->dept_code);
            
            $staff_name = ($deptuserRow)?$deptuserRow->user_name:"Staff Member";        
            //$this->sendemail($form_table, $form_id, "Rejected", $staff_name);
            echo "Application has been successfully rejected ";
        } else {
            echo "No records found!";
        }//End of if else
    }//End of reject()
    
    function rejectapp($uainencoded){
        $uain = decodeme($uainencoded);
        $process = "R";
        $nowTime=date("Y-m-d H:i:s"); 
        $form_id = uainexplode($uain, "form_id");
        $form_table = uainexplode($uain, "form_table");
        $reasons = "";
        $remarks = "";
        
        $editData = array(
            "process_date" => $nowTime,
            "processed_by" => $this->staff_id,
            "current_userid" => $this->staff_id,
            "process" => $process
        );
        $this->applicationsup_model->edit_uainrow($editData, $this->dept_code, $uain);
        
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $this->staff_id,
            "file_path" => "",
            "remark" => $remarks
        );
        $this->formprocess_model->add_row($addData, $this->dept_code, $form_table);
        
        $deptuserRow = $this->deptusers_model->get_row($this->staff_id, $this->dept_code);
        $staff_name = ($deptuserRow)?$deptuserRow->user_name:"Staff Member";        
        //$this->sendemail($form_table, $form_id, "Rejected", $staff_name);
        redirect(site_url("staffs/rejectedapplications/"));
    }//End of rejectapp()
}//End of Rejectedapplications