<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Applicationform extends Eodbc {
    
    public $dept_code;
    public $frmtbl;
    public $form_id;
    public $frm_no;
    public $uain;
    public $swr_id;
    
    function __construct() {
        parent::__construct();
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
        $this->load->model("staffs/cafs_model");
        $this->load->model("staffs/queriedapplications_model");
    }//End of construct()
    
    function index($uainencoded=NULL) {
        $this->uain = decodeme($uainencoded);        
        $this->dept_code = uainexplode($this->uain, "dept_code");
        $this->form_id = uainexplode($this->uain, "form_id");        
        $this->frm_no = uainexplode($this->uain, "form_no"); //die($uain." : ".$this->frm_no);
        if($this->frm_no > 0) {
            $this->frmtbl = $this->dept_code."_form".$this->frm_no;
            $frmRow = $this->forms_model->get_uainrow($this->dept_code, $this->frmtbl, $this->uain);
            if($frmRow) {
                $this->swr_id = $frmRow->user_id;
                
                $this->load->view("cms/requires/header", array("title" => "Application form view"));
                $this->load->view("cms/applicationform_view");
                $this->load->view("cms/requires/footer");
            } else {
                die("UAIN not found!");
            }//End of if else
        } else {
            die("Form does not exist");
        }//End of if else
    }//End of index()
}//End of Applicationform