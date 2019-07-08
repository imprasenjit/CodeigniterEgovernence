<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feedback extends Eodbc {

    function __construct() {
        parent::__construct();
        $this->load->model('cms/feedback_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('cms/requires/header', array('title' => 'feedback'));
        $this->load->view('cms/feedback/feedback_list');
        $this->load->view('cms/requires/footer');
    }

    public function activefeedbacks() {
        $this->load->view('cms/requires/header', array('title' => 'feedback'));
        $this->load->view('cms/feedback/feedback_list_active');
        $this->load->view('cms/requires/footer');
    }

    function newfeedbacks() {
        //die();
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'msg',
            3 => 'date',
            4 => 'action',
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];

        if (empty($this->input->post("search")["value"])) {
            $records = $this->feedback_model->all_rows($limit, $start, $order, $dir, "new");
            $totalFiltered = $this->feedback_model->total_rows("new");
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->feedback_model->search_index_limit($limit, $order, $dir, $start, $search, "new");
            $totalFiltered = $this->feedback_model->search_total_rows($search);
        }
        $data = array();
        if (!empty($records)) {
            foreach ($records as $post) {
                $id = $post->id;
                $action = '<a href="' . base_url("cms/feedback/read/$id/") . '" class="btn btn-primary">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/feedback/update/$id/") . '" class="btn btn-warning">Edit</a>&nbsp;&nbsp;<a href="' . base_url("cms/feedback/activate/$id/") . '" class="btn btn-success activate">Activate</a>';

                $nestedData["id"] = $post->id;
                $nestedData["name"] = $post->name;
                $nestedData["msg"] = (strlen($post->enq_msg) > 40) ? substr($post->enq_msg, 0, 30) . ".." : $post->enq_msg;
                $nestedData["date"] = date("d-m-Y", strtotime($post->issue_date));
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalFiltered),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    function getactivefeedbacks() {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'msg',
            3 => 'date',
            4 => 'action',
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];

        if (empty($this->input->post("search")["value"])) {
            $records = $this->feedback_model->all_rows($limit, $start, $order, $dir, "active");
            $totalFiltered = $this->feedback_model->total_rows("active");
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->feedback_model->search_index_limit($limit, $order, $dir, $start, $search, "active");
            $totalFiltered = $this->feedback_model->search_total_rows($search);
        }
        $data = array();
        if (!empty($records)) {
            foreach ($records as $post) {
                $id = $post->id;
                $action = '<a href="' . base_url("cms/feedback/read/$id/") . '" class="btn btn-primary">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/feedback/update/$id/") . '" class="btn btn-warning">Edit</a>&nbsp;&nbsp;<a href="' . base_url("cms/feedback/deactivate/$id/") . '" class="btn btn-danger deactivate">Deactivate</a>';

                $nestedData["id"] = $post->id;
                $nestedData["name"] = $post->name;
                $nestedData["msg"] = (strlen($post->enq_msg) > 40) ? substr($post->enq_msg, 0, 30) . ".." : $post->enq_msg;
                $nestedData["date"] = date("d-m-Y", strtotime($post->issue_date));
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalFiltered),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    public function search() {
        $keyword = $this->uri->segment(4, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');

        if ($this->uri->segment(3) == 'search') {
            $config['base_url'] = base_url() . 'feedback/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'feedback/index/';
        }

        $config['total_rows'] = $this->feedback_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'feedback/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $feedback = $this->feedback_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'feedback_data' => $feedback,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('cms/requires/header', array('title' => 'feedback'));
        $this->load->view('feedback/feedback_list', $data);
        $this->load->view('cms/requires/footer');
    }

    public function read($id) {
        $row = $this->feedback_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'name' => $row->name,
                'business_name' => $row->business_name,
                'email' => $row->email,
                'phone_no' => $row->phone_no,
                'enq_msg' => $row->enq_msg,
                'dept' => $row->dept,
                'issue' => $row->issue,
                'issue_date' => $row->issue_date,
                'ip_address' => $row->ip_address,
                'active' => $row->active,
            );
            $this->load->view('cms/requires/header', array('title' => 'feedback'));
            $this->load->view('cms/feedback/feedback_read', $data);
            $this->load->view('cms/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('feedback'));
        }
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('feedback/create_action'),
            'id' => set_value('id'),
            'name' => set_value('name'),
            'business_name' => set_value('business_name'),
            'email' => set_value('email'),
            'phone_no' => set_value('phone_no'),
            'enq_msg' => set_value('enq_msg'),
            'dept' => set_value('dept'),
            'issue' => set_value('issue'),
        );
        $this->load->view('cms/requires/header', array('title' => 'feedback'));
        $this->load->view('cms/feedback/feedback_form', $data);
        $this->load->view('cms/requires/footer');
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'business_name' => $this->input->post('business_name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'phone_no' => $this->input->post('phone_no', TRUE),
                'enq_msg' => $this->input->post('enq_msg', TRUE),
                'dept' => $this->input->post('dept', TRUE),
                'issue' => $this->input->post('issue', TRUE),
                'issue_date' => $this->input->post('issue_date', TRUE),
                'ip_address' => $this->input->post('ip_address', TRUE),
                'active' => $this->input->post('active', TRUE),
            );

            $this->feedback_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('cms/feedback'));
        }
    }

    public function update($id) {
        $row = $this->feedback_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cms/feedback/update_action'),
                'id' => set_value('id', $row->id),
                'name' => set_value('name', $row->name),
                'business_name' => set_value('business_name', $row->business_name),
                'email' => set_value('email', $row->email),
                'phone_no' => set_value('phone_no', $row->phone_no),
                'enq_msg' => set_value('enq_msg', $row->enq_msg),
                'dept' => set_value('dept', $row->dept),
                'issue' => set_value('issue', $row->issue),
                'issue_date' => set_value('issue_date', $row->issue_date),
                'ip_address' => set_value('ip_address', $row->ip_address),
                'active' => set_value('active', $row->active),
            );
            $this->load->view('cms/requires/header', array('title' => 'feedback'));
            $this->load->view('cms/feedback/feedback_form', $data);
            $this->load->view('cms/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cms/feedback'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'business_name' => $this->input->post('business_name', TRUE),
                'email' => $this->input->post('email', TRUE),
                'phone_no' => $this->input->post('phone_no', TRUE),
                'enq_msg' => $this->input->post('enq_msg', TRUE),
                'dept' => $this->input->post('dept', TRUE),
                'issue' => $this->input->post('issue', TRUE),
            );

            $this->feedback_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cms/feedback/update/' . $this->input->post('id', TRUE)));
        }
    }

    public function delete($id) {
        $row = $this->feedback_model->get_by_id($id);

        if ($row) {
            $this->feedback_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('cms/feedback'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cms/feedback'));
        }
    }

    public function activate($id) {
        $row = $this->feedback_model->get_by_id($id);
        if ($row) {
            $data=array(
                "active"=>"1"
            );
            $this->feedback_model->update($id,$data);
            $this->session->set_flashdata('message', 'Activate Record Success');
            redirect(site_url('cms/feedback'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cms/feedback'));
        }
    }
        public function deactivate($id) {
        $row = $this->feedback_model->get_by_id($id);
        if ($row) {
            $data=array(
                "active"=>"0"
            );
            $this->feedback_model->update($id,$data);
            $this->session->set_flashdata('message', 'Activate Record Success');
            redirect(site_url('cms/feedback'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cms/feedback'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('name', ' ', 'trim');
        $this->form_validation->set_rules('business_name', ' ', 'trim');
        $this->form_validation->set_rules('email', ' ', 'trim');
        $this->form_validation->set_rules('phone_no', ' ', 'trim');
        $this->form_validation->set_rules('enq_msg', ' ', 'trim');
        $this->form_validation->set_rules('dept', ' ', 'trim');
        $this->form_validation->set_rules('issue', ' ', 'trim');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Feedback_new.php */
/* Location: ./application/controllers/Feedback_new.php */