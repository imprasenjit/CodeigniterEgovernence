<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Misreports extends Eodbs {
    
    public $dept_code;
    
    function __construct() {
        parent::__construct();
        $this->dept_code = $this->session->staff_dept;
        $this->load->model("staffs/misreports_model");
        $this->load->model("staffs/offices_model");
    }//End of __construct()
            
    function index() {
        //$rows = $this->misreports_model->get_rows($this->dept_code);
        //echo "<pre>"; var_dump($rows); die();
        
        $this->load->view("staffs/misreports_view");
    }//End of index()
    
    function gettransaction() {
        $uain = $this->input->post("uain"); //die("uain : ".$uain);
        $onlinerow = $this->misreports_model->get_onlinerow($this->dept_code, $uain);
        $offlinerow = $this->misreports_model->get_offlinerow($this->dept_code, $uain);
        if($onlinerow) {
            $ChallanNo = "";//$onlinerow->ChallanNo;
            $TxnAmount = $onlinerow->TxnAmount;
            $applicationno = "";//$onlinerow->applicationno;
            $BankReferenceNo = $onlinerow->BankReferenceNo;
            $tin = "";//$onlinerow->tin;
            $TxnDate = $onlinerow->TxnDate;
            $TxnStatus = "";//$onlinerow->TxnStatus;
            $submitted_on = $onlinerow->submitted_on;
            $fee_type = "A";//$onlinerow->fee_type;
            $type = ($fee_type=="A")?"Application Fee":"Certificate Fee";
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Transaction Mode</th>
                        <th>Online</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>UAIN</td>
                        <td><?=$uain?></td>
                    </tr>
                    <tr>
                        <td>Date and Time</td>
                        <td><?=date("d-m-Y h:i A", strtotime($TxnDate))?></td>
                    </tr>
                    <tr>
                        <td>Challan No.</td>
                        <td><?=$ChallanNo?></td>
                    </tr>
                    <tr>
                        <td>Referrence No.</td>
                        <td><?=$BankReferenceNo?></td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td>Rs. <?=sprintf("%0.2f", $TxnAmount)?></td>
                    </tr>
                    <tr>
                        <td>Application No.</td>
                        <td><?=$applicationno?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?=$TxnStatus?></td>
                    </tr>
                    <tr>
                        <td>Fee Type</td>
                        <td><?=$type?></td>
                    </tr>
                </tbody>
            </table>
        <?php } else if($offlinerow) {
            $txn_amount = $offlinerow->txn_amount;
            $txn_ref_no = $offlinerow->txn_ref_no;
            $txn_date = $offlinerow->txn_date;
            $txn_amount = $offlinerow->txn_amount;
            $bank_name = $offlinerow->bank_name;
            $fee_type = $offlinerow->fee_type;
            $type = ($fee_type=="A")?"Application Fee":"Certificate Fee";
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Transaction Mode</th>
                        <th>Offline</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>UAIN</td>
                        <td><?=$uain?></td>
                    </tr>
                    <tr>
                        <td>Date and Time</td>
                        <td><?=date("d-m-Y h:i A", strtotime($txn_date))?></td>
                    </tr>
                    <tr>
                        <td>Referrence No.</td>
                        <td><?=$txn_ref_no?></td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td>Rs. <?=sprintf("%0.2f", $txn_amount)?></td>
                    </tr>
                    <tr>
                        <td>Bank Name</td>
                        <td><?=$bank_name?></td>
                    </tr>
                    <tr>
                        <td>Fee Type</td>
                        <td><?=$type?></td>
                    </tr>
                </tbody>
            </table>
        <?php } else {
            echo "UAIN does not matched!";
        }//End of if else
    }//End of gettransaction()
}//End of Misreports