<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dms_upload_docs_con extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("staffs/dms_upload_docs_model");
        $this->load->library('form_validation');
		$this->load->helper("fileupload");
    }

    public function index()
    {
        $keyword = '';
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'staffs/dms_upload_docs_con/index/';
        $config['total_rows'] = $this->dms_upload_docs_model->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'staffs/dms_upload_docs_con/';
        $this->pagination->initialize($config);

        $start = $this->uri->segment(3, 0);
        $dms_upload_docs_con = $this->dms_upload_docs_model->index_limit($config['per_page'], $start);

        $data = array(
            'dms_upload_docs_con_data' => $dms_upload_docs_con,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('staffs/requires/header',array('title'=>'dms_upload_docs_con'));
        $this->load->view('staffs/dms_upload_docs_view', $data);
        $this->load->view('staffs/requires/sidebar');
		$this->load->view('staffs/requires/footer');
    }
    public function file_upload(){
		
		
		
		$this->load->view('staffs/dms_upload_docs_view');	
	}
    public function search() 
    {
        $keyword = $this->uri->segment(3, $this->input->post('keyword', TRUE));
        $this->load->library('pagination');
        
        if ($this->uri->segment(2)=='search') {
            $config['base_url'] = base_url() . 'staffs/dms_upload_docs_con/search/' . $keyword;
        } else {
            $config['base_url'] = base_url() . 'staffs/dms_upload_docs_con/index/';
        }

        $config['total_rows'] = $this->dms_upload_docs_model->search_total_rows($keyword);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        //$config['suffix'] = '.html';
        $config['first_url'] = base_url() . 'staffs/dms_upload_docs_con/search/'.$keyword;
        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $dms_upload_docs_con = $this->dms_upload_docs_model->search_index_limit($config['per_page'], $start, $keyword);

        $data = array(
            'dms_upload_docs_con_data' => $dms_upload_docs_con,
            'keyword' => $keyword,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        $this->load->view('staffs/requires/header',array('title'=>'dms_upload_docs_con'));
        $this->load->view('staffs/dms_upload_docs_view', $data);
        $this->load->view('staffs/requires/sidebar');
		$this->load->view('staffs/requires/footer');
    }

    public function read($id) 
    {
        $row = $this->dms_upload_docs_model->get_by_id($id);
        if ($row) {
            $data = array(
			'id' => $row->id,
			'doc_name' => $row->doc_name,
			'doc_type' => $row->doc_type,
			'doc_size' => $row->doc_size,
			'file_path' => $row->file_path,
			'uploaded_date' => $row->uploaded_date,
			'created_at' => $row->created_at,
			'created_by' => $row->created_by,
			
			
	    );
		$this->load->view('staffs/requires/header',array('title'=>'dms_upload_docs_con'));
        $this->load->view('staffs/dms_upload_docs_view', $data);
        $this->load->view('staffs/requires/sidebar');
		$this->load->view('staffs/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dms_upload_docs_con'));
        }
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('staffs/dms_upload_docs_con/create_action'),
			'id' => set_value('id'),
			'doc_name' => set_value('doc_name'),
			'doc_type' => set_value('doc_type'),
			'doc_size' => set_value('doc_size'),
			'file_path' => set_value('file_path'),
			'uploaded_date' => set_value('uploaded_date'),
			'created_at' => set_value('created_at'),
			'created_by' => set_value('created_by'),
			
	);
	
        $this->load->view('staffs/requires/header',array('title'=>'dms_upload_docs_con'));
        $this->load->view('staffs/dms_upload_docs_view', $data);
        $this->load->view('staffs/requires/sidebar');
		$this->load->view('staffs/requires/footer');
    }
    
    public function create_action()
       
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
			
			$this->load->helper("fileupload");
			if ($this->input->post("upload_file_path")) {
				$file_path = moveFile(0, $this->input->post("upload_file_path"), "file_path");
			}
            $data = array(
			'doc_name' => $this->input->post('doc_name',TRUE),
			'doc_type' => $this->input->post('doc_type',TRUE),
			//'doc_size' => $this->input->post('doc_size',TRUE),
			'file_path' => $this->input->post('file_path',TRUE),
			'uploaded_date' => $this->input->post('uploaded_date',TRUE),
			//'created_at' => $this->input->post('created_at',TRUE),
			'created_by' => $this->input->post('created_by',TRUE),
			
	    );
			//print_r($data); die();
            $this->dms_upload_docs_model->insert($data);
			
			$this->session->set_flashdata("flashMsg", "<strong><div style='color:red;'> Successfully uploaded!!</div></strong> ");
            redirect(site_url('staffs/dms_upload_docs_con/create'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->dms_upload_docs_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('dms_upload_docs_con/update_action'),
				'id' => set_value('id', $row->id),
				'doc_name' => set_value('doc_name', $row->doc_name),
				'doc_type' => set_value('doc_type', $row->doc_type),
				'doc_size' => set_value('doc_size', $row->doc_size),
				'file_path' => set_value('file_path', $row->file_path),
				'uploaded_date' => set_value('uploaded_date', $row->uploaded_date),
				'created_at' => set_value('created_at', $row->created_at),
				'created_by' => set_value('created_by', $row->created_by),
				
	    );
		$this->load->view('staffs/requires/header',array('title'=>'dms_upload_docs_con'));
        $this->load->view('staffs/dms_upload_docs_view', $data);
        $this->load->view('staffs/requires/sidebar');
		$this->load->view('staffs/requires/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dms_upload_docs_con'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
			$this->load->helper("fileupload");
			if ($this->input->post("upload_picture")) {
				$picture = moveFile(0, $this->input->post("upload_picture"), "picture");
			}
            $data = array(
			'doc_name' => $this->input->post('doc_name',TRUE),
			'doc_type' => $this->input->post('doc_type',TRUE),
			'doc_size' => $this->input->post('doc_size',TRUE),
			//'picture' => $this->input->post('picture',TRUE),
			'file_path' => $file_path[0],
			'uploaded_date' => $this->input->post('uploaded_date',TRUE),
			'created_at' => $this->input->post('created_at',TRUE),
			'created_by' => $this->input->post('created_by',TRUE),
			
	    );

            $this->dms_upload_docs_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('dms_upload_docs_con'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->dms_upload_docs_model->get_by_id($id);

        if ($row) {
            $this->dms_upload_docs_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dms_upload_docs_con'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dms_upload_docs_con'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('doc_name', ' ', 'trim');
	$this->form_validation->set_rules('doc_type', ' ', 'trim');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Dms_upload_docs_con.php */
/* Location: ./application/controllers/staffs/Dms_upload_docs_con.php */