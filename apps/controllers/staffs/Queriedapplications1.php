<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Queriedapplications extends Eodbs {
    function index() {
        $this->load->helper("encode");
        $this->load->model("staffs/applicationreports_model");
        $this->load->view("staffs/queriedapplications_view");
    }//End of index()
    
    function queryapp(){
        $this->load->helper("encode");
        $uid = $this->session->staff_id;
        $nowTime=date("Y-m-d H:i:s");
        $dept_code = $this->session->staff_dept;
        $decoded_id = decodeme($this->input->post("ids"));
        if (strlen($decoded_id) > 1) {
            $pcs = explode("|||", $decoded_id);
            $form_table = $pcs[0];
            $form_id = $pcs[1];
            $this->load->model("eodbfunctions/getuain_model");
            if($this->getuain_model->uain($dept_code, $form_table, $form_id)) {
                $uainRow = $this->getuain_model->uain($dept_code, $form_table, $form_id);
                $uain = $uainRow->uain;
                $user_id = $uainRow->user_id;
            } else {
                $uainRow = "";
            }//End of if else
            $qsub = $this->input->post("qsub");
            if($qsub=="query_general"){
		$subject="General Query";
            } elseif($qsub=="query_fees"){
		$subject="Fees and Payment Related";
            } elseif($qsub=="query_document"){
		$subject="Documents Related";
            } else {
		$subject="Undefined query!";
            }//End of if else
            $qmsg = $this->input->post("qmsg");
            $qfamnt = $this->input->post("qfamnt");
            $qdocs = $this->input->post("query_docs");
            $query_docs = ($qdocs)?json_encode($qdocs):"";
            $this->load->model("staffs/formprocess_model"); 
            $this->load->model("staffs/queriedapplications_model");   
            $processData = array(
                "form_id" => $form_id,
                "p_date" => $nowTime,
                "process_type" => "Q",
                "user_id" => $uid,
                "remark" => $subject."//".$qmsg
            );
            
            $queryData = array(
                "swr_id" => $user_id,
                "uain" => $uain,
                "query_from" => $uid,
                "subject" => $subject,
                "msg" => $qmsg,
                "document" => $query_docs,
                "q_date" => $nowTime
            );
            
            $this->formprocess_model->add_row($processData, $dept_code, $form_table);
            $this->formprocess_model->edit_row(array("status"=>1), $dept_code, $form_table, $form_id);
            $this->queriedapplications_model->add_row($queryData);
        }//End of if statement
    }//End of queryapp()
}//End of Queriedapplications