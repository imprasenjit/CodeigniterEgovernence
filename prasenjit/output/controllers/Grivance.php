<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grivance extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('grivance_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'grivance/index/';
        $config['total_rows'] = $this->grivance_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'grivance.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $grivance = $this->grivance_model->index_limit($config['per_page'], $start);

        $data = array(
            'grivance_data' => $grivance,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('header',array('title'=>'grivance'));
        $this->load->view('grivance/grivance_list', $data);
        $this->load->view('footer');
    }
    
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'grivance/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'grivance/index/';
        }

        $config['total_rows'] = $this->grivance_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'grivance/search/'.$keyword.'.html';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $grivance = $this->grivance_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'grivance_data' => $grivance,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('header',array('title'=>'grivance'));
        $this->load->view('grivance/grivance_list', $data);
        $this->load->view('footer');
    }

    public function read($id) 
    {
        $row = $this->grivance_model->get_by_id($id);
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
	    );
     $this->load->view('header',array('title'=>'grivance'));
            $this->load->view('grivance/grivance_read', $data
                $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('grivance'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('grivance/create_action'),
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
         $this->load->view('header',array('title'=>'grivance'));
        $this->load->view('grivance/grivance_form', $data);
                   $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'complaint_no' => $this->input->post('complaint_no',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
		'dept' => $this->input->post('dept',TRUE),
		'subject' => $this->input->post('subject',TRUE),
		'message' => $this->input->post('message',TRUE),
		'document' => $this->input->post('document',TRUE),
		'ip_address' => $this->input->post('ip_address',TRUE),
		'g_date' => $this->input->post('g_date',TRUE),
		'active' => $this->input->post('active',TRUE),
	    );

            $this->grivance_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('grivance'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->grivance_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('grivance/update_action'),
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
            $this->load->view('grivance/grivance_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('grivance'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('g_id', TRUE));
        } else {
            $data = array(
		'complaint_no' => $this->input->post('complaint_no',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
		'dept' => $this->input->post('dept',TRUE),
		'subject' => $this->input->post('subject',TRUE),
		'message' => $this->input->post('message',TRUE),
		'document' => $this->input->post('document',TRUE),
		'ip_address' => $this->input->post('ip_address',TRUE),
		'g_date' => $this->input->post('g_date',TRUE),
		'active' => $this->input->post('active',TRUE),
	    );

            $this->grivance_model->update($this->input->post('g_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('grivance'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->grivance_model->get_by_id($id);

        if ($row) {
            $this->grivance_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('grivance'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('grivance'));
        }
    }

    public function _rules() 
    {
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

};

/* End of file Grivance.php */
/* Location: ./application/controllers/Grivance.php */