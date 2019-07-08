<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Draftnotifications extends Eodb {
		function __construct() {
			parent::__construct();
			$this->load->model("eodbfunctions/getDepartments_model");			
		    $this->load->model("eodbfunctions/getSubDepartment_model");
			
		}//End of constructor	
		
		function index(){
			$this->load->model("site/draftNotifications_model");			
			$this->load->view("site/requires/header");	
			$this->load->view("site/draftnotifications/draftnotifications");
			$this->load->view("site/requires/footer");	
		}//End of Index();
		
		function getnotification(){
			$this->load->model("site/draftNotifications_model");
			$this->load->view("site/requires/header");	
			$this->load->view("site/draftnotifications/getnotification");
			$this->load->view("site/requires/footer");
		}//End of getnotification();
		
		function postlike()
		{
		$this->load->model("site/draftNotifications_model");
		$this->draftNotifications_model->likeThePost();
		}//End of postlike();
		
		function postcomment(){
		$this->load->model("site/draftNotifications_model");
		$bool=$this->draftNotifications_model->postComment();
		
		
		}
	}
