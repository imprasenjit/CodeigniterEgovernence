<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Feedback extends Eodb {
		function __construct() {
			parent::__construct();
			$this->load->model("eodbfunctions/getDepartments_model");			
		    $this->load->model("eodbfunctions/getSubDepartment_model");
			
		}//End of constructor	
		
		function index(){
			$this->load->model("site/feedback_model");			
			$this->load->view("site/requires/header");	
			$this->load->view("site/feedback/feedback.php");	
			$this->load->view("site/requires/footer");	
		}//End of Index();
		
		function giveFeedback(){		
		$this->load->model("site/feedback_model");
		$this->feedback_model->storeFeedback();	
		}
		
		
		
		
		
	}
