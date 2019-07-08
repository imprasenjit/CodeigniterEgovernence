<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Applicationprocess extends Eodbs {

    public $dept_code;
    public $dept_name;
    public $staff_id;
    public $frmtbl;
    public $form_id;
    public $form_no;
    public $uain;
    public $swr_id;
    
    function __construct() {
        parent::__construct();
        $this->dept_code = $this->session->staff_dept;
        $this->staff_id = $this->session->staff_id;
        $this->load->helper("sendmail");
        $this->load->helper("encode");
        $this->load->model("staffs/deptusers_model");
        $this->load->model("staffs/offices_model");
        $this->load->model("staffs/utypes_model");
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("staffs/forms_model");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/applicationsir_model"); 
        $this->load->model("staffs/formprocess_model");
        $this->dept_name = $this->subdepartments_model->get_deptbycode($this->dept_code)->name;
    }//End of construct()
    
    function index($uainencoded=NULL) {
        $this->uain = decodeme($uainencoded);
        $this->form_id = uainexplode($this->uain, "form_id");
        $this->frm_no = uainexplode($this->uain, "form_no"); //die($this->uain." : ".$this->frm_no);
        if($this->frm_no > 0) {
            $this->frmtbl = $this->dept_code."_form".$this->frm_no;
            $frmRow = $this->forms_model->get_uainrow($this->dept_code, $this->frmtbl, $this->uain);
            if($frmRow) {
                $this->swr_id = $frmRow->user_id;
                $this->load->view("staffs/applicationprocess_view");
            } else {
                die($this->uain.", UAIN not found!");
            }
        } else {
            die("Form does not exist");
        }
    }//End of index()

    function forward(){
        $process = "F";
        $nowTime=date("Y-m-d H:i:s");
        $uain = $this->input->post("uain"); 
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $dept_office_id = $this->input->post("dept_office_id");
        $dept_user_id = $this->input->post("dept_user_id");
        $remarks = $this->input->post("remarks"); 
        $editData = array(
            "process_date" => $nowTime,
            "processed_by" => $this->staff_id,
            "office_id" => $dept_office_id,
            "current_userid" => $dept_user_id,
            "process" => $process
        );
        $this->applicationsup_model->edit_uainrow($editData, $this->dept_code, $uain);
        
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $this->staff_id,
            "file_path" => NULL,
            "remark" => $remarks,
            "forward_to" => $dept_user_id
        );
        $this->formprocess_model->add_row($addData, $this->dept_code, $form_table);        
        echo "Application has been successfully forwarded ";
    }//End of forward()
    
    function approve(){
        $process = "A";
        $nowTime=date("Y-m-d H:i:s");        
        $uain = $this->input->post("uain"); 
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $remarks = $this->input->post("remarks");
        
        $editData = array(
            "process_date" => $nowTime,
            "processed_by" => $this->staff_id,
            "current_userid" => $this->staff_id,
            "process" => $process,
            "other_status" => 1
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
                          
        /* $regularyear_from = $this->input->post("regularyear_from");
        $regularyear_to = $this->input->post("regularyear_to"); */
        $lic_exp_year = $this->input->post("lic_exp_year");
        $regular_fees = $this->input->post("regular_fees");
        
        $arrear_fees_details_y1 = $this->input->post("arrear_fees_details_y1");
        $arrear_fees_details_y2 = $this->input->post("arrear_fees_details_y2");
        $arrear_fees_details_fees = $this->input->post("arrear_fees_details_fees");
        
        $arrear_fees_details["y1"] = $arrear_fees_details_y1;
        $arrear_fees_details["y2"] = $arrear_fees_details_y2;
        $arrear_fees_details["fees"] = $arrear_fees_details_fees;
        
        $arrear_fees_details = json_encode($arrear_fees_details, true);
        
        $penalty_charge = $this->input->post("penalty_charge");
        $total_fees = $this->input->post("total_fees"); 
        
        $certData = array(
            "form_id" => $form_id,
            "user_id" => $this->staff_id,
            "sub_date" => $nowTime,
            "lic_exp_year" => $lic_exp_year,
            "regular_fees" => $regular_fees,
            "arrear_fees_details" => $arrear_fees_details,
            "penalty_charge" => $penalty_charge,
            "total_fees" => $total_fees,
        );
        $this->load->model("staffs/formcertifcates_model");
		
        $certificate_row = $this->formcertifcates_model->get_row($this->dept_code, $form_table, $form_id);
		if($certificate_row){
			$this->formcertifcates_model->edit_row($certData, $this->dept_code, $form_table, $form_id);
		}else{
			$this->formcertifcates_model->add_row($certData, $this->dept_code, $form_table);
		}
             
        echo "Application has been successfully approveded";
    }//End of approve()
    
    function gmc_certificates() {
        $nowTime=date("Y-m-d H:i:s");        
        $uain = $this->input->post("uain"); 
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $remarks = $this->input->post("remarks");
        die("staff_id : ".$this->staff_id.", uain : ".$uain.", remarks : ".$remarks);
    }//End of gmc_certificates()
    
    function verify(){
        $process = "V";
        $nowTime=date("Y-m-d H:i:s");        
        $uain = $this->input->post("uain"); 
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $dov = date("Y-m-d", strtotime($this->input->post("dov")));
        $remarks = $this->input->post("remarks");
        
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
            "doi" => $dov,
            "remark" => $remarks
        );       
        $this->formprocess_model->add_row($addData, $this->dept_code, $form_table);
        echo "Application has been successfully verified ";
    }//End of verify()
    
    function reject(){
        $process = "R";
        $nowTime=date("Y-m-d H:i:s");
        $uain = $this->input->post("uain"); 
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $reasons = $this->input->post("reasons");
        $remarks = $this->input->post("remarks");
        
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
        $this->sendemail($form_table, $form_id, "Rejected", $staff_name);
    }//End of reject()
    
    function issuecer(){
        $process = "I";
        $nowTime=date("Y-m-d H:i:s");        
        $uain = $this->input->post("uain"); 
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $file_auth_num = $this->input->post("file_auth_num");
        
        
       $formCertData = array(); 
       
        $file_no = $this->input->post("file_no");
        if($file_no) {
            $formCertData["file_no"] = $file_no;
        } 
        $lic_no = $this->input->post("lic_no");
        if($lic_no) {
            $formCertData["lic_no"] = $lic_no;
        } 
        $plan_no = $this->input->post("plan_no");
        if($plan_no) {
            $formCertData["plan_no"] = $plan_no;
        }        
        $plan_no_date = $this->input->post("plan_no_date");
        if($plan_no_date) {
            $formCertData["plan_no_date"] = $plan_no_date;
        }
        $consist_of = $this->input->post("consist_of");
        if($consist_of) {
            $formCertData["consist_of"] = $consist_of;
        }
        $production_capacity = $this->input->post("production_capacity");
        if($production_capacity) {
            $formCertData["production_capacity"] = $production_capacity;
        }
        $act = $this->input->post("act");
        if($act) {
            $formCertData["act"] = $act;
        }
        $remarks = $this->input->post("remarks");
        if($remarks) {
            $formCertData["remarks"] = $remarks;
        }
        /*$valid_date = $this->input->post(valid_date);
        if($valid_date) {
            $formCertData["valid_date"] = $valid_date;
        }*/
        $industry_category_id = $this->input->post("industry_category_id");
        if($industry_category_id) {
            $formCertData["industry_category_id"] = $industry_category_id;
        }

        $this->load->model("staffs/formcertifcates_model");       
        $this->formcertifcates_model->edit_row($formCertData, $this->dept_code, $form_table, $form_id);
        
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
            $this->applicationsir_model->add_row($irData, $this->dept_code);
            $this->applicationsup_model->delete_uainrow($this->dept_code, $uain);
        }            
        
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $this->staff_id
        );//End of addData
        $this->formprocess_model->add_row($addData, $this->dept_code, $form_table);
                                         
        $deptuserRow = $this->deptusers_model->get_row($this->staff_id, $this->dept_code);
        $staff_name = ($deptuserRow)?$deptuserRow->user_name:"Staff Member"; 
        $this->sendemail($form_table, $form_id, "Certificate/License/NOC Uploaded", $staff_name);
    }//End of issuecer()
    
    function issuenoc(){
        $process = "I";
        $nowTime=date("Y-m-d H:i:s");        
        $uain = $this->input->post("uain"); 
        $form_table = $this->input->post(("form_table"));
        $form_id = $this->input->post(("form_id"));
        
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
            "user_id" => $this->staff_id
        );
        $this->formprocess_model->add_row($addData, $this->dept_code, $form_table);
        
        $deptuserRow = $this->deptusers_model->get_row($this->staff_id, $this->dept_code);
        $staff_name = ($deptuserRow)?$deptuserRow->user_name:"Staff Member"; 
        $this->sendemail($form_table, $form_id, "Certificate/License/NOC Issued", $staff_name);
    }//End of issuenoc()
    
    function reports(){
        $process = "UVR";
        $nowTime=date("Y-m-d H:i:s");
        $todatDate = date("Y-m-d");      
        $uain = $this->input->post("uain");   
        $form_table = $this->input->post("form_table");
        $form_id = $this->input->post("form_id");
        $remarks = $this->input->post("remarks");
        $this->load->helper("fileupload");
        $files = $this->input->post("reportfile");
        $uploades =moveFile(1,$files);
        $reportfile = $uploades["reportfile"];
        
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
            "doi" => $todatDate,
            "file_path" => $reportfile,
            "remark" => $remarks
        );//End of addData array()
        $this->formprocess_model->add_row($addData, $this->dept_code, $form_table);
        
        $deptuserRow = $this->deptusers_model->get_row($this->staff_id, $this->dept_code);
        $staff_name = ($deptuserRow)?$deptuserRow->user_name:"Staff Member"; 
        $this->sendemail($form_table, $form_id, "Recommendation Letter Uploaded", $staff_name);
    }//End of reports()
    
    function sendemail($form_table, $form_id, $process, $user_designation) {
        $this->load->model("staffs/cafs_model");
        $this->dept_code = $this->session->staff_dept;
        $frmRow = $this->forms_model->get_row($this->dept_code, $form_table, $form_id);
        $unit_id = $frmRow->user_id;
        $uain = $frmRow->uain;
        $cafRow = $this->cafs_model->get_row($unit_id);
        $entp = $cafRow->Name;
        $ubin = $cafRow->ubin;
        $email = $cafRow->b_email;
        $form_name = "Application";        
        $dept_name = $this->subdepartments_model->get_deptbycode($this->dept_code)->name;
        
        $sub="Application ".$process." : ".$ubin;
        $msg="Dear ".$entp.",<br/><p>Your ".$form_name." with Unique Application Identification Number : <b>".$uain."</b> has been forwarded by <b>".$user_designation." , ".$dept_name."</b> for further processing. This is for your information only and does not require any action at your end.<br/>You may check the status and/or track your application form under ‘My Applications’, by logging onto &nbsp;<a href='https://easeofdoingbusinessinassam.in' target='_blank'>easeofdoingbusinessinassam.in </a>&nbsp;with your registered username and password.</p>";
        //sendmail($email, $sub, $msg);
        return $email." : ".$sub." : ".$msg;
    }//End of sendemail()    
}//End of Applicationprocess
