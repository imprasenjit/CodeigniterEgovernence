<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
    class GetApprovalusingId_model extends CI_Model{
        function getApproval($id=NULL){
            $cms=$this->load->database("cms",true);
            $qrysngle=$cms->query("SELECT * FROM list_of_approvals WHERE id='$id' LIMIT 1");    
            $cms->close();
            return $qrysngle;
        }//End of getApproval()
        
        function get_formName($dept_id,$form_no){
            $this->load->database();        
            $this->db->select("service_name,sample_name");
            $this->db->from("list_of_approvals"); 
            $this->db->where("form_no", $form_no);
            $this->db->where("sub_dept", $dept_id);
            $this->db->where("status", "1");
            $query = $this->db->get();
            if($query->num_rows() == 0) {
                $this->db->close();
                $service_name=""; 
                $sample_name=""; 
            } else {
                $this->db->close();
                $form_details_row=$query->row();
                $service_name=$form_details_row->service_name;
                $sample_name=$form_details_row->sample_name;
            }//End of if else
            $form_details_array=array('form_name'=>$service_name,'sample_name'=>$sample_name);
            return $form_details_array;
        }// End get_deptName
    }	