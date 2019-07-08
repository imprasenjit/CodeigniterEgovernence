<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Paymentrequest_model extends CI_Model{
    function add_row($data){
        $this->load->database();
        $this->db->insert("payment_requests", $data);
        $this->db->close();
    }//End of add_row()
    
    function get_row($txn_request_id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("payment_requests"); 
        $this->db->where("txn_request_id", $txn_request_id ); 
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()
    
    function get_challanrow($challan_no){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("payment_requests"); 
        $this->db->where("challan_no", $challan_no ); 
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()

    
    function tot_rows(){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("payment_requests");
        $query = $this->db->get(); 
        $this->db->close();
        return $query->num_rows();
    }//End of tot_rows()
    
    function all_rows($limit, $start, $col, $dir){
        $this->load->database();
        $this->db->select("*");
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from("payment_requests");
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }//End of all_rows()
    
    function search_rows($limit, $start, $search, $col, $dir){
        $this->load->database();
        $this->db->select("*");
        $this->db->like("challan_no", $search); 
        $this->db->or_like("uain", $search);
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from("payment_requests");
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }//End of search_rows()
    
    function tot_search_rows($search){
        $this->load->database();
        $this->db->select("*");
        $this->db->like("challan_no", $search); 
        $this->db->or_like("uain", $search);
        $this->db->from("payment_requests");
        $query = $this->db->get(); 
        $this->db->close();
        return $query->num_rows();
    }//End of tot_search_rows()
}//End of Paymentrequest_model