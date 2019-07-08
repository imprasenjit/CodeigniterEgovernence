<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Uploadverificationreport extends Eodbs {
    public $dept_code;
    public $staff_id;
    
    function __construct() {
        parent::__construct();
        $this->dept_code = $this->session->staff_dept;
        $this->staff_id = $this->session->staff_id;
        $this->load->helper("encode");
        $this->load->model("staffs/verificationschedule_model");
    }
    
    function index() {
        $this->load->view("staffs/uploadverificationreport_view");
    }//End of index()
    
    function uploadreport(){
        $this->load->helper("fileupload");
        $process = "UVR";
        $nowTime=date("Y-m-d H:i:s");        
        $uain = $this->input->post("uain");
        $form_table = uainexplode($uain, "form_table");
        $form_id = uainexplode($uain, "form_id");
        $remarks = $this->input->post("remarks");
        if (!empty($this->input->post("upload_reportfile"))) {
            $temp_doc = moveFile(2, $this->input->post("upload_reportfile"), "reportfile");
            $docfile = $temp_doc[0];
        } else {
            $docfile = NULL;
        }//die($this->dept_code.", ".$form_table.", ".$form_id.", ".$docfile);
        
        $editData = array(
            "process_date" => $nowTime,
            "processed_by" => $this->staff_id,
            "current_userid" => $this->staff_id,
            "process" => $process
        );
        $this->load->model("staffs/applicationsup_model");
        $this->applicationsup_model->edit_uainrow($editData, $this->dept_code, $uain);
        
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $this->staff_id,
            "doi" => $nowTime,
            "file_path" => $docfile,
            "remark" => $remarks
        );       
        $this->load->model("staffs/formprocess_model");
        $this->formprocess_model->add_row($addData, $this->dept_code, $form_table);
        echo "Verification report has been successfully uploaded ";
    }//End of uploadreport()
}//End of Uploadverificationreport
