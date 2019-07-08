<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Applicationreports_model extends CI_Model {
    function get_formtables($dept_code) {     
        $tbls = array();
        $this->load->model("staffs/subdepartments_model");
        $form_nos = $this->subdepartments_model->get_deptbycode($dept_code)->form_tables;
        $nos = explode(",", $form_nos);
        for ($no = 0; $no < count($nos); $no++) {
            array_push($tbls, $dept_code . "_form" . $nos[$no]);
        }//End of for
        return count($tbls)?$tbls:FALSE;
    }//End of get_tables()
    function get_formnos($dept_id) {
        $this->load->model("eodbfunctions/GetSubDepartment_model");
        $form_nos = $this->GetSubDepartment_model->get_deptbyid($dept_id)->form_tables;
        return $form_nos;
    }//End of get_tables()
    function get_formprocesstables($dept_code) {
        $tbls = array();
        $this->load->model("staffs/subdepartments_model");
        $form_nos = $this->subdepartments_model->get_deptbycode($dept_code)->form_tables;
        $nos = explode(",", $form_nos);
        for ($no = 0; $no < count($nos); $no++) {
            array_push($tbls, $dept_code . "_form" . $nos[$no]."_process");
        }//End of for
        return count($tbls)?$tbls:FALSE;
    }//End of get_formprocesstables()
    
    function get_allApplications($dept_code) {
        $results = array();
        $dept_db = $this->load->database($dept_code, TRUE);
        foreach($this->get_formtables($dept_code) as $frmtbl) {
            $qry = "SELECT form_id, uain, is_viewed, received_date FROM $frmtbl";
            foreach ($dept_db->query($qry)->result() as $rows) {
                $res = array(
                    "frmtbl" => $frmtbl,
                    "form_id" => $rows->form_id,
                    "uain" => $rows->uain,
                    "received_date" => $rows->received_date,
                );
                array_push($results, $res);
            }//End of foreach loop
        }//End of foreach loop
        $dept_db->close();
        return count($results)?$results:FALSE;
    }//End of get_allApplications()
    function get_myApplications($dept_code) {
       
        $staff_id = $this->session->staff_id; 
        $dept_id = $this->session->staff_dept_id;  
        $results = array();
        $applications_array=Array();
        $form_tables = $this->get_formnos($dept_id);
        $form_tables_array = explode(",",$form_tables);
   
//,(select $applicant_zone from eodbci_dicc.address where id='b.address') as applicant_zone
        
        $this->load->helper('get_uain_details');
        $dept_db = $this->load->database($dept_code, TRUE);
        $this->load->database();
        $query = "select uain,process as current_status,other_status as prev_status,unit_id,current_userid as process_user_id,unit_name,process_date,unit_name from applications_up where process in ('U','RD','RC','A','F','QA') AND current_userid='$staff_id'";
        $applications = $dept_db->query($query);
        $dept_db->close();
        $i=0;
        foreach ($applications->result() as $rows) {
            
            $uain=$rows->uain;
           // if($uain == "LEDF/F1/CH/000001/08/2018") echo $uain;
            if($uain=="") continue;
            $uain_parts = explode("/", $uain);
            $form_id = intval($uain_parts[3]);
            $form=get_uainForm($uain);	
            
            if(in_array($form,$form_tables_array)){
          
                $prev_status=$rows->prev_status;
                $current_status=$rows->current_status;
                $unit_id=$rows->unit_id;
                $process_user_id=$rows->process_user_id;
                $process_date=$rows->process_date;

                $current_time = date("Y-m-d H:i:s");	
                //echo $uain;
                //$ubin_rows=$admin_fetch_functions->getUBINdetails($swr_id);	
                $unit_name=$rows->unit_name;
                $passValue=$form_id.'|||'.$form.'|||'.$unit_id.'|||'.$uain;	
                $this->load->model("eodbfunctions/GetApprovalusingId_model");
                $form_name_array = $this->GetApprovalusingId_model->get_formName($dept_id,$form);
                $form_name=$form_name_array["form_name"];	
                //$working_days=$adminFunctions->get_workingDays($received_date,$current_time,$form_id,$form);
                $working_days=1;

                $applications_array[$i]["uain"]=$uain;
                $applications_array[$i]["process_date"]=$process_date;
                $applications_array[$i]["form_name"]=$form_name;
                $applications_array[$i]["unit_name"]=$unit_name;
                $applications_array[$i]["working_days"]=$working_days;
                $applications_array[$i]["passValue"]=$passValue;
                $applications_array[$i]["current_status"]=$current_status;
                $applications_array[$i]["prev_status"]=$prev_status;
                $applications_array[$i]["unit_id"]=$unit_id;

                $i++;
                	
            }
        }//End of foreach loop
        
        if($i>0){
                $uain_array=Array();
                $process_date_array=Array();
                $form_name_array=Array();
                $unit_name_array=Array();
                $working_days_array=Array();
                $passValue_array=Array();
                $current_status_array=Array();
                $prev_status_array=Array();
                $unit_id_array=Array();
                foreach($applications_array as $c=>$key) {
                        $uain_array[] = $key['uain'];
                        $process_date_array[] = $key['process_date'];
                        $form_name_array[] = $key['form_name'];
                        $unit_name_array[] = $key['unit_name'];
                        $working_days_array[] = $key['working_days']; 
                        $passValue_array[] = $key['passValue']; 
                        $current_status_array[] = $key['current_status']; 
                        $prev_status_array[] = $key['prev_status']; 
                        $unit_id_array[] = $key['unit_id']; 
                } 
                array_multisort($process_date_array,SORT_ASC,SORT_STRING,$applications_array);  
                $results = $applications_array;
        }
        
        return count($results)?$results:FALSE;
    }//End of get_allApplications()
    function get_underprocessedApplications($dept_code) {
        $results = array();
        $dept_db = $this->load->database($dept_code, TRUE);
        foreach($this->get_formtables($dept_code) as $frmtbl) {
            $processtbl = $frmtbl."_process";
            $qry = "SELECT $frmtbl.form_id, $frmtbl.uain, $processtbl.user_id, $processtbl.p_date FROM $frmtbl LEFT JOIN $processtbl ON $processtbl.form_id=$frmtbl.form_id WHERE $processtbl.process_type='U' AND $frmtbl.save_mode='C' AND $frmtbl.active='1' AND $frmtbl.received_date is NOT NULL";
            foreach ($dept_db->query($qry)->result() as $rows) {
                $form_id = $rows->form_id;
                $uain = $rows->uain;
                $user_id = $rows->user_id;
                $p_date = $rows->p_date;
                $res = array(
                    "frmtbl" => $frmtbl,
                    "form_id" => $form_id,
                    "uain" => $uain,
                    "p_date" => $p_date,
                );
                array_push($results, $res);
            }//End of foreach loop
        }//End of foreach loop
        return count($results)?$results:NULL;
    }//End of get_underprocessedApplications()    
    
    function get_queriedApplications($dept_code) {
        $results = array();
        $dept_db = $this->load->database($dept_code, TRUE);
        foreach($this->get_formtables($dept_code) as $frmtbl) {
            $processtbl = $frmtbl."_process";
            $qry = "SELECT $frmtbl.form_id, $frmtbl.uain, $processtbl.user_id, $processtbl.p_date, $processtbl.remark FROM $frmtbl LEFT JOIN $processtbl ON $processtbl.form_id=$frmtbl.form_id WHERE $processtbl.process_type='Q' AND $processtbl.status='1' AND $frmtbl.save_mode='C' AND $frmtbl.active='1'";
            foreach ($dept_db->query($qry)->result() as $rows) {
                $form_id = $rows->form_id;
                $uain = $rows->uain;
                $user_id = $rows->user_id;
                $p_date = $rows->p_date;
                $remark = $rows->remark;
                $res = array(
                    "frmtbl" => $frmtbl,
                    "form_id" => $form_id,
                    "uain" => $uain,
                    "p_date" => $p_date,
                    "remark" => $remark,
                );
                array_push($results, $res);
            }//End of foreach loop
        }//End of foreach loop
        return count($results)?$results:NULL;
    }//End of get_queriedApplications()
    
    function get_approvedApplications($dept_code) {
        $staff_id = $this->session->staff_id; 
        $dept_id = $this->session->staff_dept_id;  
        $office_id = $this->session->office_id;  
        $utype = $this->session->utype;
        $results = array();
        $applications_array=Array();
        $form_tables = $this->get_formnos($dept_id);
        $form_tables_array = explode(",",$form_tables);
        $this->load->model("staffs/Offices_model");
        $office_details = $this->Offices_model->get_row($office_id,$dept_code);
        $area_rights = $office_details->jurisdiction;
        
        switch($dept_code){
                case "gmc": $applicant_zone = "b.b_block";
                break;
                case "pincode": $applicant_zone = "b.b_pincode";
                break;
                case "fcs": $applicant_zone = "b.subdivision";
                break;
                default : $applicant_zone = "b.b_dist";
                break;
        }

        $this->load->helper('get_uain_details');
        $this->load->database();
        $applications = $this->db->query("select a.uain,a.current_status,a.swr_id,a.process_user_id,a.process_date,$applicant_zone as applicant_zone,b.Name from applications_ir as a LEFT JOIN singe_window_registration as b ON b.id=a.swr_id where a.dept_id='$dept_id' and a.current_status='I' and a.process_user_id='$staff_id'");
        $this->db->close();
        $i=0;
        foreach ($applications->result() as $rows) {
            
            $uain=$rows->uain;
            $applicant_zone=$rows->applicant_zone;
            $uain_parts = explode("/", $uain);
            $form_id=intval($uain_parts[3]);
            $form=get_uainForm($uain);	
            
            if(in_array($form,$form_tables_array)){
                $prev_status=$rows->prev_status;
                $current_status=$rows->current_status;
                $swr_id=$rows->swr_id;
                $process_user_id=$rows->process_user_id;
                $process_date=$rows->process_date;
                $current_time=date("Y-m-d H:i:s");                    
                if($process_user_id == $staff_id || (in_array($applicant_zone, $area_rights) && $utype==2 && $process_user_id=="")){
                    //$ubin_rows=$admin_fetch_functions->getUBINdetails($swr_id);	
                    $unit_name=$rows->Name;
                    $passValue=base64_encode($form_id.'&'.$form);	
                    $this->load->model("eodbfunctions/GetApprovalusingId_model");
                    $form_name_array = $this->GetApprovalusingId_model->get_formName($dept_id,$form);
                    $form_name=$form_name_array["form_name"];	
                    //$working_days=$adminFunctions->get_workingDays($received_date,$current_time,$form_id,$form);
                    $working_days=1;

                    $applications_array[$i]["uain"]=$uain;
                    $applications_array[$i]["process_date"]=$process_date;
                    $applications_array[$i]["form_name"]=$form_name;
                    $applications_array[$i]["unit_name"]=$unit_name;
                    $applications_array[$i]["working_days"]=$working_days;
                    $applications_array[$i]["passValue"]=$passValue;
                    //$applications_array[$i]["is_viewed"]=$is_viewed;
                    $applications_array[$i]["swr_id"]=$swr_id;

                    $i++;
                }
                	
            }
        }//End of foreach loop
        
        if($i>0){
            $uain_array=Array();
            $process_date_array=Array();
            $form_name_array=Array();
            $unit_name_array=Array();
            $working_days_array=Array();
            $passValue_array=Array();
            //$is_viewed_array=Array();
            $swr_id_array=Array();
            foreach($applications_array as $c=>$key) {
             $uain_array[] = $key['uain'];
             $process_date_array[] = $key['process_date'];
             $form_name_array[] = $key['form_name'];
             $unit_name_array[] = $key['unit_name'];
             $working_days_array[] = $key['working_days']; 
             $passValue_array[] = $key['passValue']; 
             //$is_viewed_array[] = $key['is_viewed']; 
             $swr_id_array[] = $key['swr_id']; 
            } 

            array_multisort($process_date_array,SORT_ASC,SORT_STRING,$applications_array);  
            $results = $applications_array;
        }
        
        return count($results)?$results:FALSE;
    }//End of get_approvedApplications()
    
    function get_rejectedApplications($dept_code) {
        $results = array();
        $dept_db = $this->load->database($dept_code, TRUE);
        foreach($this->get_formtables($dept_code) as $frmtbl) {
            $processtbl = $frmtbl."_process";
            $qry = "SELECT $frmtbl.form_id, $frmtbl.uain, $processtbl.user_id, $processtbl.p_date FROM $frmtbl LEFT JOIN $processtbl ON $processtbl.form_id=$frmtbl.form_id WHERE $processtbl.process_type='R' AND $frmtbl.save_mode='C' AND $frmtbl.active='0' AND $frmtbl.received_date is NOT NULL";
            foreach ($dept_db->query($qry)->result() as $rows) {
                $form_id = $rows->form_id;
                $uain = $rows->uain;
                $user_id = $rows->user_id;
                $p_date = $rows->p_date;
                $res = array(
                    "frmtbl" => $frmtbl,
                    "form_id" => $form_id,
                    "uain" => $uain,
                    "p_date" => $p_date,
                );
                array_push($results, $res);
            }//End of foreach loop
        }//End of foreach loop
        return count($results)?$results:NULL;
    }//End of get_rejectedApplications()
    
    
    function get_courierApplications($dept_code) {
        $results = array();
        $dept_db = $this->load->database($dept_code, TRUE);
        foreach($this->get_formtables($dept_code) as $frmtbl) {
            //$processtbl = $frmtbl."_process";
            $qry = "SELECT form_id, uain, courier_details, user_id as unit_id FROM $frmtbl WHERE courier_details IS NOT NULL AND save_mode='C' AND active='1' AND received_date is NULL"; //die($qry);
            foreach ($dept_db->query($qry)->result() as $rows) {
                $form_id = $rows->form_id;
                $uain = $rows->uain;
                $unit_id = $rows->unit_id;
                $courier_details = $rows->courier_details;
                $res = array(
                    "frmtbl" => $frmtbl,
                    "form_id" => $form_id,
                    "unit_id" => $unit_id,
                    "uain" => $uain,
                    "courier_details" => $courier_details
                );
                array_push($results, $res);
            }//End of foreach loop
        }//End of foreach loop
        return count($results)?$results:NULL;
    }//End of get_courierApplications()
    
    function get_uploadverifyApplications($dept_code) {
        $todayDate=date("Y-m-d");
        $results = array();
        $dept_db = $this->load->database($dept_code, TRUE);
        foreach($this->get_formtables($dept_code) as $frmtbl) {
            $processtbl = $frmtbl."_process";
            $qry = "SELECT $frmtbl.form_id, $frmtbl.user_id, $frmtbl.uain, $frmtbl.received_date, $processtbl.p_date FROM $frmtbl LEFT JOIN $processtbl ON $processtbl.form_id=$frmtbl.form_id WHERE $processtbl.process_type='V' AND $processtbl.status='1' AND $processtbl.doi <= '$todayDate'";
            foreach ($dept_db->query($qry)->result() as $rows) {
                $form_id = $rows->form_id;
                $user_id = $rows->user_id;
                $uain = $rows->uain;
                $user_id = $rows->user_id;
                $received_date = $rows->received_date;
                $p_date = $rows->p_date;
                $res = array(
                    "frmtbl" => $frmtbl,
                    "form_id" => $form_id,
                    "user_id" => $user_id,
                    "uain" => $uain,
                    "received_date" => $received_date,
                    "p_date" => $p_date
                );
                array_push($results, $res);
            }//End of foreach loop
        }//End of foreach loop
        return count($results)?$results:NULL;
    }//End of get_uploadverifyApplications()
    
    function get_distApplications($dept_code) {
        $results = array();
        $dept_db = $this->load->database($dept_code, TRUE);
        foreach($this->get_formtables($dept_code) as $frmtbl) {
            $qry = "SELECT user_id, form_id, uain, is_viewed, received_date FROM $frmtbl";
            foreach ($dept_db->query($qry)->result() as $rows) {
                $sqrId = $rows->user_id;                
                $this->load->database();
                $unitQry = $this->db->query("SELECT b_dist FROM singe_window_registration WHERE id='$sqrId'");
                if($unitQry->num_rows() == 0) {
                    $dist = "";
                } else {
                    $dist = $unitQry->row()->b_dist;
                }
                $this->db->close();                
                $formId = $rows->form_id;
                $uain = $rows->uain;
                $receivedDate = $rows->received_date;
                $res = array(
                    "frmtbl" => $frmtbl,
                    "form_id" => $formId,
                    "uain" => $uain,
                    "dist" => $dist,
                    "received_date" => $receivedDate,
                );
                array_push($results, $res);
            }//End of foreach loop
        }//End of foreach loop
        $dept_db->close();
        return count($results)?$results:FALSE;
    }//End of get_distApplications()
    
    function get_sentonqueryApplications($dept_code) {
       
        $staff_id = $this->session->staff_id; 
        $dept_id = $this->session->staff_dept_id;  
        $office_id = $this->session->office_id;  
        $utype = $this->session->utype;  
        $results = array();
        $applications_array=Array();
        $form_tables = $this->get_formnos($dept_id);
        $form_tables_array = explode(",",$form_tables);
        $this->load->model("staffs/Offices_model");
        $office_details = $this->Offices_model->get_row($office_id,$dept_code);
        $area_rights_values = $office_details->jurisdiction;
        $area_rights = explode(",",$area_rights_values);
        switch($dept_code){
                case "gmc": $applicant_zone = "c.block";
                break;
                case "pincode": $applicant_zone = "c.pin";
                break;
                case "fcs": $applicant_zone = "c.revenue_circle";
                break;
                default : $applicant_zone = "c.dist";
                break;
        }
//,(select $applicant_zone from eodbci_dicc.address where id='b.address') as applicant_zone
        
        $this->load->helper('get_uain_details');
        //$dept_db = $this->load->database($dept_code, TRUE);
        $this->load->database();
        $query = "select a.uain,a.process as current_status,a.unit_id,a.current_userid as process_user_id,a.process_date,b.unit_name,$applicant_zone as applicant_zone from eodbci_".$dept_code.".applications_up as a LEFT JOIN eodbci_dicc.unit_master_record as b ON b.unit_id=a.unit_id LEFT JOIN eodbci_dicc.address as c ON b.address=c.id where a.process='QR' and a.current_userid='$staff_id'";
        
        
        
        $applications = $this->db->query($query);
        $this->db->close();
        $i=0;
        foreach ($applications->result() as $rows) {
            
            $uain=$rows->uain;            
            $applicant_zone=strtoupper($rows->applicant_zone);
            //echo $applicant_zone="";
            $uain_parts = explode("/", $uain);
            $form_id=intval($uain_parts[3]);
            $form=get_uainForm($uain);	
            
            if(in_array($form,$form_tables_array)){
            
                $prev_status=$rows->prev_status;
                $current_status=$rows->current_status;
                $unit_id=$rows->unit_id;
                $process_user_id=$rows->process_user_id;
                $process_date=$rows->process_date;

                $current_time=date("Y-m-d H:i:s");	

                if($process_user_id == $staff_id || (in_array($applicant_zone, $area_rights) && $utype==2 && $process_user_id=="")){      
                        //echo $uain;
                        //$ubin_rows=$admin_fetch_functions->getUBINdetails($swr_id);	
                        $unit_name=$rows->unit_name;
                        $passValue=$form_id.'|||'.$form.'|||'.$unit_id.'|||'.$uain;	
                        $this->load->model("eodbfunctions/GetApprovalusingId_model");
                        $form_name_array = $this->GetApprovalusingId_model->get_formName($dept_id,$form);
                        $form_name=$form_name_array["form_name"];	
                        //$working_days=$adminFunctions->get_workingDays($received_date,$current_time,$form_id,$form);
                        $working_days=1;

                        $applications_array[$i]["uain"]=$uain;
                        $applications_array[$i]["process_date"]=$process_date;
                        $applications_array[$i]["form_name"]=$form_name;
                        $applications_array[$i]["unit_name"]=$unit_name;
                        $applications_array[$i]["working_days"]=$working_days;
                        $applications_array[$i]["passValue"]=$passValue;
                        $applications_array[$i]["current_status"]=$current_status;
                        $applications_array[$i]["prev_status"]=$prev_status;
                        $applications_array[$i]["unit_id"]=$unit_id;

                        $i++;
                }	
            }
        }//End of foreach loop
        
        if($i>0){
                $uain_array=Array();
                $process_date_array=Array();
                $form_name_array=Array();
                $unit_name_array=Array();
                $working_days_array=Array();
                $passValue_array=Array();
                $current_status_array=Array();
                $prev_status_array=Array();
                $unit_id_array=Array();
                foreach($applications_array as $c=>$key) {
                        $uain_array[] = $key['uain'];
                        $process_date_array[] = $key['process_date'];
                        $form_name_array[] = $key['form_name'];
                        $unit_name_array[] = $key['unit_name'];
                        $working_days_array[] = $key['working_days']; 
                        $passValue_array[] = $key['passValue']; 
                        $current_status_array[] = $key['current_status']; 
                        $prev_status_array[] = $key['prev_status']; 
                        $unit_id_array[] = $key['unit_id']; 
                } 
                array_multisort($process_date_array,SORT_ASC,SORT_STRING,$applications_array);  
                $results = $applications_array;
        }
        
        return count($results)?$results:FALSE;
    }//End of get_allApplications()
}//End of Applicationreports_model