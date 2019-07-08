<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Issuenoc extends Eodbs {
    
    public $dept_code;
    public $dept_name;
    public $staff_id;
    
    function __construct() {
        parent::__construct();
        $this->dept_code = $this->session->staff_dept;
        $this->staff_id = $this->session->staff_id;
        $this->load->helper("encode");
        $this->load->library("ciqrcode");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/applicationsir_model");
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("staffs/forms_model");
        $this->load->model("staffs/formprocess_model");
        $this->load->model("staffs/formcertifcates_model");
        $this->dept_name = $this->subdepartments_model->get_deptbycode($this->dept_code)->name;
    }//End of __construct()
            
    function index() {
    }//End of index()

    function issue($uainencoded=NULL) {
        $this->uain = decodeme($uainencoded);
        
        $certRow = $this->applicationsup_model->get_uainrow($this->dept_code, $this->uain);
        if($certRow) {
            $dept_id = $this->subdepartments_model->get_deptbycode($this->dept_code)->id;
            $frmno = uainexplode($this->uain, "form_no");
            $form_table = $this->dept_code."_form".$frmno;
            $form_id = uainexplode($this->uain, "form_id");
            $formCertRow = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);

            $fromRow = $this->forms_model->get_formname($dept_id, $frmno);
            $frmname = ($fromRow)?$fromRow->service_name:"Not found";                                
            $this->load->model("staffs/cafs_model");
            $data = array(
                "form_no" => $frmno,
                "form_name" => $frmname,
                "uain" => $this->uain,
                "swr_id" => $certRow->unit_id
            );
            $data['form_cert_row'] = $formCertRow;
            $this->load->view("depts/".$this->dept_code."/form".$frmno."_issuenoc", $data);
        } else {
            die("UAIN does not Exist!");
        }//End of if else
    }//End of issue() 
    
    function save() {
        
    }//End of save()
}//End of Issuenoc
