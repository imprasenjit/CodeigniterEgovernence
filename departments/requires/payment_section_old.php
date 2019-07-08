<?php
require_once "login_session.php";
$ci->load->helper('get_uain_details');
$get_file_name = basename(__FILE__);
$css = "";
$applicant_id = $user_id;

$reg_fees = 25000000;

if (isset($_POST["edit_form"])) {
    if (isset($_SESSION["dept"]) || isset($_SESSION["form"]) || $_SESSION["dept"] != "" || $_SESSION["form"] != "") {
        $dept = $_SESSION["dept"];
        $form = $_SESSION["form"];
        $table_name = getTableName($dept, $form);
    } else {
        echo "<script>
				alert('Something went wrong !!! Please try again');
				window.location.href = '" . $server_url . "user_area/';
		</script>";
    }
    $uain = $_POST["uain"];
    $update_form_table_query = "update " . $table_name . " set save_mode='D',sub_date='$today',uain=NULL where user_id='$swr_id' and uain='$uain' and save_mode='P' and active='1'";
    $save_query = $formFunctions->executeQuery($dept, $update_form_table_query);
    if ($save_query) {
        echo "<script>window.location.href = '" . $server_url . "user_area/incomplete_applications.php';</script>";
    } else {
        echo "<script>alert('Something went wrong !!!');window.location.href = 'payment_section.php?dept=" . $dept . "&form=" . $form . "';</script>";
    }
}

if (isset($_POST["submit_payment"])) {
    if (isset($_SESSION["dept"]) || isset($_SESSION["form"]) || $_SESSION["dept"] != "" || $_SESSION["form"] != "") {
        $dept = $_SESSION["dept"];
        $form = $_SESSION["form"];
        $table_name = getTableName($dept, $form);
    } else {
        echo "<script>
				alert('Something went wrong !!! Please try again');
				window.location.href = '" . $server_url . "user_area/';
		</script>";
    }

    if ($_POST["payment_mode"] == 1) {
        /* if($dept=="pcb"){
          if($form==51 || $form==52){
          echo "<script>
          alert('Go to the online payment section and please do not click on the back button or do not refresh the web page.');
          window.location.href = 'form_payment_billdesk.php?dept=".$dept."&form=".$form."';
          </script>";
          }else{
          echo "<script>
          alert('Go to the online payment section and please do not click on the back button or do not refresh the web page.');
          window.location.href = '../".$dept."/forms/form_payment.php?token=".$form."';
          </script>";
          }
          } */
        if ($dept == "pcb" || $dept == "gmc" || $dept == "power" || $dept == "dic" || $dept == "water") {
            echo "<script>
				alert('Go to the online payment section and please do not click on the back button or do not refresh the web page.');
				window.location.href = 'form_payment_billdesk.php?dept=" . $dept . "&form=" . $form . "';
			</script>";
        } else {
            echo "<script>
				alert('Go to the online payment section and please do not click on the back button or do not refresh the web page.');
				window.location.href = 'form_payment_treasury.php?dept=" . $dept . "&form=" . $form . "';
			</script>";
        }
    } else if ($_POST["payment_mode"] == 0) {
        if (empty($_POST["offline_challan"]) || $_POST["offline_challan"] == '2' || $_POST["offline_challan"] == '3') {
            echo "<script>
				alert('Error in file / You did not upload any file.');
				window.location.href = 'payment_section.php?dept=" . $dept . "&form=" . $form . "';
			</script>";
        } else {
            $check_query = "select uain,form_id from " . $table_name . " where user_id='$swr_id' and save_mode='P' and active='1'";
            $query = $formFunctions->executeQuery($dept, $check_query);
            if ($query->num_rows == 0) {
                echo "<script>
					alert('Something went wrong !!!.');
					window.location.href = 'payment_section.php?dept=" . $dept . "&form=" . $form . "';
				</script>";
            }
            $row = $query->fetch_array();
            $form_id = $row["form_id"];
            $uain = $row["uain"];
            $offline_challan = clean($_POST["offline_challan"]);

            $payment_mode = clean($_POST["payment_mode"]);
            $txn_date = clean($_POST["txn_date"]);
            $txn_date = date("Y-m-d", strtotime($txn_date));
            $bank_name = clean($_POST["bank_name"]);
            $ref_no = clean($_POST["ref_no"]);
            $reg_fees = clean($_POST["reg_fees"]);

            //$formFunctions->file_update($offline_challan);
            $update_result = $formFunctions->insert_offline_payment_details($dept, $uain, $reg_fees, $ref_no, $txn_date, $bank_name, "A");
            if ($update_result == 1) {

                $update_form_table_query = "update " . $table_name . " set offline_challan='$offline_challan',payment_mode='$payment_mode',sub_date='$today' where form_id='$form_id'";
                $save_query = $formFunctions->executeQuery($dept, $update_form_table_query);
                if ($save_query) {
                    $_SESSION["form_id"] = $form_id;
                    echo "<script>window.location.href = '" . $server_url . "departments/requires/final_submit.php';</script>";
                } else {
                    echo "<script>alert('Something went wrong !!!');window.location.href = 'payment_section.php?dept=" . $dept . "&form=" . $form . "';</script>";
                }
            } else {
                echo "<script>alert('Something went wrong !!!');window.location.href = 'payment_section.php?dept=" . $dept . "&form=" . $form . "';</script>";
            }
        }
    }
}


