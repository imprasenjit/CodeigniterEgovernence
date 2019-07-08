<?php
require_once "login_session.php";
$ci->load->helper('get_uain_details');
$get_file_name = "";
/* -----------------page access validation------------------------------ */
$respond_UAIN = "";
$responseMsg = "";
if (isset($_GET["form"]) && is_numeric($_GET["form"]) && $_GET["form"] > 0 && isset($_GET["dept"]) && strlen($_GET["dept"]) > 0 && !preg_match('/[^A-Za-z]/', $_GET["dept"])) {
    $dept = $_GET['dept'];
    $form = $_GET['form'];
} else if (isset($_GET['UAIN']) && isset($_GET['Status'])) {

    $respond_UAIN = $_GET['UAIN'];
    $responseMsg = $_GET['Status'];
    $form = $formFunctions->get_uainForm($respond_UAIN);
    $dept = $formFunctions->get_uainDept($respond_UAIN);
} else {
    echo "<script type='text/javascript'>alert('Invalid page access !');window.location.href='index.php';</script>";
    exit();
}
$table_name = getTableName($dept, $form);
$_SESSION["dept"] = $dept;
$_SESSION["form"] = $form;

$_SESSION["table_name"] = $table_name;

$reg_fees = 0;
$form_id = "";
$uain = "";
$save_mode = "P";

switch ($dept) {
    case "pcb":
    case "boiler":
    case "factory":
    case "cei":
    case "doa":
    case "pwd":
    case "deedu":
    case "dhedu":
    case "dsedu":
    case "health":
    case "pcpndt":
    case "society":
    case "labour": require_once "../" . $dept . "/forms/fees_calculation.php";
        break;
    case "tourism": $reg_fees = 10000;
        break;
    case "power": $reg_fees = 1500;
        break;
    case "ayush": $reg_fees = 1015;
        break;
    case "excise": $reg_fees = 10000;
        break;
    default : require_once "fees_calculation.php";
        break;
}




if ($swr_id == 800 || $swr_id == 817 || $swr_id == 3) {
    $reg_fees = 1;
}

$sub_dept_id = $formFunctions->executeQuery("dicc", "select id from SubDepartment where dept_code='$dept'")->fetch_object()->id;
$FormID = $formFunctions->executeQuery("cms", "select id from list_of_approvals where form_no='$form' and sub_dept='$sub_dept_id'")->fetch_object()->id;

$fetch_query = "select form_id,uain,save_mode from " . $table_name . " where user_id='$swr_id' and active='1' and save_mode='P'";

$sql = $formFunctions->executeQuery($dept, $fetch_query);
$row = $sql->fetch_assoc();
if ($sql->num_rows > 0) {
    $form_id = $row['form_id'];
    $uain = $row['uain'];
    $save_mode = $row['save_mode'];

    $query = "select b.TxnStatus,b.challanNo,b.applicationno,b.BankID,b.tin,b.totAmt,b.TxnDate from pre_treasury_request a, treasury_response b where a.UAIN='$uain' and a.PaymentStatus='1' and b.applicationno=a.ChallanNo and a.PaymentType='A'";
    $results = $formFunctions->executeQuery("dicc", $query);
    if ($results->num_rows > 0 && $responseMsg == "") {
        echo "<script type='text/javascript'>window.location.href='../../pay.php?uain=" . $uain . "&PaymentType=A';</script>";
        exit();
    }
}
//https://easeofdoingbusinessinassam.in/makepayment.php?transactionType=A&FormID=1&totAmt=1&tin=kkk/sss/ddd/444/332/4433/iirurur/ommjm
if ($uain == "") {
    echo "<script type='text/javascript'>alert('Invalid page access !');window.location.href='../../user_area/index.php';</script>";
    exit();
}
if ($save_mode == "C") {
    echo "<script type='text/javascript'>alert('Already Applied !');window.location.href='../../user_area/index.php';</script>";
    exit();
}
/* PGI Request to Treasury */
$ResponseUrl = $server_url . "departments/requires/form_payment_treasury.php";

if ($responseMsg != "" && $responseMsg == "S" && $respond_UAIN == $uain) {
    //print_r($responseMsg);
    require_once "form_payment_treasury_save.php";
    //die();
}
?>
<?php require_once "header.php"; ?>
<?php if ($responseMsg != "" && $responseMsg == "S") { ?>

    <?php if (isset($form) && !empty($form)) { ?>
        <META http-equiv="refresh" content="5;URL=acknowledgement.php?form=<?php echo $form; ?>&dept=<?php echo $dept; ?>" />
    <?php } ?>  
<?php } ?>  


<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <?php require 'banner.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center" >
                            <strong><?php echo $form_name = $formFunctions->get_formName($dept, $form); ?></strong>
                        </h4>	
                    </div>

                    <div class="matter">
                        <h3 class="text-center">Pay Online</h3>
                        <form method="GET" action="https://easeofdoingbusinessinassam.in/makepayment.php">
                        <!--<input type="hidden" value="<?php echo $msg; ?>" name="msg" />-->

                            <input type="hidden" value="A" name="transactionType" />
                            <input type="hidden" value="<?php echo $FormID; ?>" name="FormID" />
                            <input type="hidden" value="<?php echo $uain; ?>" name="tin" />
                            <input type="hidden" value="<?php echo $ResponseUrl; ?>" name="ResponseUrl" />




                            <table border="1" align="center" class="table table-bordered table-responsive" width="50%">
                                <?php if ($responseMsg != "" && $responseMsg == "S") { ?>
                                    <tr>
                                        <td colspan="4" align="center">
                                            <p>Your Payment was successful !</p>
                                            <p>Now, We are redirecting you to the acknowledgement page within 5 seconds...
                                                Please wait a moment !</p>
                                        </td>
                                    </tr>	
                                <?php } else { ?>
                                    <?php if ($responseMsg != "" && $responseMsg == "F") { ?>
                                        <tr>
                                            <td colspan="4" align="center">
                                                <p>Your Payment was rejected !</p>
                                            </td>
                                        </tr>	
                                    <?php } ?>
                                    <tr>
                                        <td colspan="4" align="center">
                                            UAIN : <?php echo $uain; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php if ($reg_fees == 0) { ?>
                                            <td colspan="4" align="center">
                                                <p class="text-center text-success">Please enter the fees you want to pay. For more information, contact concern department.</p>
                                                <div class="form-inline">
                                                    <label>

                                                        Application Fees :
                                                    </label>
                                                    <input type="text" name="totAmt" value="" required="required" class="form-control text-uppercase"/>
                                                </div>
                                            </td>
                                        <?php } else { ?>
                                        <input type="hidden" value="<?php echo $reg_fees; ?>" name="totAmt" />
                                        <td colspan="4" align="center">
                                            Application Fees : Rs. <?php echo $reg_fees; ?>.00
                                        </td>
                                    <?php } ?>
                                    </tr>
                                    <tr>
                                        <td colspan="4" align="center">
                                            <input type="submit" value="Pay Now" name="paynow" class="btn btn-md-3 btn-success" />
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
<?php require_once "../../views/users/requires/footer.php"; ?>
<?php require 'js.php' ?>
