<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Applicationprocess extends Eodbs {
    function __construct() {
        parent::__construct();
        $this->load->helper("sendmail");
        $this->load->model("staffs/deptusers_model");
        $this->load->model("staffs/utypes_model");
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("staffs/forms_model");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/applicationsir_model");
    }//End of construct()
    
    function index($frm_id=NULL) {
        $this->load->helper("encode");
        $this->load->model("staffs/applicationreports_model");
        $this->load->view("staffs/applicationprocess_view");
    }//End of index()
    function forward_to_users(){
        $staff_id = $this->input->post("staff_id");
        $dept = $this->input->post("dept");
        $office_id = $this->input->post("forward_to_office");
        
        $office_id = $this->input->post("forward_to_office");
        
        $this->load->model("staffs/Deptusers_model");
        echo '<option value="">Please Select</option>';
	if($dept=="fire"){
            $fields = "user_id,user_name,udesig,fire_station";
            //$forwardUsersQuery="select user_id,user_name,udesig,fire_station from users where status='1' and user_id!='$staff_id' and user_id!='1' and office_id='$office_id'";
            //$results=$admin_fetch_functions->executeQuery($dept,$forwardUsersQuery); 
            $user_lists = $this->Deptusers_model->get_forward_users($dept,$staff_id,$office_id,$fields);
            
            $this->load->model("staffs/Firedept_model");
            
            
            foreach($user_lists as $rows){ 
                $fire_station=$rows->fire_station;
                $station_name = $this->Deptusers_model->get_nearest_fire_station_name($fire_station);
                echo '<option value="'. $rows->user_id .'">'. $rows->user_name .' ('. $rows->udesig .' , '. $station_name .')</option>';
            } 
	}else{
            $fields = "user_id,user_name,udesig";
            $user_lists = $this->Deptusers_model->get_forward_users($dept,$staff_id,$office_id,$fields);		 
            foreach($user_lists as $rows){ 
                echo '<option value="'. $rows->user_id .'">'. $rows->user_name .' ('. $rows->udesig .')</option>';
            }
	}
    }
    function forward(){
        $process = "F";
        $uid = $this->session->staff_id;
        $nowTime=date("Y-m-d H:i:s");
        $dept_code = $this->input->post("dept");
        $form_table = $this->input->post("tbl");
        $form_id = $this->input->post("fid");
        $remarks = $this->input->post("rem");
        $forward_to_office = $this->input->post("fto");
        $forward_to = $this->input->post("ft");
        $this->load->model("staffs/forms_model");        
        $this->load->model("staffs/formprocess_model");
        
        if($this->deptusers_model->get_row($uid, $dept_code)) {
            $deptUser = $this->deptusers_model->get_row($uid, $dept_code);
            $user_id = $deptUser->user_id;
            $forward_user_name = $deptUser->user_name;
            $utype = $deptUser->utype;
            $user_designation = $this->utypes_model->get_row($utype, $dept_code)->utype_name;
        } else {
            $user_id = $forward_user_name = $user_designation = "Not found!";
        }//End of if else
        
        if($this->deptusers_model->get_row($forward_to, $dept_code)) {
            $forwardToRow = $this->deptusers_model->get_row($forward_to, $dept_code);
            $forwardTo_user_name = $forwardToRow->user_name;
        } else {
            $forwardTo_user_name = "Not found!";
        }//End of if else
        
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $uid,
            "file_path" => "",
            "remark" => $remarks,
            "forward_to" => $forward_to
        );
        
        $editData = array(
            "status" => 0,
            "p_date" => $nowTime
        );
        
        $uain = $this->forms_model->get_row($dept_code, $form_table, $form_id)?$this->forms_model->get_row($dept_code, $form_table, $form_id)->uain:"";
        $upData = array(
            "uain" => $uain,
            "process_date" => $nowTime,
            "processed_by" => $uid,
            "process" => $process,
            "current_user" => $forward_to
        );//print_r($upData); die();
        if($this->applicationsup_model->check_row($uain, $dept_code)) {
            $processId = $this->applicationsup_model->check_row($uain, $dept_code)->id;
            $this->applicationsup_model->edit_row($processId, $upData, $dept_code);
        } else {
            $this->applicationsup_model->add_row($upData, $dept_code);
        }//End of if else
        
        $this->forms_model->edit_row(array("is_viewed"=>"R"), $dept_code, $form_table, $form_id);
        $this->formprocess_model->edit_row($editData, $dept_code, $form_table, $form_id);
        $this->formprocess_model->add_row($addData, $dept_code, $form_table);
                                 
        $this->sendemail($form_table, $form_id, "Forwarded", $user_designation);
        
        echo "Application has been successfully forward to ".$forwardTo_user_name;
    }//End of forward()
    
    function approve(){
        $process = "A";
        $uid = $this->session->staff_id;
        $nowTime=date("Y-m-d H:i:s");
        $dept_code = $this->input->post("dept");
        $form_table = $this->input->post("tbl");
        $form_id = $this->input->post("fid");
        $remarks = $this->input->post("rem");
        $this->load->model("staffs/forms_model");        
        $this->load->model("staffs/formprocess_model");        
        if($this->deptusers_model->get_row($uid, $dept_code)) {
            $deptUser = $this->deptusers_model->get_row($uid, $dept_code);
            $user_id = $deptUser->user_id;
            $forward_user_name = $deptUser->user_name;
            $utype = $deptUser->utype;
            $user_designation = $this->utypes_model->get_row($utype, $dept_code)->utype_name;
        } else {
            $user_id = $forward_user_name = $user_designation = "Not found!";
        }//End of if else
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $uid,
            "file_path" => "",
            "remark" => $remarks
        );
        $editData = array(
            "status" => 0,
            "p_date" => $nowTime
        );        
        $uain = $this->forms_model->get_row($dept_code, $form_table, $form_id)?$this->forms_model->get_row($dept_code, $form_table, $form_id)->uain:"";
        $upData = array(
            "uain" => $uain,
            "process_date" => $nowTime,
            "processed_by" => $uid,
            "process" => $process,
            "current_user" => $uid,
            "other_status" => 0
        );//print_r($upData);
        if($this->applicationsup_model->check_row($uain, $dept_code)) {
            $processId = $this->applicationsup_model->check_row($uain, $dept_code)->id;
            $this->applicationsup_model->edit_row($processId, $upData, $dept_code);
        } else {
            $this->applicationsup_model->add_row($upData, $dept_code);
        }//End of if else
        
        $this->formprocess_model->edit_row($editData, $dept_code, $form_table, $form_id);
        $this->formprocess_model->add_row($addData, $dept_code, $form_table);
        
        $this->sendemail($form_table, $form_id, "Approved", $user_designation);
        
        echo "Application has been successfully approved on ".$nowTime;
    }//End of approve()
    
    function gmc_certificates() {
        $process = "V";
        $uid = $this->session->staff_id;
        $nowTime=date("Y-m-d H:i:s");
        $dept_code = $this->input->post("dept");
        $form_table = $this->input->post("tbl");
        $form_id = $this->input->post("fid");
        if(date("m")>3) {
            $lic_exp_year=date("Y")+1;
        } else {
            $lic_exp_year=date("Y");
        }//End of if else
        $regular_fees=$this->input->post("regular_fees");
        $penalty_charge=$this->input->post("penalty_charges");
        $total_fees=$this->input->post("total_fees");
        $this->load->model();
    }//End of gmc_certificates()
    
    function verify(){
        $uid = $this->session->staff_id;
        $nowTime=date("Y-m-d H:i:s");
        $dept_code = $this->input->post("dept");
        $form_table = $this->input->post("tbl");
        $form_id = $this->input->post("fid");
        $remarks = $this->input->post("rem");
        $dov = date("Y-m-d", strtotime($this->input->post("dov")));
        $this->load->model("staffs/forms_model");        
        $this->load->model("staffs/formprocess_model");       
        if($this->deptusers_model->get_row($uid, $dept_code)) {
            $deptUser = $this->deptusers_model->get_row($uid, $dept_code);
            $user_id = $deptUser->user_id;
            $forward_user_name = $deptUser->user_name;
            $utype = $deptUser->utype;
            $user_designation = $this->utypes_model->get_row($utype, $dept_code)->utype_name;
        } else {
            $user_id = $forward_user_name = $user_designation = "Not found!";
        }//End of if else
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $uid,
            "doi" => $dov,
            "remark" => $remarks
        );        
        $editData = array(
            "status" => 0,
            "p_date" => $nowTime
        );
        
        $uain = $this->forms_model->get_row($dept_code, $form_table, $form_id)?$this->forms_model->get_row($dept_code, $form_table, $form_id)->uain:"";
        $upData = array(
            "uain" => $uain,
            "process_date" => $nowTime,
            "processed_by" => $uid,
            "process" => $process,
            "current_user" => $uid,
            "other_status" => 0
        );
        if($this->applicationsup_model->check_row($uain, $dept_code)) {
            $processId = $this->applicationsup_model->check_row($uain, $dept_code)->id;
            $this->applicationsup_model->edit_row($processId, $upData, $dept_code);
        } else {
            $this->applicationsup_model->add_row($upData, $dept_code);
        }//End of if else
        
        $this->formprocess_model->edit_row($editData, $dept_code, $form_table, $form_id);
        $this->formprocess_model->add_row($addData, $dept_code, $form_table);
                                 
        $this->sendemail($form_table, $form_id, "Verified", $user_designation);
        echo "Application has been successfully approved on ".$dov;
    }//End of verify()
    
    function reject(){
        $process = "R";
        $uid = $this->session->staff_id;
        $nowTime=date("Y-m-d H:i:s");
        $dept_code = $this->input->post("dept");
        $form_table = $this->input->post("tbl");
        $form_id = $this->input->post("fid");
        $remarks = $this->input->post("rem");
        $reasons = $this->input->post("reasons");
        $this->load->model("staffs/forms_model");        
        $this->load->model("staffs/formprocess_model");          
        if($this->deptusers_model->get_row($uid, $dept_code)) {
            $deptUser = $this->deptusers_model->get_row($uid, $dept_code);
            $user_id = $deptUser->user_id;
            $forward_user_name = $deptUser->user_name;
            $utype = $deptUser->utype;
            $user_designation = $this->utypes_model->get_row($utype, $dept_code)->utype_name;
        } else {
            $user_id = $forward_user_name = $user_designation = "Not found!";
        }//End of if else    
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $uid,
            "file_path" => "",
            "remark" => $remarks
        );
        
        $uain = $this->forms_model->get_row($dept_code, $form_table, $form_id)?$this->forms_model->get_row($dept_code, $form_table, $form_id)->uain:"";
        $upData = array(
            "uain" => $uain,
            "process_date" => $nowTime,
            "processed_by" => $uid,
            "process" => $process,
            "current_user" => $uid,
            "other_status" => 0
        );
        if($this->applicationsup_model->check_row($uain, $dept_code)) {
            $processId = $this->applicationsup_model->check_row($uain, $dept_code)->id;
            $this->applicationsup_model->edit_row($processId, $upData, $dept_code);
        } else {
            $this->applicationsup_model->add_row($upData, $dept_code);
        }//End of if else
        
        $this->forms_model->edit_row(array("active"=>0), $dept_code, $form_table, $form_id);
        $this->formprocess_model->add_row($addData, $dept_code, $form_table);
        $this->formprocess_model->edit_row(array("status"=>0), $dept_code, $form_table, $form_id);
                                 
        $this->sendemail($form_table, $form_id, "Rejected", $user_designation);
    }//End of reject()
    
    function issuecer(){
        $process = "C";
        $uid = $this->session->staff_id;
        $nowTime=date("Y-m-d H:i:s");
        $dept_code = $this->input->post("dept");
        $form_table = $this->input->post("tbl");
        $form_id = $this->input->post("fid");
        $file_auth_num = $this->input->post("file_auth_num");
        $this->load->model("staffs/forms_model");  
        $this->load->model("staffs/formprocess_model");
        if($this->deptusers_model->get_row($uid, $dept_code)) {
            $deptUser = $this->deptusers_model->get_row($uid, $dept_code);
            $user_id = $deptUser->user_id;
            $forward_user_name = $deptUser->user_name;
            $utype = $deptUser->utype;
            $user_designation = $this->utypes_model->get_row($utype, $dept_code)->utype_name;
        } else {
            $user_id = $forward_user_name = $user_designation = "Not found!";
        }//End of if else
        
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $uid
        );//End of addData
        
        $editData = array(
            "status" => 0,
            "p_date" => $nowTime
        );//End of editData
        
        $uain = $this->forms_model->get_row($dept_code, $form_table, $form_id)?$this->forms_model->get_row($dept_code, $form_table, $form_id)->uain:"";
        $upData = array(
            "uain" => $uain,
            "process_date" => $nowTime,
            "processed_by" => $uid,
            "process" => $process,
            "current_user" => $uid,
            "other_status" => 0
        );//End of upData
        if($this->applicationsup_model->check_row($uain, $dept_code)) {
            $processId = $this->applicationsup_model->check_row($uain, $dept_code)->id;
            $this->applicationsup_model->edit_row($processId, $upData, $dept_code);
        } else {
            $this->applicationsup_model->add_row($upData, $dept_code);
        }//End of if else
        
        $this->formprocess_model->add_row($addData, $dept_code, $form_table);
        $this->formprocess_model->edit_row($editData, $dept_code, $form_table, $form_id);
                                 
        $this->sendemail($form_table, $form_id, "Certificate/License/NOC Uploaded", $user_designation);
    }//End of issuecer()
    
    function issuenoc(){
        $process = "I";
        $uid = $this->session->staff_id;
        $nowTime=date("Y-m-d H:i:s");
        $dept_code = $this->input->post("dept");
        $form_table = $this->input->post("tbl");
        $form_id = $this->input->post("fid");
        $this->load->model("staffs/forms_model");  
        $this->load->model("staffs/formprocess_model");
        if($this->deptusers_model->get_row($uid, $dept_code)) {
            $deptUser = $this->deptusers_model->get_row($uid, $dept_code);
            $user_id = $deptUser->user_id;
            $forward_user_name = $deptUser->user_name;
            $utype = $deptUser->utype;
            $user_designation = $this->utypes_model->get_row($utype, $dept_code)->utype_name;
        } else {
            $user_id = $forward_user_name = $user_designation = "Not found!";
        }//End of if else
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $uid
        );
        $editData = array("status" => 0, "p_date" => $nowTime);
        
        $uain = $this->forms_model->get_row($dept_code, $form_table, $form_id)?$this->forms_model->get_row($dept_code, $form_table, $form_id)->uain:"";
        $upData = array(
            "uain" => $uain,
            "process_date" => $nowTime,
            "processed_by" => $uid,
            "process" => $process,
            "current_user" => $uid,
            "other_status" => 0
        );
        if($this->applicationsup_model->check_row($uain, $dept_code)) {
            $processId = $this->applicationsup_model->check_row($uain, $dept_code)->id;
            $this->applicationsup_model->edit_row($processId, $upData, $dept_code);
        } else {
            $this->applicationsup_model->add_row($upData, $dept_code);
        }//End of if else
        
        $this->formprocess_model->add_row($addData, $dept_code, $form_table);
        $this->formprocess_model->edit_row($editData, $dept_code, $form_table, $form_id);
        $this->sendemail($form_table, $form_id, "Certificate/License/NOC Issued", $user_designation);
    }//End of issuenoc()
    
    function reports(){
        $process = "UVR";
        $uid = $this->session->staff_id;
        $nowTime=date("Y-m-d H:i:s");
        $todatDate = date("Y-m-d");
        $dept_code = $this->input->post("dept");
        $form_table = $this->input->post("tbl");
        $form_id = $this->input->post("fid");
        $remarks = $this->input->post("rem");
        $this->load->helper("fileupload");
        $files = $this->input->post("reportfile");
        $uploades =moveFile(1,$files);
        $reportfile = $uploades["reportfile"];
        $this->load->model("staffs/forms_model");  
        $this->load->model("staffs/formprocess_model");
        if($this->deptusers_model->get_row($uid, $dept_code)) {
            $deptUser = $this->deptusers_model->get_row($uid, $dept_code);
            $user_id = $deptUser->user_id;
            $forward_user_name = $deptUser->user_name;
            $utype = $deptUser->utype;
            $user_designation = $this->utypes_model->get_row($utype, $dept_code)->utype_name;
        } else {
            $user_id = $forward_user_name = $user_designation = "Not found!";
        }//End of if else
        $addData = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => $process,
            "user_id" => $uid,
            "doi" => $todatDate,
            "file_path" => $reportfile,
            "remark" => $remarks
        );//End of addData array()
        
        $editData = array(
            "status" => 0,
            "p_date" => $nowTime
        );//End of editData array()
        
        $uain = $this->forms_model->get_row($dept_code, $form_table, $form_id)?$this->forms_model->get_row($dept_code, $form_table, $form_id)->uain:"";
        $upData = array(
            "uain" => $uain,
            "process_date" => $nowTime,
            "processed_by" => $uid,
            "process" => $process,
            "current_user" => $uid,
            "other_status" => 0
        );
        if($this->applicationsup_model->check_row($uain, $dept_code)) {
            $processId = $this->applicationsup_model->check_row($uain, $dept_code)->id;
            $this->applicationsup_model->edit_row($processId, $upData, $dept_code);
        } else {
            $this->applicationsup_model->add_row($upData, $dept_code);
        }//End of if else
        
        $this->formprocess_model->add_row($addData, $dept_code, $form_table);
        $this->formprocess_model->edit_row($editData, $dept_code, $form_table, $form_id);
        $this->sendemail($form_table, $form_id, "Recommendation Letter Uploaded", $user_designation);
    }//End of reports()
    
    function sendemail($form_table, $form_id, $process, $user_designation) {
        $this->load->model("staffs/cafs_model");
        $dept_code = $this->session->staff_dept;
        $frmRow = $this->forms_model->get_row($dept_code, $form_table, $form_id);
        $unit_id = $frmRow->user_id;
        $uain = $frmRow->uain;
        $cafRow = $this->cafs_model->get_row($unit_id);
        $entp = $cafRow->Name;
        $ubin = $cafRow->ubin;
        $email = $cafRow->b_email;
        $form_name = "Application";        
        $dept_name = $this->subdepartments_model->get_deptbycode($dept_code)->name;
        
        $sub="Application ".$process." : ".$ubin;
        $msg="Dear ".$entp.",<br/><p>Your ".$form_name." with Unique Application Identification Number : <b>".$uain."</b> has been forwarded by <b>".$user_designation." , ".$dept_name."</b> for further processing. This is for your information only and does not require any action at your end.<br/>You may check the status and/or track your application form under ‘My Applications’, by logging onto &nbsp;<a href='https://easeofdoingbusinessinassam.in' target='_blank'>easeofdoingbusinessinassam.in </a>&nbsp;with your registered username and password.</p>";
        //sendmail($email, $sub, $msg);
        return $email." : ".$sub." : ".$msg;
    }//End of sendemail()    
}//End of Applicationprocess