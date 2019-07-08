<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Statusreport extends Eodb {
		function __construct() {
			parent::__construct();
			$this->load->model("eodbfunctions/getDepartments_model");			
		    $this->load->model("eodbfunctions/getSubDepartment_model");
		}//End of constructor
		function index()
		{
		   
			$this->load->model("eodbfunctions/statusReport_model");
			$this->load->view("site/requires/header");	
			$this->load->view("site/statusreport/statusreport");
			$this->load->view("site/requires/footer");
		}//End of Index()
	}	