<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
	class GetApproval_model extends CI_Model{
		function getApprovals(){
			$cms=$this->load->database("cms",true);
    		if($this->input->post("dept")!=="" && $this->input->post("sub_dept")!=="" && $this->input->post("cat")!=="") {
				$dept = $this->input->post("dept");
				$sub_dept = $this->input->post("sub_dept");
				$cat = $this->input->post("cat");
				$qrystr="SELECT * FROM list_of_approvals WHERE dept_code='$dept' AND sub_dept='$sub_dept' AND application_type='$cat' AND status='1' ORDER BY id DESC";
				} elseif($this->input->post("dept") !=="" && $this->input->post("sub_dept") !=="") {
				$dept = $this->input->post("dept");
				$sub_dept = $this->input->post("sub_dept");
				$qrystr="SELECT * FROM list_of_approvals WHERE dept_code='$dept' AND sub_dept='$sub_dept' AND status='1' ORDER BY id DESC";
				} elseif($this->input->post("dept") !=="" && $this->input->post("cat") !=="") {
				$dept = $this->input->post("dept");
				$cat = $this->input->post("cat");
				$qrystr="SELECT * FROM list_of_approvals WHERE dept_code='$dept' AND application_type='$cat' AND status='1' ORDER BY id DESC";
				} elseif($this->input->post("cat") !=="") {
				$cat = $this->input->post("cat");
				$qrystr="SELECT * FROM list_of_approvals WHERE application_type='$cat' AND status='1' ORDER BY id DESC";
				} elseif($this->input->post("dept") !=="") {
				$dept = $this->input->post("dept");
				$qrystr="SELECT * FROM list_of_approvals WHERE dept_code='$dept' AND status='1' ORDER BY id DESC";
			} else $qrystr="SELECT * FROM list_of_approvals WHERE status='1' ORDER BY id DESC";
			//$qrystrlimit = $qrystr." LIMIT $start_from, $per_page";
			$qrystrlimit = $qrystr."";
			//echo $qrystrlimit;die();
			$qry=$cms->query($qrystr);
			$qrylimit=$cms->query($qrystrlimit);
			$tot_rows = $qry->num_rows;
			$paginationQuery = $cms->query($qrystr);
			$cms->close();
			return $qrylimit;
			//echo $qrystr." = ".$tot_rows."<br />".$qrystrlimit." = ".$total_pages;
		}
		function get_deptbycode($code=NULL,$attributeType=NULL){
			$this->load->database();
			$this->db->select("*");
			$this->db->from("SubDepartment"); 
			if($attributeType=="id")
			{
				$this->db->where("id", $code ); 
				
			}
			else
			{
			    $this->db->where("dept_code", $code ); 
			}
			$query = $this->db->get(); 
			
			if($query->num_rows() == 0) {
				$this->db->close();
				return FALSE;
				} else {
				$this->db->close();
				return $query->row();
			}//End of if else        
		}//End of get_deptname()
	}		