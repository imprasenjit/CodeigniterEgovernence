<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Payments_model extends CI_Model{    
    function add_row($data, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->insert("payments", $data);
        $dept_db->close();
    }//End of add_row()
    
    function get_treasurypayinfo($paycode) {
        $cms_db = $this->load->database("cms", TRUE);
        $cms_db->select("*");
        $cms_db->from("Treasury_payment_details");
        $cms_db->where('ID', $paycode);
        $query = $cms_db->get();
        if($query->num_rows() == 0) {
            $cms_db->close();
            return FALSE;
        } else {
            $cms_db->close();
            return $query->row();
        }//End of if else
    }//End of get_treasurypayinfo()
    
    function get_payinfos($form_id) {
        $cms_db = $this->load->database("cms", TRUE);
        $cms_db->select("loa.*,tpd.*");
        $cms_db->from("list_of_approvals loa");
        $cms_db->join("Treasury_payment_details tpd", "tpd.ID = loa.paycode","left");
        $cms_db->where('loa.id', $form_id);
        $query = $cms_db->get();
        if($query->num_rows() == 0) {
            $cms_db->close();
            return FALSE;
        } else {
            $cms_db->close();
            return $query->row();
        }//End of if else
    }//End of get_payinfos()
    
    function tot_rows($dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("payments");
        $query = $dept_db->get(); 
        $dept_db->close();
        return $query->num_rows();
    }//End of tot_rows()
    
    function all_rows($limit, $start, $col, $dir, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->limit($limit, $start); 
        $dept_db->order_by($col, $dir); 
        $dept_db->from("payments");
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return NULL;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of all_rows()
    
    function search_rows($limit, $start, $search, $col, $dir, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->like("txn_time", $search); 
        $dept_db->or_like("uain", $search);
        $dept_db->limit($limit, $start); 
        $dept_db->order_by($col, $dir); 
        $dept_db->from("payments");
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return NULL;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of search_rows()
    
    function tot_search_rows($search, $dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->like("txn_time", $search);
        $dept_db->or_like("uain", $search);
        $dept_db->or_like("uain", $search);
        $dept_db->from("payments");
        $query = $dept_db->get();
        $dept_db->close();
        return $query->num_rows();
    }//End of tot_search_rows()
}//End of Payments_model