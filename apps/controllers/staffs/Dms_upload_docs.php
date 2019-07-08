<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Dms_upload_docs extends Eodbs {
    function index() {
        $this->load->model("staffs/deptusers_model");
        $this->load->model("staffs/utypes_model");
        $this->load->view("staffs/dms_upload_docs_view");
    }//End of index()
  /* edited codes ranjit*/  
	    function fileUpload($file) {
        $pathname = FCPATH . 'storage/temps/';
        $destination = $pathname;
        $ci = & get_instance();
        $config['upload_path'] = $destination;
        $config['allowed_types'] = 'JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt';
        $config['max_size'] = 0;
        $config['encrypt_name'] = TRUE;
        $ci->load->library('dms_upload_docs', $config);
        if (!$ci->dms_upload_docs->do_upload($file)) {
            $error = array("success" => 0, "error" => $ci->upload->display_errors());
            echo json_encode($error);
        } else {
            $data = array("success" => 1, "name" => "upload_" . $file, "upload_data" => $ci->upload->data());
            if ($ci->session->userdata($file)) {
                $tempArray = $ci->session->userdata($file);
                array_push($tempArray, $data["upload_data"]["file_name"]);
                $ci->session->set_userdata($file, $tempArray);
            } else {
                $tempArray = array($data["upload_data"]["file_name"]);
                $ci->session->set_userdata($file, $tempArray);
            }
            echo json_encode($data);
			return $data["upload_data"]["file_name"];
        }
		
		
		if ( ! $this->dms_upload_docs->fileUpload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('dms_uploaded_docs_view', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('dms_upload_success', $data);
                }
        }

    
	
/* edited codes ranjit*/  
    function save() {
        $swr_id = $this->input->post("swr_id");
        $process_id = $this->input->post("process_id");
        $form_id = $this->input->post("form_id");
        $this->load->model("staffs/process_model");
        $data = array(
            "process_id" => $process_id,
            "form_id" => $form_id,
            "swr_id" => $swr_id
        );
        $this->process_model->edit_row($form_id, $data);
    }//End of save()
}//End of Editprofile