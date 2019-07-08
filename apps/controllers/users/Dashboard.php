<?php
	
	/**
		* Description of Unit
		* 
		* @author Avantika Innovations PVT LTD
		* Prasenjit Das 
	*/
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Dashboard extends Eodbu {
		public $dept_code;
		public $staff_id;
		public $frmtbl;
		public $form_id;
		public $frm_no;
		public $uain;
		public $swr_id;
		//put your Constructor here
		function __construct() {
			
			parent::__construct();
			$this->load->model("users/dashboard_model");
			$this->load->model("users/unit_model");
			$this->load->helper("unituser");
			//$this->load->model("staffs/applicationsup_model");
			
			//$this->dept_code = $this->session->users_dept;
			//$this->users_id = $this->session->users_id;
			$this->load->helper("encode");
			$this->load->helper("unittype");
			$this->load->helper("formprocesses");
			$this->load->model("staffs/deptusers_model");
			$this->load->model("staffs/offices_model");
			$this->load->model("staffs/utypes_model");
			$this->load->model("staffs/subdepartments_model");
			$this->load->model("staffs/forms_model");
			$this->load->model("staffs/applicationsup_model");
			$this->load->model("staffs/applicationsir_model"); 
			$this->load->model("staffs/formprocess_model");
			$this->load->model("users/caf_model");
			$this->load->model("staffs/queriedapplications_model");
			
		}
		
		/**
			* 
			* @param type $unit_id
		*/
		
		function get_appl_view($uainencoded=NULL) {
			
			$this->uain = decodeme($uainencoded);   
			$this->dept_code = uainexplode($this->uain, "dept_code");     
			$this->form_id = uainexplode($this->uain, "form_id");        
			$this->frm_no = uainexplode($this->uain, "form_no"); //die($uain." : ".$this->frm_no);  
			if($this->frm_no > 0) {
				$this->frmtbl = $this->dept_code."_form".$this->frm_no;
				$frmRow = $this->forms_model->get_uainrow($this->dept_code, $this->frmtbl, $this->uain);
				//print_r($frmRow);
				//echo $this->dept_code; 
				//echo $this->frmtbl; 
				//echo $this->uain; die();
				
				if($frmRow) {
					$this->swr_id = $frmRow->user_id;
					$this->load->view("users/dashboard/application_form_view");
					} else {
					die("UAIN not found!");
				}
				} else {
				die("Form does not exist");
			}      
		} 
		
		function track_application($uainencoded=NULL) {
			//echo "sdf"; die();
			echo $this->uain = $this->input->post("uain");
			//$this->uain = decodeme($uainencoded);   
			$this->dept_code = uainexplode($this->uain, "dept_code");     
			$this->form_id = uainexplode($this->uain, "form_id");  
			$this->frm_no = uainexplode($this->uain, "form_no"); //die($uain." : ".$this->frm_no);  
			
			
			if($this->frm_no > 0) {
				$this->frmtbl = $this->dept_code."_form".$this->frm_no;
				$frmRow = $this->forms_model->get_uainrow($this->dept_code, $this->frmtbl, $this->uain);
				
				if($frmRow) {
					$this->swr_id = $frmRow->user_id;
					$this->load->view("users/dashboard/application_form_view");
					} else {
					die("UAIN not found!");
				}
				} else {
				die("Form does not exist");
			}      
		} 
		
		
		function view($unit_id) {
			//var_dump(check_if_unit_belong_to_caf($unit_id, $this->session->caf_id));die();
			if (check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
				$unit = $this->unit_model->getunit("unit_id",$unit_id);
				//print_r($unit);die();
				$data = array(
                "title" => "UNIT DASHBOARD",
                "unit_id" => $unit_id
				);
				if (!isset($this->session->unit_id)) {
					$this->session->set_userdata("unit_id", $unit_id);
					//$this->session->set_userdata("unit_master_record_id", $unit_master_record_id);
				}
				$page_data = array(
                "submitted_applications" => $this->dashboard_model->get_all_application($unit_id, "submitted", 7),
                "incomplete_applications" => $this->dashboard_model->get_all_application($unit_id, "incomplete", 7),
                "messages" => $this->dashboard_model->get_all_message($unit_id, 5),
                "unit" => $unit
				);
				$this->load->view("users/requires/header", $data);
				$this->load->view("users/dashboard/unitdashboard", $page_data);
				$this->load->view("users/requires/footer");
				} else {
				$this->session->sess_destroy();
				redirect(base_url());
			}
		}
		
		/**
			* This function is for viewing all messages
			* @param type $unit_id
		*/
		function viewallmessages($unit_id) {
			if (check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
				$this->load->library('pagination');
				$this->load->helper('url');
				$config['base_url'] = base_url() . 'users/dashboard/viewallmessages/' . $this->session->unit_id . '/';
				$config['per_page'] = 3;
				$config['uri_segment'] = 5;
				$config['first_url'] = base_url() . 'users/dashboard/viewallmessages/' . $this->session->unit_id . '/';
				$config['total_rows'] = ($this->dashboard_model->get_all_message($unit_id))?count($this->dashboard_model->get_all_message($unit_id)):0;
				$this->pagination->initialize($config);
				
				$start = $this->uri->segment(5, 0);
				$messages = $this->dashboard_model->index_limit_messages($unit_id, $config['per_page'], $start);
				
				
				$data = array(
				'messages' => $messages,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
				);
				$header_data = array(
				"title" => "UNIT MESSAGES",
				"unit_id" => $unit_id
				);
				$this->load->view("users/requires/header", $header_data);
				$this->load->view("users/dashboard/viewallmessages", $data);
				$this->load->view("users/requires/footer");
				}else {
				$this->session->sess_destroy();
				redirect(base_url());
			}
		}
		
		function getmessage($unit_id) {
			
			if (!check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
				$this->session->sess_destroy();
				redirect(base_url());
				} else {
				$query_id = $this->input->post("msg_id");
				$data = array(
                "unit_id" => $unit_id,
                "query" => $this->dashboard_model->get_message($query_id)
				);
				$this->load->view("users/dashboard/viewsinglemessage", $data);
			}
		}
		
		/**
			* 
			* @param type $unit_id
		*/
		function viewallsubmittedapplications($unit_id) {
			if (check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
				$this->load->library('pagination');
				$this->load->helper('url');
				$config['base_url'] = base_url() . 'users/dashboard/viewallsubmittedapplications/' . $this->session->unit_id . '/';
				$config['per_page'] = 5;
				$config['uri_segment'] = 5;
				$config['first_url'] = base_url() . 'users/dashboard/viewallsubmittedapplications/' . $this->session->unit_id . '/';
				$config['total_rows'] =($this->dashboard_model->get_all_application($unit_id, "submitted"))?count($this->dashboard_model->get_all_application($unit_id, "submitted")):0;
				$this->pagination->initialize($config);
				
				$start = $this->uri->segment(5, 0);
				$applications = $this->dashboard_model->index_limit_applications($unit_id, $config['per_page'], $start, "submitted");
				
				
				$data = array(
				'submitted_applications' => $applications,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
				);
				$header_data = array(
				"title" => "UNIT SUBMITTED APPLICATIONS", "unit_id" => $unit_id
				);
				$this->load->view("users/requires/header", $header_data);
				$this->load->view("users/dashboard/viewallsubmittedapplications", $data);
				$this->load->view("users/requires/footer");
				}	else {
				$this->session->sess_destroy();
				redirect(base_url());
			}
		}
		
		/**
			* 
			* @param type $unit_id
		*/
		function viewallincompleteapplications($unit_id) {
			if (check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
				$this->load->library('pagination');
				$this->load->helper('url');
				$config['base_url'] = base_url() . 'users/dashboard/viewallincompleteapplications/' . $this->session->unit_id . '/';
				$config['per_page'] = 5;
				$config['uri_segment'] = 5;
				$config['first_url'] = base_url() . 'users/dashboard/viewallincompleteapplications/' . $this->session->unit_id . '/';
				$config['total_rows'] = ($this->dashboard_model->get_all_application($unit_id, "incomplete"))?count($this->dashboard_model->get_all_application($unit_id, "incomplete")):0;
				$this->pagination->initialize($config);
				
				$start = $this->uri->segment(5, 0);
				$applications = $this->dashboard_model->index_limit_applications($unit_id, $config['per_page'], $start, "incomplete");
				
				
				$data = array(
				'incomplete_applications' => $applications,
				'pagination' => $this->pagination->create_links(),
				'total_rows' => $config['total_rows'],
				'start' => $start,
				);
				$header_data = array(
				"title" => "UNIT INCOMPLETE APPLICATIONS", "unit_id" => $unit_id
				);
				$this->load->view("users/requires/header", $header_data);
				$this->load->view("users/dashboard/viewallincompleteapplications", $data);
				$this->load->view("users/requires/footer");
				}	else {
				$this->session->sess_destroy();
				redirect(base_url());
			}
		}
		
		function changepassword($unit_id) {
			
			if (!check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
				$this->session->sess_destroy();
				redirect(base_url());
			}
			$data = array("title" => "CHANGE PASSWORD", "unit_id" => $unit_id);
			$this->load->view("users/requires/header", $data);
			$this->load->view("users/dashboard/changepassword");
			$this->load->view("users/requires/footer");
		}
		
		function passwordchange($unit_id) {
			
			if (!check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
				$this->session->sess_destroy();
				redirect(base_url());
				} else {
			$old_password = $this->input->post("old_password");
			$new_password = $this->input->post("password");
			$cnfm_password = $this->input->post("cfmPassword");
			$usr = $this->unit_model->getunit($unit_id);
			if (crypt($old_password, $usr->app_password) == $usr->app_password) {
			if ($new_password === $cnfm_password) {
			$this->load->helper("password");
			$data = array(
			"app_password" => create_hashed_password($password)
			);
			$this->load->database();
			$this->db->where("unit_master_record_id", $unit_id);
			$this->db->update("unit_master_record", $data);
			if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata("flashMsg", "Password Changed!");
			redirect(base_url("users/dashboard/changepassword"));
			} else {
			$this->session->set_flashdata("flashMsg", "Something Went Wrong!");
			redirect(base_url("users/dashboard/changepassword"));
			}
			} else {
			$this->session->set_flashdata("flashMsg", "Password and confirm password does not match!");
			redirect(base_url("users/dashboard/changepassword"));
			}
			} else {
			$this->session->set_flashdata("flashMsg", "Invalid Old Password!");
			redirect(base_url("users/dashboard/changepassword"));
			}
			}
			}
			
			function elocker($unit_id) {
			
			if (!check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
			$this->session->sess_destroy();
			redirect(base_url());
			} else {
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = base_url() . 'users/dashboard/elocker/' . $this->session->unit_id . '/';
			$config['per_page'] = 1;
			$config['uri_segment'] = 5;
			$config['first_url'] = base_url() . 'users/dashboard/elocker/' . $this->session->unit_id . '/';
			$config['total_rows'] = ($this->dashboard_model->get_all_documents($unit_id, "mydocuments"))?count($this->dashboard_model->get_all_documents($unit_id, "mydocuments")):0;
			$this->pagination->initialize($config);
			
			$start = $this->uri->segment(5, 0);
			$documents = $this->dashboard_model->index_limit_documents($unit_id, $config['per_page'], $start, "mydocuments");
			
			
			$data = array(
			'page' => 'mydocuments',
			'documents' => $documents,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
			);
			$header_data = array(
			"title" => "UNIT ELOCKER", "unit_id" => $unit_id
			);
			$this->load->view("users/requires/header", $header_data);
			$this->load->view("users/dashboard/elocker", $data);
			$this->load->view("users/requires/footer");
			}
			}
			
			function formdocuments($unit_id) {
			
			if (!check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
			$this->session->sess_destroy();
			redirect(base_url());
			} else {
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = base_url() . 'users/dashboard/viewformdocuments/' . $this->session->unit_id . '/';
			$config['per_page'] = 3;
			$config['uri_segment'] = 5;
			$config['first_url'] = base_url() . 'users/dashboard/viewformdocuments/' . $this->session->unit_id . '/';
			$config['total_rows'] = ($this->dashboard_model->get_all_documents($unit_id, "form_documents"))?count($this->dashboard_model->get_all_documents($unit_id, "form_documents")):0;
			$this->pagination->initialize($config);
			
			$start = $this->uri->segment(5, 0);
			$documents = $this->dashboard_model->index_limit_documents($unit_id, $config['per_page'], $start, "form_documents");
			
			$data = array(
			'page' => 'formdocuments',
			'documents' => $documents,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
			);
			$header_data = array(
			"title" => "UNIT ELOCKER", "unit_id" => $unit_id
			);
			$this->load->view("users/requires/header", $header_data);
			$this->load->view("users/dashboard/elocker", $data);
			$this->load->view("users/requires/footer");
			}
			}
			
			function certificates($unit_id) {
			
			if (!check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
			$this->session->sess_destroy();
			redirect(base_url());
			} else {
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = base_url() . 'users/dashboard/certificates/' . $this->session->unit_id . '/';
			$config['per_page'] = 3;
			$config['uri_segment'] = 5;
			$config['first_url'] = base_url() . 'users/dashboard/certificates/' . $this->session->unit_id . '/';
			$config['total_rows'] = ($this->dashboard_model->get_all_documents($unit_id, "certificates"))?count($this->dashboard_model->get_all_documents($unit_id, "certificates")):0;
			$this->pagination->initialize($config);
			
			$start = $this->uri->segment(5, 0);
			$documents = $this->dashboard_model->index_limit_documents($unit_id, $config['per_page'], $start, "certificates");
			
			$data = array(
			'page' => 'certificates',
			'documents' => $documents,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
			);
			$header_data = array(
			"title" => "UNIT ELOCKER", "unit_id" => $unit_id
			);
			$this->load->view("users/requires/header", $header_data);
			$this->load->view("users/dashboard/elocker", $data);
			$this->load->view("users/requires/footer");
			}
			}
			
			function replyquery($unit_id) {
			if (!check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
			$this->session->sess_destroy();
			redirect(base_url());
			} else {
			$this->dashboard_model->replyquery($unit_id);
			}
			}
			
			function upload_mydocuments($unit_id) {
			if (!check_if_unit_belong_to_caf($unit_id, $this->session->caf_id)) {
			$this->session->sess_destroy();
			redirect(base_url());
			} else {
			$this->dashboard_model->upload_mydocuments($unit_id);
			}
			}
			
			}
						