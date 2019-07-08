<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feedback_new extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('feedback_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'feedback_new/index/';
        $config['total_rows'] = $this->feedback_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'feedback_new.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $feedback_new = $this->feedback_model->index_limit($config['per_page'], $start);

        $data = array(
            'feedback_new_data' => $feedback_new,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('header',array('title'=>'feedback_new'));
        $this->load->view('feedback_new/feedback_new_list', $data);
        $this->load->view('footer');
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'feedback_new/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'feedback_new/index/';
        }

        $config['total_rows'] = $this->feedback_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'feedback_new/search/'.$keyword.'.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $feedback_new = $this->feedback_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'feedback_new_data' => $feedback_new,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('header',array('title'=>'feedback_new'));
        $this->load->view('feedback_new/feedback_new_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
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
     $this->load->view('header',array('title'=>'feedback_new'));
            $this->load->view('feedback_new/feedback_new_read', $data
                $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('feedback_new'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('feedback_new/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'business_name' => set_value('business_name'),
	    'email' => set_value('email'),
	    'phone_no' => set_value('phone_no'),
	    'enq_msg' => set_value('enq_msg'),
	    'dept' => set_value('dept'),
	    'issue' => set_value('issue'),
	    'issue_date' => set_value('issue_date'),
	    'ip_address' => set_value('ip_address'),
	    'active' => set_value('active'),
	);
         $this->load->view('header',array('title'=>'feedback_new'));
        $this->load->view('feedback_new/feedback_new_form', $data);
                   $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'business_name' => $this->input->post('business_name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'phone_no' => $this->input->post('phone_no',TRUE),
		'enq_msg' => $this->input->post('enq_msg',TRUE),
		'dept' => $this->input->post('dept',TRUE),
		'issue' => $this->input->post('issue',TRUE),
		'issue_date' => $this->input->post('issue_date',TRUE),
		'ip_address' => $this->input->post('ip_address',TRUE),
		'active' => $this->input->post('active',TRUE),
	    );

            $this->feedback_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('feedback_new'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->feedback_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('feedback_new/update_action'),
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
            $this->load->view('feedback_new/feedback_new_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('feedback_new'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'business_name' => $this->input->post('business_name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'phone_no' => $this->input->post('phone_no',TRUE),
		'enq_msg' => $this->input->post('enq_msg',TRUE),
		'dept' => $this->input->post('dept',TRUE),
		'issue' => $this->input->post('issue',TRUE),
		'issue_date' => $this->input->post('issue_date',TRUE),
		'ip_address' => $this->input->post('ip_address',TRUE),
		'active' => $this->input->post('active',TRUE),
	    );

            $this->feedback_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('feedback_new'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->feedback_model->get_by_id($id);

        if ($row) {
            $this->feedback_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('feedback_new'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('feedback_new'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', ' ', 'trim');
	$this->form_validation->set_rules('business_name', ' ', 'trim');
	$this->form_validation->set_rules('email', ' ', 'trim');
	$this->form_validation->set_rules('phone_no', ' ', 'trim');
	$this->form_validation->set_rules('enq_msg', ' ', 'trim');
	$this->form_validation->set_rules('dept', ' ', 'trim');
	$this->form_validation->set_rules('issue', ' ', 'trim');
	$this->form_validation->set_rules('issue_date', ' ', 'trim');
	$this->form_validation->set_rules('ip_address', ' ', 'trim');
	$this->form_validation->set_rules('active', ' ', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Feedback_new.php */
/* Location: ./application/controllers/Feedback_new.php */