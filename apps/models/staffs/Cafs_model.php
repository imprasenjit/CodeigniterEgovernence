<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Cafs_model extends CI_Model{
    function get_row($id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("singe_window_registration"); 
        $this->db->where("id", $id ); 
        $query = $this->db->get(); 
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else        
    }//End of get_row()
    
    function get_joinrow($swr_id) {
        $this->load->database();
        $this->db->select("swr1.*,swr2.*");
        $this->db->from("singe_window_registration swr1");
        $this->db->join("singe_window_registration_part1 swr2", "swr2.swr_id = swr1.id","left");
        $this->db->where('swr1.id', $swr_id);
        //$this->db->group_by('swr1.id');
        $query = $this->db->get();
        if($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else
    }//End of get_joinrow()
    
    function tot_rows(){
        $this->load->database();
        $this->db->select("*");
        $this->db->from("singe_window_registration");
        $query = $this->db->get(); 
        $this->db->close();
        return $query->num_rows();
    }//End of tot_rows()
    
    function all_rows($limit, $start, $col, $dir){
        $this->load->database();
        $this->db->select("*");
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from("singe_window_registration");
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
        $this->db->like("Name", $search); 
        $this->db->or_like("ubin", $search);
        $this->db->limit($limit, $start); 
        $this->db->order_by($col, $dir); 
        $this->db->from("singe_window_registration");
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
        $this->db->like("Name", $search); 
        $this->db->or_like("ubin", $search);
        $this->db->from("singe_window_registration");
        $query = $this->db->get(); 
        $this->db->close();
        return $query->num_rows();
    }//End of tot_search_rows()
}//End of Cafs_model
