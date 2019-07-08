<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feedback_model extends CI_Model {

    public $table = 'feedback_records';
    public $id = 'id';
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
    function total_rows($type) {

        $this->db->from($this->table);
        if ($type == "new") {
            $this->db->where("active", "0");
        } else {
            $this->db->where("active", "1");
        }
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
        $this->db->like('id', $keyword);
        $this->db->or_like('name', $keyword);
        $this->db->or_like('business_name', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('phone_no', $keyword);
        $this->db->or_like('enq_msg', $keyword);
        $this->db->or_like('dept', $keyword);
        $this->db->or_like('issue', $keyword);

        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $order, $dir, $start = 0, $keyword = NULL, $type) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
        $this->db->or_like('name', $keyword);
        $this->db->or_like('business_name', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('phone_no', $keyword);
        $this->db->or_like('enq_msg', $keyword);
        $this->db->or_like('dept', $keyword);
        $this->db->or_like('issue', $keyword);
        if ($type == "new") {
            $this->db->where("active", "0");
        } else {
            $this->db->where("active", "1");
        }
        $this->db->limit($limit, $start);
        $this->db->order_by($order, $dir);

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
    // delete data
    function delete($id) {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Feedback_model.php */
/* Location: ./application/models/Feedback_model.php */