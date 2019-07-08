<?php
class Ovs_model extends CI_Model{
  
    function get_form_details($uain,$table,$dept){
		$dept_db = $this->load->database($dept, TRUE);
		$table_name    = $table;
        $dept_db->select("*");
        $dept_db->from($table_name); 
        $dept_db->where("uain", $uain ); 
		$dept_db->where('save_mode != ', "D" ); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }
	}//End of get_form_details()
    
    function getunitdetails($swr_id) {
        $this->load->database();
        $this->db->from("unit_master_record");
        $this->db->where("unit_master_record_id", $swr_id);
        $this->db->where("status", "1");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	
	function getprocessdetails($table,$dept,$form_id) {
        $p_db = $this->load->database($dept, TRUE);
		$table_name = $table . '_process';
        $p_db->from($table_name); 
        $p_db->where("form_id", $form_id);
		$p_db->where("process_type", "I");
        $query = $p_db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	
	function getprocessrows($table,$dept,$form_id) {
        $process_db = $this->load->database($dept, TRUE);
		$table_name = $table . '_process';
        $process_db->from($table_name); 
        $process_db->where("form_id", $form_id);
		$process_db->order_by("p_id", "asc");
        $query = $process_db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
	
	function getuserrows($p_user_id,$dept) {
		$u_db = $this->load->database($dept, TRUE);
        //$this->load->database($dept, TRUE);
        $u_db->from("users");
        $u_db->where("user_id", $p_user_id);
        $query = $u_db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	function getofficesrows($office_id,$dept) {
		$o_db = $this->load->database($dept, TRUE);
        $o_db->from("offices");
        $o_db->where("id", $office_id);
       
        $query = $o_db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	
	public function get_utypeName($utype_id,$dept){	
		$u_db = $this->load->database($dept, TRUE);
        $u_db->from("utypes"); 
        $u_db->where("utype_id", $utype_id);
        $query = $u_db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
	
	}
	
	function get_UserNameDet($forward_to,$dept) {
		$user_db = $this->load->database($dept, TRUE);
		//$this->load->database($dept, TRUE);
        $user_db->from("users");
        $user_db->where("id", $forward_to);
       
        $query = $user_db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	function get_UserName($remark) {
        $this->load->database();
        $this->db->from("queries");
        $this->db->where("query_id", $remark);
       
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	
	function get_AllMsg($p_date,$query_id) {
        $this->load->database();
        $this->db->from("queries");
		$this->db->where("status", "1");
        $this->db->where("q_date", $p_date);
        $this->db->or_where("query_id", $query_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	
	function get_form_name22($dept_id, $form_no){
        $form_db = $this->load->database("cms", TRUE);
        $form_db->select("*");
        $form_db->from("list_of_approvals");
        $form_db->where("sub_dept", $dept_id); 
        $form_db->where("form_no", $form_no);
        $query = $form_db->get(); 
        if($query->num_rows() > 0) {
			return $query->row();
		} else {
             return FALSE;
        }//End of if else 
    }//End of get_form_name22()

}
