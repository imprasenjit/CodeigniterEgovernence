<?php
class Grievance_redressal extends DbConnect{
	
	function __construct() {	
    }
	
	public function executeQuery($dept,$query){
		$dept_conn = $this->dept_connect($dept);			
		$result=$dept_conn->query($query) OR die("Error in SQL QUERY : ".$dept_conn->error);
		$dept_conn->close();
		return $result;
	}
	public function executeQueryInsertID($dept,$query){
		$dept_conn = $this->dept_connect($dept);			
		$result=$dept_conn->query($query) OR die("Error in SQL QUERY : ".$dept_conn->error);
		$insert_id = $dept_conn->insert_id;
		$dept_conn->close();
		return $insert_id;
	}
	
	/*********************** GET GRIEVANCES ********************************/
	
	public function getResolvedGrievances($dept){

		$query=$this->executeQuery("dicc","select * from grievance_redressal_process where process_type='R' and status='1' ORDER BY p_date DESC");
		return $query;
	}
	public function getGrievances($dept){

		if($dept=="goa"){
			$query=$this->executeQuery("dicc","select * from grievance_redressal where active='1' ORDER BY g_date DESC");
		}else{
			$query=$this->executeQuery("dicc","select * from grievance_redressal where dept='$dept' and active='1' ORDER BY g_date DESC");
		}
		return $query;
	}
	public function getAppealedGrievances($dept){

		$query=$this->executeQuery("dicc","select * from grievance_redressal_appealed where active='1' ORDER BY sub_date ASC");
		return $query;
	}
	public function getUnderResolutionGrievances($dept){

		$query=$this->executeQuery("dicc","select * from grievance_redressal a,grievance_redressal_conv b,grievance_redressal_process c where a.dept='$dept' and b.g_id=a.g_id and c.process_type!='R' and c.g_id=a.g_id and b.status!='1' GROUP BY b.g_id");
		return $query;
	}
	public function getUnderResolutionGrievancesReplied($dept){
		$query=$this->executeQuery("dicc","select * from grievance_redressal a,grievance_redressal_conv b where a.dept='$dept' and b.g_id=a.g_id and b.status!='1' GROUP BY b.g_id");
		return $query;
	}
	public function getGOAUnderResolutionGrievancesReplied($dept){

		$query=$this->executeQuery("dicc","select * from grievance_redressal a,grievance_redressal_conv b where b.g_id=a.g_id and b.status!='1' GROUP BY b.g_id");
		return $query;
	}
	public function getGrievanceAccess($g_id,$sid,$dept){
		global $utype;
		$access=0;
		$query_process=$this->executeQuery("dicc","select * from grievance_redressal_process where g_id='$g_id' and status='1'");
		if($query_process->num_rows>0){
			$query_process_row=$query_process->fetch_object();
			$process_type=$query_process_row->process_type;
			$forward_to=$query_process_row->forward_to;
			$processed_by=$query_process_row->processed_by;
			$forward_dept=$query_process_row->forward_dept;

			if($process_type=="R"){
				$access=0;
			}else if($process_type=="F" && $forward_to==$sid && $dept==$forward_dept){
				$access=1;
			}else{
				$access=0;
			}
		}else if($dept=="goa"){
			$access=0;
		}else{
			if($utype==1){
				$access=0;
			}else{
				$query_ur_process=$this->executeQuery("dicc","select * from grievance_redressal_conv where g_id='$g_id'");
				if($query_ur_process->num_rows==0){
					$access=1;
				}
			}
		}
		return $access;		
	}
	public function adminGrievanceReply($g_id,$remarks,$process_type){
		global $mysqli,$dept,$sid;		
		$today=date("Y-m-d H:i:s");
		if($process_type=="U"){
			$query1=$this->executeQuery("dicc","update grievance_redressal_process set status='0' where g_id='$g_id'");
			$query=$this->executeQuery("dicc","insert into grievance_redressal_conv(g_id,question_by,dept,q_date,question) values('$g_id','$sid','$dept','$today','$remarks')");
		}else if($process_type=="R"){
			$query1=$this->executeQuery("dicc","update grievance_redressal_process set status='0' where g_id='$g_id'");
			$query2=$this->executeQuery("dicc","update grievance_redressal_appealed set status='0' where g_id='$g_id'");
			$query=$this->executeQuery("dicc","insert into grievance_redressal_process(g_id,processed_by,processed_dept,process_type,remark,p_date) values('$g_id','$sid','$dept','R','$remarks','$today')");
		}else{}			
		return $query;
	}
	public function adminGrievanceForward($g_id,$forward_to,$remarks,$forward_dept){
		global $mysqli,$sid,$dept;
		$today=date("Y-m-d H:i:s");
		$this->executeQuery("dicc","update grievance_redressal_process set status='0' where g_id='$g_id' ");
		$query=$this->executeQuery("dicc","insert into grievance_redressal_process(g_id,p_date,processed_by,processed_dept,process_type,forward_to,forward_dept,remark) values('$g_id','$today','$sid','$dept','F','$forward_to','$forward_dept','$remarks')");		
		return $query;
	}
	/*********************END END END ***************************************/
}
?>