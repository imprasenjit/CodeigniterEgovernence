<?php
$amount=100;
$challanNo = uniqid(rand(), true);
$nowTime=date("Y-m-d H:i:s");
$sub_dept = $forminfos->sub_dept;
$deptRow = $this->subdepartments_model->get_row($sub_dept);
$dept_name = ($deptRow)?$deptRow->name:"Not found";
$service_name = $forminfos->service_name;

$tin="TIN";

$paycode = $forminfos->paycode;
$treasuryRow = $this->payments_model->get_treasurypayinfo($paycode);
if($treasuryRow) {			
    $eodbDeptCode = $treasuryRow->Eodb_department_code;
    $treasuryDeptName = $treasuryRow->Department;			
    $treasuryDeptCode = $treasuryRow->Dept_Code;
    $treasuryPayCode = $treasuryRow->Pay_Code;
} else {
    $treasuryDeptName = $treasuryDeptCode = $treasuryPayCode = "NOTFOUND";
}//End of if else
$data = array(
    "uain" => "",
    "challan_no" => $challanNo,
    "txn_amnt" => $amount,
    "txn_mode" => NULL,
    "dept_code" => $eodbDeptCode,
    "office_id" => NULL,
    "txn_for" => NULL,
    "txn_time" => $nowTime,
    "txn_gateway" => 2
);
//$this->paymentrequest_model->add_row($data);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EODB ::  Payment Informations</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
    </head>
    <body>
        <div class="wrapper">
            <div class="content-wrapper">
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">Payment Informations</h3>
                    <div class="box-body">
                        <form id="payfrm" action="https://treasury.assam.gov.in/TreasuryEpay/EpayService" method="post">
                            <input type="hidden" name="code" value="14004">
                            <input type="hidden" name="userid" value="<?=$treasuryDeptName?>">
                            <input type="hidden" name="challanNo" value="<?=$challanNo?>">
                            <input type="hidden" name="deptName" value="<?=$treasuryDeptCode?>">
                            <input type="hidden" name="taxType" value="<?=$treasuryPayCode?>">
                            <input type="hidden" name="tin"   value="<?=$tin?>">
                            <input type="hidden" name="totAmt"   value="<?=$amount?>">
                            
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Department : </td>
                                        <td><?=$dept_name?></td>
                                    </tr>
                                    <tr>
                                        <td>Service : </td>
                                        <td><?=$service_name?></td>
                                    </tr>
                                    <tr>
                                        <td>Amount : </td>
                                        <td><?=sprintf("%0.2f", $amount)?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div><!--End of .box-body--> 
                </div><!--End of .box-->                    
            </div><!--End of .content-wrapper-->
        </div>
        <script type="text/javascript">
        $(document).ready(function () {
            //$("#payfrm").submit();
        });
        </script>
    </body>
</html>