<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
	class Notifications_model extends CI_Model{
		function getTotalNotifications(){
		    $this->load->database();
			return $this->db->count_all("post");
			$this->db->close();
		}
		function get_current_page_records($limit, $start) 
        {
			$this->db->limit($limit, $start);
			$query = $this->db->get("post");
            
			if ($query->num_rows() > 0) 
			{
				foreach ($query->result() as $row) 
				{
					$data[] = $row;
				}
					return $data;
			}
			
			return false;
		}//End of get_current_page_records();
		
		function searchnotifications($data=NULL){
		
		 $this->load->database();
		 $this->db->from('post');
		 $this->db->like('Noti_no',$data);
		 $query = $this->db->get(); 
		 return $query->result();
		 
		
		}// End of searchnotifications()
		
		
		
	}//End of Notifications Model.
	
	
