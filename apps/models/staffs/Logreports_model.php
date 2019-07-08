<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Logreports_model extends CI_Model{    
    function tot_rows($dept_code, $uid){        
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("user_id", $uid );
        $dept_db->from("logs");
        $query = $dept_db->get(); 
        $dept_db->close();
        return $query->num_rows();
    }//End of tot_rows()
    
    function all_rows($limit, $start, $col, $dir, $dept_code, $uid){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("user_id", $uid );
        $dept_db->limit($limit, $start); 
        $dept_db->order_by($col, $dir); 
        $dept_db->from("logs");
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return NULL;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of all_rows()
    
    function search_rows($limit, $start, $search, $col, $dir, $dept_code, $uid){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("user_id", $uid );
        $dept_db->like("log_date", $search); 
        $dept_db->or_like("login_time", $search);
        $dept_db->limit($limit, $start); 
        $dept_db->order_by($col, $dir); 
        $dept_db->from("logs");
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return NULL;
        } else {
            $dept_db->close();
            return $query->result();
        }
    }//End of search_rows()
    
    function tot_search_rows($search, $dept_code, $uid){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->where("user_id", $uid );
        $dept_db->like("log_date", $search); 
        $dept_db->or_like("login_time", $search);
        $dept_db->from("logs");
        $query = $dept_db->get(); 
        $dept_db->close();
        return $query->num_rows();
    }//End of tot_search_rows()
}//End of Logreports_model