if (isset($_GET["form"]) && is_numeric($_GET["form"]) && $_GET["form"] > 0 && isset($_GET["dept"]) && strlen($_GET["dept"]) > 0 && !preg_match('/[^A-Za-z]/', $_GET["dept"])) {

    $_SESSION["dept"] = $dept = $_GET["dept"];
    $_SESSION["form"] = $form = $_GET["form"];
    $table_name = getTableName($dept, $form);
    $reg_fees = 0;
   
    require_once "check_form_save_mode.php";

    $check_query = "select uain,form_id from " . $table_name . " where user_id='$swr_id' and save_mode='P' and active='1'";
    $query = $formFunctions->executeQuery($dept, $check_query);
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $form_id = $row["form_id"];
        $uain = $row["uain"];
    } else {
        echo "<script>
			alert('Something went wrong !!!.');
			window.location.href = 'payment_section.php?dept=" . $dept . "&form=" . $form . "';
		</script>";
    }



    $sub_dept_id = $formFunctions->get_sub_dept_id($dept);
    $approval_details = $formFunctions->executeQuery("cms","select id,paycode from list_of_approvals where form_no='$form' and sub_dept='$sub_dept_id'");

    if ($approval_details->num_rows > 0) {
        $approval_details_row = $approval_details->fetch_object();

        $approval_id = $approval_details_row->id;
        $paycode = $approval_details_row->paycode;

        if ($paycode == 0) {
            $offline_payment_details_query = $formFunctions->executeQuery("pcb", "select * from offline_payments where uain='$uain'");
            if ($offline_payment_details_query->num_rows > 0) {
                $offline_payment_details = $offline_payment_details_query->fetch_object()->details;
            } else {
                $offline_payment_details = "";
            }
        }

        $treasury_payment_details = $formFunctions->getPaymentDetails($approval_id);
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
            case "dic":
            case "labour": require_once "../" . $dept . "/forms/fees_calculation.php";
                break;
            case "tourism": $reg_fees = 10000;
                break;
            case "power": $reg_fees = 1500;
                break;
            case "gmc": $reg_fees = 100;
                break;
            case "ayush": $reg_fees = 1015;
                break;
            case "excise": $reg_fees = 10000;
                break;
            case "mines":
            case "dma": $reg_fees = 0;
                break;
            case "water": $reg_fees = 100;
                break;
            default : require_once "fees_calculation.php";
                break;
        }
    } else {
        echo "<script>
			alert('Something went wrong!!!');
			window.location.href = '" . $server_url . "departments/" . $dept . "/';
	</script>";
    }
} else {
    echo "<script>
			alert('Something went wrong!!!');
			window.location.href = '" . $server_url . "departments/" . $dept . "/';
	</script>";
}
?>
<?php require_once "header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
<?php require 'banner.php'; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-success">
                        <div class="panel-heading text-center text-bold text-uppercase">EODB - Payment</div>
                        <div class="panel-body">
                            <form name="myform1" id="" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                <div class="col-md-12" style="padding:10px 0 30px 0">
                                    <div class="row">
                                        <div class="col-md-6">											
                                            <label>Select your mode of payment for the application form.&nbsp; &nbsp;</label>	
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-inline">
<?php if ($dept == "pcpndt" || $dept == "health" || $dept == "dma" || $dept == "fcs") { ?>
                                                    <label class="radio-inline"><input type="radio" name="payment_mode" disabled title="Online payment option is deactivated since online treasury payment is not yet confirmed by the concerned department." value="1"> Online Payment</label> &nbsp; &nbsp;
                                                <?php } else { ?>
                                                    <label class="radio-inline"><input type="radio" name="payment_mode" value="1"> Online Payment</label>
                                                <?php } ?>

                                                <label class="radio-inline"><input type="radio" name="payment_mode" checked value="0"> Offline Payment</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="offlinePayDetials" style="padding:5px 0 30px 0;">
                                    <div class="row" style="padding-bottom:20px">
                                        <div class="col-md-6"><label><b><u>Challan Head/Demand Draft</u></b></label></div>
                                        <div class="col-md-6">
