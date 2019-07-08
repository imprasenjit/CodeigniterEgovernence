<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grievance extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('cms/grievance_model');
        $this->load->library('form_validation');
    }

    public function index() {
       
        $this->load->view('cms/requires/header', array('title' => 'New Grievance'));
        $this->load->view('cms/grievance/grievance_list');
        $this->load->view('cms/requires/footer');
    }

    public function resolved() {
        $this->load->view('cms/requires/header', array('title' => 'Resolved Grievance'));
        $this->load->view('cms/grievance/grievance_list_resolved');
        $this->load->view('cms/requires/footer');
    }

    public function newgrievances() {
        $columns = array(
            0 => 'g_id',
            1 => 'name',
            2 => 'company',
            3 => 'department',
            4 => 'date',
            5 => 'action',
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];

        if (empty($this->input->post("search")["value"])) {
            $records = $this->grievance_model->all_rows($limit, $start, $order, $dir, "new");
            $totalFiltered = $this->grievance_model->total_rows("new");
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->grievance_model->search_index_limit($limit, $order, $dir, $start, $search, "new");
            $totalFiltered = $this->grievance_model->search_total_rows($search);
        }
        $data = array();
        $this->load->helper("unituser");
        $this->load->helper("department");
        if (!empty($records)) {
            foreach ($records as $post) {
                $id = $post->g_id;
                $action = '<a href="' . base_url("cms/grievance/read/$id/") . '" class="btn btn-primary">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/grievance/read/$id/") . '" class="btn btn-warning">Reply</a>';
                $unituser = get_unit_user($post->user_id);
                $dept = get_deptName($post->dept);
                $nestedData["g_id"] = $post->g_id;
                $nestedData["name"] = ($unituser) ? $unituser->app_name : "";
                $nestedData["company"] = ($unituser) ? $unituser->unit_name : "";
                $nestedData["department"] = $dept["dept_name"];
                $nestedData["date"] = date("d-m-Y", strtotime($post->g_date));
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

    public function resolvedgrievances() {
        $columns = array(
            0 => 'g_id',
            1 => 'name',
            2 => 'company',
            3 => 'department',
            4 => 'date',
            5 => 'action',
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];

        if (empty($this->input->post("search")["value"])) {
            $records = $this->grievance_model->all_rows($limit, $start, $order, $dir, "resolved");
            $totalFiltered = $this->grievance_model->total_rows("new");
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->grievance_model->search_index_limit($limit, $order, $dir, $start, $search, "resolved");
            $totalFiltered = $this->grievance_model->search_total_rows($search);
        }
        $data = array();
        $this->load->helper("unituser");
        $this->load->helper("department");
        if (!empty($records)) {
            foreach ($records as $post) {
                $id = $post->g_id;
                $action = '<a href="' . base_url("cms/grievance/read/$id/") . '" class="btn btn-primary">View</a>';
                $unituser = get_unit_user($post->user_id);
                $dept = get_deptName($post->dept);
                $nestedData["g_id"] = $post->g_id;
                $nestedData["name"] = ($unituser) ? $unituser->app_name : "";
                $nestedData["company"] = ($unituser) ? $unituser->unit_name : "";
                $nestedData["department"] = $dept["dept_name"];
                $nestedData["date"] = date("d-m-Y", strtotime($post->g_date));
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
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');

        if ($this->uri->segment(2) == 'search') {
            $config['base_url'] = base_url() . 'grievance/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'grievance/index/';
        }

        $config['total_rows'] = $this->grievance_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'grievance/search/' . $keyword . '.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $grievance = $this->grievance_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'grievance_data' => $grievance,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('cms/requires/header', array('title' => 'grievance'));
        $this->load->view('cms/grievance/grievance_list', $data);
        $this->load->view('cms/requires/footer');
    }

    public function read($id) {
        
        $row = $this->grievance_model->get_by_id($id);
        $replies=$this->grievance_model->getreplies($id);
        if ($row) {
            $data = array(
                'g_id' => $row->g_id,
                'complaint_no' => $row->complaint_no,
                'user_id' => $row->user_id,
                'dept' => $row->dept,
                'subject' => $row->subject,
                'message' => $row->message,
                'document' => $row->document,
                'ip_address' => $row->ip_address,
                'g_date' => $row->g_date,
                'active' => $row->active,
                'replies'=>$replies
            );
            $this->load->view('cms/requires/header', array('title' => 'grievance'));
            $this->load->view('cms/grievance/grievance_read', $data);
            $this->load->view('cms/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cms/grievance'));
        }
    }

    public function replygrievance() {
        $today = date("Y-m-d H:i:s");
        $data = array(
        "grievance_id" =>$this->input->post("g_id",TRUE),
        "grievance_reply_msg" =>$this->input->post("msg"),
        "grievance_reply_time" => $today,
        "grievance_reply_from" => $this->session->userdata("cms_user_id"),
        "grievance_reply_from_type" => "cms"
        );
        $this->grievance_model->replygrievance($data);
        echo json_encode(array("success"=>1));
    }

    public function create() {
        $data = array(
            'button' => 'Create',
            'action' => site_url('grievance/create_action'),
            'g_id' => set_value('g_id'),
            'complaint_no' => set_value('complaint_no'),
            'user_id' => set_value('user_id'),
            'dept' => set_value('dept'),
            'subject' => set_value('subject'),
            'message' => set_value('message'),
            'document' => set_value('document'),
            'ip_address' => set_value('ip_address'),
            'g_date' => set_value('g_date'),
            'active' => set_value('active'),
        );
        $this->load->view('cms/requires/header', array('title' => 'grievance'));
        $this->load->view('cms/grievance/grievance_form', $data);
        $this->load->view('cms/requires/footer');
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'complaint_no' => $this->input->post('complaint_no', TRUE),
                'user_id' => $this->input->post('user_id', TRUE),
                'dept' => $this->input->post('dept', TRUE),
                'subject' => $this->input->post('subject', TRUE),
                'message' => $this->input->post('message', TRUE),
                'document' => $this->input->post('document', TRUE),
                'ip_address' => $this->input->post('ip_address', TRUE),
                'g_date' => $this->input->post('g_date', TRUE),
                'active' => $this->input->post('active', TRUE),
            );

            $this->grievance_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('cms/grievance'));
        }
    }

    public function update($id) {
        $row = $this->grievance_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('grievance/update_action'),
                'g_id' => set_value('g_id', $row->g_id),
                'complaint_no' => set_value('complaint_no', $row->complaint_no),
                'user_id' => set_value('user_id', $row->user_id),
                'dept' => set_value('dept', $row->dept),
                'subject' => set_value('subject', $row->subject),
                'message' => set_value('message', $row->message),
                'document' => set_value('document', $row->document),
                'ip_address' => set_value('ip_address', $row->ip_address),
                'g_date' => set_value('g_date', $row->g_date),
                'active' => set_value('active', $row->active),
            );
            $this->load->view('cms/grievance/grievance_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cms/grievance'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('g_id', TRUE));
        } else {
            $data = array(
                'complaint_no' => $this->input->post('complaint_no', TRUE),
                'user_id' => $this->input->post('user_id', TRUE),
                'dept' => $this->input->post('dept', TRUE),
                'subject' => $this->input->post('subject', TRUE),
                'message' => $this->input->post('message', TRUE),
                'document' => $this->input->post('document', TRUE),
                'ip_address' => $this->input->post('ip_address', TRUE),
                'g_date' => $this->input->post('g_date', TRUE),
                'active' => $this->input->post('active', TRUE),
            );

            $this->grievance_model->update($this->input->post('g_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cms/grievance'));
        }
    }

    public function delete($id) {
        $row = $this->grievance_model->get_by_id($id);

        if ($row) {
            $this->grievance_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('cms/grievance'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cms/grievance'));
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('complaint_no', ' ', 'trim|required');
        $this->form_validation->set_rules('user_id', ' ', 'trim|required|numeric');
        $this->form_validation->set_rules('dept', ' ', 'trim|required');
        $this->form_validation->set_rules('subject', ' ', 'trim|required');
        $this->form_validation->set_rules('message', ' ', 'trim|required');
        $this->form_validation->set_rules('document', ' ', 'trim');
        $this->form_validation->set_rules('ip_address', ' ', 'trim|required');
        $this->form_validation->set_rules('g_date', ' ', 'trim');
        $this->form_validation->set_rules('active', ' ', 'trim|required');

        $this->form_validation->set_rules('g_id', 'g_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

;

/* End of file Grivance.php */
/* Location: ./application/controllers/Grivance.php */