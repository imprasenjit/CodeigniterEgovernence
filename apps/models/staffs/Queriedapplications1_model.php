<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Queriedapplications_model extends CI_Model{
    function add_row($data){
        $this->load->database();
        $this->db->insert("queries", $data);
        $this->db->close();
    }//End of add_row()
    
    public function edit_row($data, $id){
        $this->load->database();
        $this->db->where("query_id", $id);
        $this->db->update("queries", $data);
        $this->db->close();
        return true;
    }//End of edit_row()
    
    public function get_rows_by_uain($uain){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("queries");
        $this->db->where("uain", $uain);
        $this->db->order_by("query_id","ASC");  
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }//End of edit_row()
}//End of Queriedapplications_model