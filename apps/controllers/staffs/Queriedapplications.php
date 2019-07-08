<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Queriedapplications extends Eodbs {
    function index() {
        $this->load->helper("encode");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/queriedapplications_model");
        $this->load->view("staffs/queriedapplications_view");
    }//End of index()
    
    function queryapp(){
        $this->load->model("staffs/forms_model");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/queriedapplications_model"); 
        $this->load->helper("encode");        
        $staff_id = $this->session->staff_id;
        $dept_code = $this->session->staff_dept;
        $nowTime=date("Y-m-d H:i:s");
        $process = "Q";
        
        $uain = $this->input->post("uain");
        $form_id = uainexplode($uain, "form_id");
        $form_no = uainexplode($uain, "form_no");
        if($form_no > 0) {
            $form_table = $dept_code."_form".$form_no;
            $frmRow = $this->forms_model->get_uainrow($dept_code, $form_table, $uain);
            if($frmRow) {
                $swr_id = $frmRow->user_id;                
                $subject = $this->input->post("qsub");
                $qmsg = $this->input->post("qmsg");
                $qfamnt = $this->input->post("qfamnt");
                $qdocs = $this->input->post("query_docs");
                $query_docs = ($qdocs)?json_encode($qdocs):"";
                
                $processData = array(
                    "process_date" => $nowTime,
                    "processed_by" => $staff_id,
                    "current_userid" => $staff_id,
                    "process" => $process
                );
                $this->applicationsup_model->edit_uainrow($processData, $dept_code, $uain);

                $queryData = array(
                    "unit_id" => $swr_id,
                    "uain" => $uain,
                    "query_from" => $staff_id,
                    "subject" => $subject,
                    "msg" => $qmsg,
                    "document" => $query_docs,
                    "q_date" => $nowTime
                );
                $this->queriedapplications_model->add_row($queryData);
            } else {
                die("UAIN does not exist!");
            }
        } else {
            die("Form no. does not exist");
        }//End of if else
    }//End of queryapp()
}//End of Queriedapplications