<?php
if (isset($offline_payment_details) && $offline_payment_details != "") {
    echo $offline_payment_details;
} else if ($dept == "labour" || $dept == "tourism") {
    $fetch_challan_head_query = "select * from offline_challan_head_details where form_no='$form'";
    $challan_head_results = $formFunctions->executeQuery($dept, $fetch_challan_head_query);
    echo $challan_head = $challan_head_results->fetch_object()->challan_head;
} else {
    echo $treasury_payment_details["Major_Head"] . " - " . $treasury_payment_details["Description"];
    if ($treasury_payment_details["Sub_Major_Head"] != "" && $treasury_payment_details["Sub_Major_Head"] != 0) {
        echo "<br/>" . $treasury_payment_details["Sub_Major_Head"] . " - " . $treasury_payment_details["Sub_Major_Head_Description"];
    }
    if ($treasury_payment_details["Minor_Head"] != "" && $treasury_payment_details["Minor_Head"] != 0) {
        echo "<br/>" . $treasury_payment_details["Minor_Head"] . " - " . $treasury_payment_details["Minor_Head_Description"];
    }
}
?>	
                                        </div>
                                    </div>

                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-6"><label>Amount (in Rs.): </label></div>
                                        <div class="col-md-6">
<?php if ($reg_fees == 0 || $dept == "cei") { ?>
                                                <input type="text" name="reg_fees" class="form-control text-uppercase" value="<?php echo $reg_fees; ?>"/>
                                            <?php } else { ?>
                                                <input type="text" name="reg_fees" class="form-control text-uppercase" readonly="readonly" value="<?php echo $reg_fees; ?>"/>
                                            <?php } ?>


                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-6"><label>Date : </label></div>
                                        <div class="col-md-6"><input type="date" class="dobindia form-control" name="txn_date" /></div>
                                    </div>
                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-6"><label>Bank Name : </label></div>
                                        <div class="col-md-6"><input type="text" class="form-control text-uppercase" name="bank_name"/></div>
                                    </div>
                                    <div class="row" style="padding-bottom:10px">
                                        <div class="col-md-6"><label>Treasury/Ref./DD No. : </label></div>
                                        <div class="col-md-6"><input type="text" class="form-control" name="ref_no" validate="OnlyNumbers"/></div>
                                    </div>
                                    <div class="uploadfieldtrick row" style="padding-bottom:10px">
                                        <div class="col-md-6"><b>Upload Treasury Challan/DD :</b></div>
                                        <div class="col-md-6">
											<a href="#!" class="btn btn-primary" id="upload_from_pc" data-td-id="file1">Upload From PC</a>
                                            <!--<input type="button" upload="file" class="file btn bg-aqua" id="file" value="Browse">-->
                                            <input type="hidden" name="offline_challan" value="" id="mfile1" readonly="readonly"/>
                                            <span id="tdfile1">No File Selected</span>
                                        </div>	
                                    </div>	
                                </div>	
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3 center" style="width:30%;">
                                        <button type="submit" style="font-weight:bold" name="submit_payment" class="btn btn-success btn-block submit1">Pay Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 pull-right">
                    <div class="panel panel-danger">
                        <div class="panel-heading">Please Note</div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data"> 
                                <input type="hidden" name="uain" value="<?php echo $uain; ?>">
                                <div class="form-inline">
                                    <p style="line-height:3">1. If you really want to view the application form <br/>then please <a href="preview.php?dept=<?php echo $dept; ?>&form=<?php echo $form; ?>" target="_blank" class="btn btn-warning btn-xs">click here</a>.</p>											
                                </div>
                                <div class="form-inline">
                                    <p style="line-height:3">2. If you really want to change or edit the application form again then please <button type="submit" onclick="return confirm('Are you sure ?')"  name="edit_form" class="btn btn-primary btn-xs">click here</button>.</p>											
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?= $server_url; ?>public/pekeupload/js/pekeUpload.js" ></script>
<div class="modal fade" tabindex="-1" role="dialog" id="upload_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Mydocuments</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success alert-dismissible" style="display: none" id="success_msg_query">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> <span id="info_msg_query"></span>
                </div>
                <div class="alert alert-danger alert-dismissible" style="display: none" id="error_msg_query">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> <span id="info_msg_query_error"></span>
                </div>
                <div id="loader-wrapper">
                    <div id="loader"></div>
                </div>
                <form id="upload_form" class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label">Name</label>  
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="name" name="name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-3 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="description" id="description" placeholder="Type your reply here"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="document" class="col-sm-3 control-label">Upload File: </label>
                        <div class="col-sm-9">
                            <input type="file" name="document" id="document" data-error="Please upload Address proof.">
                            <span class="filetype_Error"></span>
                        </div> 
                    </div> 
                </form>
                <script>
                                            $(document).ready(function () {
                                                $("#document").pekeUpload({
                                                    bootstrap: true,
                                                    url: "<?= $server_url; ?>upload/",
                                                    data: {file: "document"},
                                                    limit: 100,
                                                    allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
                                                });
                                            });

                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="upload_mydocuments" data-td-id="">Upload</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php require_once "../../views/users/requires/footer.php"; ?>
