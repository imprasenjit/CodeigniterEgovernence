<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Uploadcertificates extends Eodbs {
    public $dept_code;
    public $staff_id;
    
    function __construct() {
        parent::__construct();        
        $this->dept_code = $this->session->staff_dept;
        $this->staff_id = $this->session->staff_id;
        $this->load->helper("encode");
        $this->load->helper("formprocesses");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/applicationsir_model");
        $this->load->model("staffs/formprocess_model");
    }
    function index() { //die("dept : ".$this->dept_code."staff_id : ".$this->staff_id);
        $this->load->model("staffs/deptusers_model");
        $this->load->view("staffs/uploadcertificates_view");
    }//End of index()
    
    function uploadcertificate(){
        $this->load->helper("fileupload");
        $process = "C";
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
        $approw = $this->applicationsir_model->get_uainrow($this->dept_code, $uain);
        if($approw) {
            $ir_id = $approw->ir_id;
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
            //$this->applicationsir_model->add_row($irData, $this->dept_code);
            $this->applicationsir_model->edit_row($ir_id, $irData, $this->dept_code);
            
            $frmprocessData = array(
                "form_id" => $form_id,
                "p_date" => $nowTime,
                "process_type" => $process,
                "user_id" => $this->staff_id,
                "file_path" => $docfile,
                "remark" => $remarks
            );
            $this->formprocess_model->add_row($frmprocessData, $this->dept_code, $form_table);
            
            //$this->applicationsup_model->delete_uainrow($this->dept_code, $uain);
            echo "Certificate has been successfully uploaded ";
        } else {
            echo "No records found!";
        }//End of if else
    }//End of uploadcertificate()
}//End of Uploadcertificates
