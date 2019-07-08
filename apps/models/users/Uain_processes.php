<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Uain_processes extends CI_Model{
    function isUainIssued($table,$dept,$uain){
        $dept_db=$this->load->database($dept,true);
        $query_string="SELECT A.form_id,B.p_date FROM " . $table . " as A LEFT OUTER JOIN " . $table . "_process as B ON A.form_id = B.form_id WHERE A.uain='" . $uain ."' AND (B.process_type='I' OR B.process_type='C') AND B.status='1'";
        $query_results = $dept_db->query($query_string);
        $dept_db->close();
        return $query_results;
    }//End of isUainIssued()
    
    function get_uain_read_status($table,$dept,$uain){
        $dept_db=$this->load->database($dept,true);
        $query_string="SELECT is_viewed,received_date FROM " . $table . " WHERE uain='" . $uain ."'";
      
        $query_results = $dept_db->query($query_string);
   
        $dept_db->close();
//        $this->load->database($dept,true);       
//        $this->db->select("is_viewed,received_date");
//        $this->db->from($table); 
//        $this->db->where("uain", $uain);
//        $query = $this->db->get();
          
        return $query_results;
    }//End of get_uain_read_status()
    
    function get_uain_process_status($table,$dept,$uain){
        $dept_db=$this->load->database($dept,true);
        $query_string="SELECT B.process_type FROM " . $table . " as A LEFT OUTER JOIN " . $table . "_process as B ON A.form_id = B.form_id WHERE A.uain='" . $uain ."' AND B.form_id=A.form_id AND B.status='1'";
      
        $query_results = $dept_db->query($query_string);
        $dept_db->close();
        return $query_results;
    }//End of get_uain_process_status()
}
