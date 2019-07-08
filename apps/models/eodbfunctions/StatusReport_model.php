<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
	class StatusReport_model extends CI_Model{
		
	    protected $ApplicationReceived;
		function __construct(){
		$this->ApplicationReceived=0;
		}
		
		function getApplicationReceived(){
			return $this->ApplicationReceived;
		}
		function getTotalCAF(){
			$this->load->database();
			$this->db->select("active");
			$this->db->from("singe_window_registration");
			$this->db->where("save_mode","C");
			$this->db->close();
			return $this->db->count_all_results();
		}//End of getTotalCAF()
		
		function getTotalUsersRegistered(){
			$this->load->database();
			$this->db->select("active");
			$this->db->from("users");
			$this->db->where("email_verify_link","verified");
			$this->db->close();
			return $this->db->count_all_results();
		}//End of getTotalUsersRegistered()
		
		function getAllOnlineDepartment(){
			$this->load->database();
			$this->db->select("dept_code,form_tables,name");
			$this->db->from("SubDepartment");
			$this->db->where("status",'1');
			$this->db->where("`form_tables` is not NULL");
			$query=$this->db->get();
		    //echo $query;die();
			$this->db->close();
			return $query->result_array();        
		}//End of getAllOnlineDepartment()
		
		
		public function get_record_data($dept_name, $tb_list)
		{
			$total          = 0;
			$total_underprocess = 0;
			$total_underquery = 0;
			$total_approved = 0;
			
			$total_rejected = 0;
			foreach ($tb_list as $k1 => $v1) {
			    //Table Names
				$table_name_n    = $dept_name . '_form' . $v1;
				$table_name      = $dept_name . '_form' . $v1 . '_process';
				
				//query no 1
				$this->load->database($dept_name);
				$this->db->select("form_id");
				$this->db->from($table_name_n);
				$this->db->where("save_mode","C");
				$this->db->where("`received_date` is not NULL");
				$record          = $this->db->count_all_results();	
				$total           = $total + $record;
				
				//query no 2
				$this->load->database($dept_name);
				$this->db->select("form_id");
				$this->db->from($table_name);
				$this->db->where("`process_type` = 'I' OR `process_type` = 'C'");
				$this->db->where("status",1);
				$record_approved=$this->db->count_all_results();
				$total_approved += $record_approved;
				//query no 3
				$this->load->database($dept_name);
				$this->db->select("`$table_name`.`form_id`");
				$this->db->from($table_name);
				$this->db->join($table_name_n,"`$table_name_n`.`form_id`=`$table_name`.`form_id`",'left');
				$this->db->where("$table_name.status","1");
				$this->db->where("$table_name.process_type","R");
				$this->db->where("$table_name_n.save_mode","C");
				$record_rejected=$this->db->count_all_results();			
				$total_rejected += $record_rejected;
				//query no 4
				$this->load->database($dept_name);
				$this->db->select("`$table_name`.`form_id`");
				$this->db->from($table_name_n);
				$this->db->join($table_name,"`$table_name_n`.`form_id`=`$table_name`.`form_id`",'left');
				$this->db->join("eodb_dicc.`queries`","`$table_name_n`.`uain`=`eodb_dicc`.`queries`.`uain`",'left');
				$this->db->where("$table_name.status","1");
				$this->db->where("$table_name.process_type","R");
				$this->db->where("$table_name.process_type","Q");				
				$this->db->where("`eodb_dicc`.`queries`.status","0");
				$record_underquery = $this->db->count_all_results();
				$total_underquery += $record_underquery;
				
				//query no 5
				$this->load->database($dept_name);
				$this->db->select("`$table_name`.`form_id`");
				$this->db->from($table_name);
				$this->db->join($table_name_n,"`$table_name`.`form_id`=`$table_name_n`.`form_id`",'left');
				$this->db->join("eodb_dicc.`queries`","`$table_name_n`.`uain`=`eodb_dicc`.`queries`.`uain`",'left');
				$this->db->where("$table_name.status","1");
				$this->db->where("$table_name.process_type!=","I");
				$this->db->where("$table_name.process_type!=","C");				
				$this->db->where("$table_name.process_type!=","A");				
				$this->db->where("$table_name.process_type!=","R");				
				$this->db->where("$table_name.process_type!=","Q");				
				$this->db->where("$table_name_n.save_mode","C");				
				$record_underprocess = $this->db->count_all_results();
				$total_underprocess += $record_underprocess;			
				
			}
			$this->db->close();
			$total_pending = $total - $total_approved - $total_rejected;
			$this->ApplicationReceived=$this->ApplicationReceived+ $total;
			return array(
            'total' => $total,
            'total_approved' => $total_approved,
            'total_underprocess' => $total_underprocess,
            'total_underquery' => $total_underquery,
            'total_rejected' => $total_rejected,
            'total_pending' => $total_pending
			);
		}
	}						