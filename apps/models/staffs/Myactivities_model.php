<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Myactivities_model extends CI_Model {        
    function get_activities($dept_code) {
        $results = array();
        $this->load->model("staffs/applicationreports_model");
        $staff_id = $this->session->staff_id;
        $dept_db = $this->load->database($dept_code, TRUE);
        foreach($this->applicationreports_model->get_formtables($dept_code) as $frmtbl) {
            $processtbl = $frmtbl."_process"; //echo $processtbl."<br />";
            $qry = "SELECT $frmtbl.form_id, $frmtbl.uain, $processtbl.process_type, $processtbl.p_date , $processtbl.file_path, $processtbl.remark FROM $frmtbl LEFT JOIN $processtbl ON $processtbl.form_id=$frmtbl.form_id ";
            foreach ($dept_db->query($qry)->result() as $rows) {
                $form_id = $rows->form_id; //echo " : ".$form_id."<br />";
                $uain = $rows->uain;
                $process_type = $rows->process_type;
                $p_date = $rows->p_date;
                $file_path = $rows->file_path;
                $remark = $rows->remark;
                $res = array(
                    "frmtbl" => $frmtbl,
                    "form_id" => $form_id,
                    "process_type" => $process_type,
                    "uain" => $uain,
                    "p_date" => $p_date,
                    "file_path" => $file_path,
                    "remark" => $remark,
                );
                array_push($results, $res);
            }//End of foreach loop
        }//End of foreach loop
        return count($results)?$results:NULL;
    }//End of get_activities()
}//End of Myactivities_model