<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Uploadfilestoaws extends Eodb {
	
    public function index() {
        $this->load->library("form_validation");
        //$this->load->library("s3_upload");

        $this->load->view("site/uploadtest_view");
    }
    public function upload_file() {
		
		$this->load->helper("fileuploadnew");
			
		$file = fileUpload("fileToUpload");
		
		
		
		//echo "<br/><br/><br/>Details : <pre>";
		//print_r($files);die();
        $source_path = 'storage/temps/'.$file;
		
        $dest_path = 'ADMIN_LOCKER' . '/' . date("Y") . '/' . date("m") . '/' . date("d") . '/';
	
		$this->load->library("s3_upload");
		$uploades = $this->s3_upload->upload_file($source_path,$dest_path);
							
		//$uploades = moveFileToAWS(1,$files["file_name"]);
		
		//echo $uploades;
		
		//$file_url = $this->s3_upload->upload_file($sample_file);
		
        //$this->load->view("site/uploadtest_view");
    }
	public function get_file() {
		//http://192.168.88.229/eodbci/site/uploadtest/get_file_test?filepath=ADMIN_LOCKER/2019/01/21/83748a2bd5fa0e0187443300dca65e6e.pdf
		$filepath = $this->input->get("filepath");
		//die($filepath);
		$this->load->library("s3_upload");
		$get_file = $this->s3_upload->getObjectFile($filepath);
	}
	
}
?>