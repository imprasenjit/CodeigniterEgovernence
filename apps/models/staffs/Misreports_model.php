<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Misreports_model extends CI_Model{
    function get_rows($dept_code){
        $qrypcb = "SELECT id, CustomerID as uain, TxnAmount as amnt, TxnDate as dt, BankReferenceNo as refno, TxnType as typ FROM online_billdesk_payments";
        $qryfactory = "SELECT id, uain, TxnAmount as amnt, TxnDate as dt, BankReferenceNo as refno, fee_type as typ FROM online_treasury_payments";
        
        $qry1 = ($dept_code=="pcb")?$qrypcb:$qryfactory;
        
        $qry2 = "SELECT id, uain, txn_amount, txn_date, txn_ref_no, fee_type FROM offline_payments";
        $qry = $qry1." UNION ALL ".$qry2; 
        
        $dept_db = $this->load->database($dept_code, TRUE); 
        $query = $dept_db->query($qry); 
        if($query->num_rows() == 0) {
            $dept_db->close($qry);
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_rows()
    
    function get_onlinerow($dept_code, $uain){
        if($dept_code=="pcb") {
            $tbl = "online_billdesk_payments";
            $field = "CustomerID";
        } else {
            $tbl = "online_treasury_payments";
            $field = "uain";
        }
        
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from($tbl); 
        $dept_db->where($field, $uain); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else        
    }//End of get_onlinerow()
    
    function get_onlinerows($dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("online_treasury_payments"); 
        $dept_db->order_by("id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_onlinerows()
    
    function get_offlinerow($dept_code, $uain){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("offline_payments"); 
        $dept_db->where("uain", $uain); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row();
        }//End of if else        
    }//End of get_offlinerow()
    
    function get_offlinerows($dept_code){
        $dept_db = $this->load->database($dept_code, TRUE);
        $dept_db->select("*");
        $dept_db->from("offline_payments"); 
        $dept_db->order_by("id","DESC");  
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->result();
        }//End of if else
    }//End of get_offlinerows()
}//End of Misreports_model