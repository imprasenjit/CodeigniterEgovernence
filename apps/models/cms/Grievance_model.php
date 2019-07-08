<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grievance_model extends CI_Model {

    public $table = 'grievance_redressal';
    public $id = 'g_id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // get all
    function get_all() {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function all_rows($limit, $start, $order, $dir, $type) {
        if ($type == "new") {
            $this->db->where("active", "0");
        } else {
            $this->db->where("active", "1");
        }
        $this->db->order_by($order, $dir);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id) {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('g_id', $keyword);
        $this->db->or_like('complaint_no', $keyword);
        $this->db->or_like('user_id', $keyword);
        $this->db->or_like('dept', $keyword);
        $this->db->or_like('subject', $keyword);
        $this->db->or_like('message', $keyword);
        $this->db->or_like('document', $keyword);
        $this->db->or_like('ip_address', $keyword);
        $this->db->or_like('g_date', $keyword);
        $this->db->or_like('active', $keyword);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $order, $dir, $start = 0, $keyword = NULL, $type) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('g_id', $keyword);
        $this->db->or_like('complaint_no', $keyword);
        $this->db->or_like('user_id', $keyword);
        $this->db->or_like('dept', $keyword);
        $this->db->or_like('subject', $keyword);
        $this->db->or_like('message', $keyword);
        $this->db->or_like('document', $keyword);
        $this->db->or_like('ip_address', $keyword);
        $this->db->or_like('g_date', $keyword);
        $this->db->or_like('active', $keyword);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    function replygrievance($data) {
        $this->db->insert("grievance_reply", $data);
        
    }
    
    function getreplies($id){
       $this->db->from("grievance_reply"); 
       $this->db->where("grievance_id",$id);
       $query=$this->db->get();
       if($query->num_rows() > 0){
           return $query->result();
       }else{
           return false;
       }
    }

    // delete data
    function delete($id) {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Grivance_model.php */
/* Location: ./application/models/Grivance_model.php */