<?php require 'js.php' ?>
<script type="text/javascript">
    //Printing function

    $('#offlinePayDetials').show();
    $(document).ready(function () {

        $('input[name="payment_mode"]').on('change', function () {

            if ($(this).val() == 0) {
                $('#offlinePayDetials').show("fast");
                $('#txn_date').attr("required", "required");
                $('#txn_bank_name').attr("required", "required");
                $('#txn_number').attr("required", "required");
            } else {
                $('#offlinePayDetials').hide("slow");
                $('#txn_date').removeAttr("required", "required");
                $('#txn_bank_name').removeAttr("required", "required");
                $('#txn_number').removeAttr("required", "required");
            }
        });
    });
</script>
<script>
    <?php $unit_id=$CI->session->unit_id;?>
    $(document).ready(function () {
        $('#upload_mydocuments').click(function () {
            var data = $('#upload_form').serializeArray();
            var fileID = $(this).attr("data-td-id");
            //alert(tdfile);
           // var mfile = "#m" + fileID;
            $.ajax({
                url: "<?= $server_url."users/dashboard/upload_mydocuments/" . $unit_id . "";?>",
                method: "POST",
                data: data,
                dataType: "json",
                beforeSend: function () {
                    $('#loader-wrapper').fadeIn();
                },
                success: function (jsn) {
                    $('#loader-wrapper').hide();
                    console.log(jsn.success);
                    if (jsn.success === 1) {
                        $('#upload_form')[0].reset();
                        $('.pkrw').remove();
                        //alert(jsn.file);
                        var fleName = jsn.file;
                        var strArray = fleName.split("/");
                        var file_name = strArray.pop();

                        $('#m' + fileID + '').val(file_name);

                        $('#td' + fileID + '').html('<a href="' + jsn.file + '" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>');
                        $("#upload_modal").modal('hide');
                    } else {
                        $('#success_msg_query').hide();
                        $('#info_msg_query_error').empty().append("</br>" + jsn.info);
                        $('#error_msg_query').fadeIn();
                    }
                }
            });
        });
    });
</script>
