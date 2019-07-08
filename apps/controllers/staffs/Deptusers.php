<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Deptusers extends Eodbs {
    function __construct() {
        parent::__construct();
        $this->load->model("staffs/deptusers_model");
    }
    
    function index() {        
        $this->load->model("staffs/utypes_model");
        $this->load->model("staffs/offices_model");
        $this->load->helper("userrights");
        $this->load->view("staffs/myprofile_view");
    }//End of index()
    
    function getofficerows() {
        $dept_code = $this->session->staff_dept;
        $office_id = $this->input->post("office_id");
        $officeRows = $this->deptusers_model->get_officerows($dept_code, $office_id);
        if ($officeRows) {?>            
            <select name="dept_user_id" id="dept_user_id" class="form-control">
                <option value="">Select A Staff/Officer </option>
                <?php 
                    foreach($officeRows as $rows) { ?>
                        <option value="<?= $rows->user_id; ?>" >
                            <?= $rows->user_name; ?>
                        </option>
                    <?php } ?>
            </select><?php
        } else {
            echo "<select name='office_id' class='form-control'><option value=''>No records found</option></select>";
        }//End of if else
    } //End of getofficerows()
}//End of Deptusers