<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Notifications extends Eodb {
		function __construct() {
			parent::__construct();	
			$this->load->model("eodbfunctions/getDepartments_model");			
		    $this->load->model("eodbfunctions/getSubDepartment_model");

		}
		
		function index(){
			$this->load->model("site/notifications_model");
			
			$this->load->view("site/requires/header");
			$this->load->view("site/notifications/notifications");
			$this->load->view("site/requires/footer");
		}// End of index()
		
		function getNotifications(){
			$this->load->database();
			$this->load->model('site/notifications_model');			
			// init params
			$params = array();
			$limit_per_page = 10;
			//echo 'input1='.$this->input->post("dept");
			//echo '\n\ninput1='.$this->input->post("sub_dept");
			$start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$total_records = $this->notifications_model->getTotalNotifications();
			
			if ($total_records > 0) 
			{
				// get current page records
				$params["results"] = $this->notifications_model->get_current_page_records($limit_per_page, $start_index);
			}
			
			//$this->load->view(');
			$this->load->view("site/notifications/getNotifications",$params);
			$this->db->close();
		}//End of getNotifications()
		
		function searchNotifications(){
			$this->load->model('site/notifications_model');
			$this->load->view("site/notifications/searchNotifications");
			
			
			}//End of searchNotifications()
		
	}//End OF Notification Class
	
