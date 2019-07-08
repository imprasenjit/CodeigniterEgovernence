<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Common extends Eodb {
    function __construct() {
        parent::__construct();
    }//End of __construct()

    function getSubdeptusingparentid() {
        $p_id = $this->input->get("parent_id");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $depts = $this->getSubDepartment_model->get($p_id);
        echo '<option value="">Select sub department.</option>';
        foreach ($depts as $rows) {
            echo '<option value="' . $rows['id'] . '">' . $rows['name'] . '</option>';
        }//End of foreach
    }//End of getSubdeptusingparentid()

    function getpaycodes() {
        $this->load->model("common_model");
        if (!empty($this->input->post("id"))) {
            $this->common_model->getpaymentcodes($this->input->post("id"));
        } else {
            $this->common_model->getpaymentcodes();
        }//End of if else
    }//End of getpaycodes
}
