<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Inspectionreports extends Eodbs {
    
    public $dept_code;
    public $staff_id;
    
    function __construct() {
        parent::__construct();
        $this->dept_code = $this->session->staff_dept;
        $this->staff_id = $this->session->staff_id;
        $this->load->helper("encode");
        $this->load->model("staffs/inspectionreports_model");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/subdepartments_model");                             
        $this->load->model("staffs/deptusers_model");
        $this->load->model("staffs/forms_model");                              
        $this->load->model("staffs/cafs_model");
    }//End of __construct()
            
    function index($uainencoded=NULL) {
        $uain = "PCB/F3/KM/000001/04/2018";//decodeme($uainencoded); //die("dept : ".$this->dept_code.", uain : ".$uain);
        $certRow = $this->applicationsup_model->get_uainrow($this->dept_code, $uain);
        if($certRow) {
            $dept_id = $this->subdepartments_model->get_deptbycode($this->dept_code)->id;
            $frmno = uainexplode($uain, "form_no");
            $fromRow = $this->forms_model->get_formname($dept_id, $frmno);
            $frmname = ($fromRow)?$fromRow->service_name:"Not found";  
            $data = array(
                "form_name" => $frmname,
                "uain" => $uain,
                "unit_id" => $certRow->unit_id,
                "process_date" => $certRow->process_date,
                "processed_by" => $certRow->processed_by,
            );
            $this->load->view("staffs/inspectionreports_view", $data);
        } else {
            die("UAIN does not Exist!");
        }//End of if else
    }//End of index()
    
    function save() {
        $uain = $this->input->post("uain");
        $uainencoded = encodeme($uain);
        $this->load->library("form_validation");
        $this->form_validation->set_rules("visit_date", "Date", "required");
        $this->form_validation->set_error_delimiters("<font class='error animated fadeIn'>", "</font>");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("flashMsg", "Please check the inputs and try again");
            $this->index($uainencoded);
        } else {
            $nowTime = date("Y-m-d H:i:s");
            $form_id = uainexplode($uain, "form_id");
            $form_no = uainexplode($uain, "form_no");
            $visit_date=$this->input->post("visit_date");
            $water_source=$this->input->post("water_source");
            $drinking_water=$this->input->post("drinking_water");
            $other_water=$this->input->post("other_water");
            $raw_materials=$this->input->post("raw_materials");
            $details_product=$this->input->post("details_product");
            $designed_capacity=$this->input->post("designed_capacity");
            $manufacr_process=$this->input->post("manufacr_process");
            $effluent =$this->input->post("effluent");
            $outfall_point =$this->input->post("outfall_point");
            $receiving_sources =$this->input->post("receiving_sources");
            $status_etp =$this->input->post("status_etp");
            $treatment_name =$this->input->post("treatment_name");
            $adequency_etp =$this->input->post("adequency_etp");
            $operational_etp =$this->input->post("operational_etp");
            $status_consent =$this->input->post("status_consent");
            $emmission_cn_sys =$this->input->post("emmission_cn_sys");
            $stack_arrange =$this->input->post("stack_arrange");
            $adequency_of_ecs =$this->input->post("adequency_of_ecs");
            $status_consent_air =$this->input->post("status_consent_air");
            $generation_treatment =$this->input->post("generation_treatment");
            $disposal_facility =$this->input->post("disposal_facility");
            $authorization_hazardous =$this->input->post("authorization_hazardous");
            $emergency_plan =$this->input->post("emergency_plan");
            $status_safty =$this->input->post("status_safty");
            $public_liability =$this->input->post("public_liability");
            $biomedical =$this->input->post("biomedical");
            $water_cess =$this->input->post("water_cess");
            $overall_obser =$this->input->post("overall_obser");
            $operational_status =$this->input->post("operational_status");
            $recom_act =$this->input->post("recom_act");
            $remarks=$this->input->post("remarks");
            $compliance=$this->input->post("compliance");
        
            $data = array(
                "form_id" => $form_id,
                "officer_id" => $this->staff_id,
                "sub_date"=>$nowTime,
                "visit_date"=>$visit_date,
                "water_source"=>$water_source,
                "drinking_water"=>$drinking_water,
                "other_water"=>$other_water,
                "raw_materials"=>$raw_materials,
                "details_product"=>$details_product,
                "designed_capacity"=>$designed_capacity,
                "manufacr_process"=>$manufacr_process,
                "effluent "=>$effluent,
                "outfall_point "=>$outfall_point,
                "receiving_sources "=>$receiving_sources,
                "status_etp "=>$status_etp,
                "treatment_name "=>$treatment_name,
                "adequency_etp "=>$adequency_etp,
                "operational_etp "=>$operational_etp,
                "status_consent "=>$status_consent,
                "emmission_cn_sys "=>$emmission_cn_sys,
                "stack_arrange "=>$stack_arrange,
                "adequency_of_ecs "=>$adequency_of_ecs,
                "status_consent_air "=>$status_consent_air,
                "generation_treatment "=>$generation_treatment,
                "disposal_facility "=>$disposal_facility,
                "authorization_hazardous "=>$authorization_hazardous,
                "emergency_plan "=>$emergency_plan,
                "status_safty "=>$status_safty,
                "public_liability "=>$public_liability,
                "biomedical "=>$biomedical,
                "water_cess "=>$water_cess,
                "overall_obser "=>$overall_obser,
                "operational_status "=>$operational_status,
                "recom_act "=>$recom_act,
                "compliance"=>$compliance,
            );
            //echo "<pre>";var_dump($data); die();

            $this->inspectionreports_model->add_row($data, $this->dept_code, $form_no);
            $report_id = $this->db->insert_id();
            $form_table = $this->dept_code."_form".$form_no;
            $addData = array(
                "form_id" => $form_id,
                "p_date" => $nowTime,
                "process_type" => "UVR",
                "user_id" => $this->staff_id,
                "doi" => date("Y-m-d"),
                "file_path" => base_url('staffs/inspectionreports/preview/'.$form_no."/".$report_id),
                "remark" => "Inspection report uploaded"
            );//End of addData array()
            
            $this->load->model("staffs/formprocess_model"); 
            $this->formprocess_model->add_row($addData, $this->dept_code, $form_table);
        
            $this->session->set_flashdata("flashMsg", "Inspection Report has been successfully submitted!");
            redirect(site_url("staffs/uploadverificationreport"));
        }//End of if else
    }//End of save()
            
    function preview($form_no=NULL, $report_id=NULL) {                
        $InsRow = $this->inspectionreports_model->get_row($report_id, $this->dept_code, $form_no);
        if($InsRow) {
            $form_table = "pcb_form".$form_no;
            $form_id = $InsRow->form_id;
            $frmRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
            $uain = $frmRow?$frmRow->uain:NULL;
            $certRow = $this->applicationsup_model->get_uainrow($this->dept_code, $uain);
            if($certRow) {
                $dept_id = $this->subdepartments_model->get_deptbycode($this->dept_code)->id;
                $frmno = uainexplode($uain, "form_no");
                $fromRow = $this->forms_model->get_formname($dept_id, $frmno);
                $frmname = ($fromRow)?$fromRow->service_name:"Not found";  
                $data = array(
                    "form_name" => $frmname,
                    "uain" => $uain,
                    "unit_id" => $certRow->unit_id,
                    "process_date" => $certRow->process_date,
                    "processed_by" => $certRow->processed_by,
                );
                $data["InsRow"] = $InsRow;
                $this->load->view("staffs/inspectionreport_preview", $data);
            } else {
                die("UAIN does not Exist!");
            }//End of if else
        } else {
            die("Form ID does not Exist!");
        }//End of if else
    }//End of preview()
}//End of Inspectionreports
