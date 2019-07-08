<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Landbank extends Eodb {
		function __construct() {
			parent::__construct();	
			$this->load->model("eodbfunctions/getDepartments_model");			
		    $this->load->model("eodbfunctions/getSubDepartment_model");
		}
		
		function index(){
			$this->load->model("site/landbank_model");			
			$this->load->model("eodbfunctions/getDistrict_model");			
			$this->load->view("site/requires/header");
			$this->load->view("site/landbank/landbank");
			$this->load->view("site/requires/footer");
		}// End of index()
		
        function search(){
		$this->load->model("site/landbank_model");	
		$this->landbank_model->getLandDetails();
		}
		
	}//End OF Notification Class
	
