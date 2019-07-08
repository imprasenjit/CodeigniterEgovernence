<?php
require_once "../../requires/login_session.php";

$get_file_name="";
/*-----------------page access validation------------------------------*/

if(isset($_GET['token'])){
	$token=$_GET['token'];
}else if(isset($_GET['UAIN'])){
	$UAIN=$_GET['UAIN'];
	$token=$formFunctions->get_uainForm($UAIN);
}else{}


$form_id="";
$uain="";
$save_mode="P";
$dept="sdc";
$application_fees=100;
if(is_numeric($token)){
	$form=$token;
	if($swr_id==800 || $swr_id==817){
		$reg_fees=1;	
	}else{
		$reg_fees=$sdc->query("select fee from fees_schedule where form_no='$form'")->fetch_object()->fee;	
	}
	
	$sub_dept_id=$mysqli->query("select id from SubDepartment where dept_code='sdc'")->fetch_object()->id;	
	$FormID=$cms->query("select id from list_of_approvals where form_no='$form' and sub_dept='$sub_dept_id'")->fetch_object()->id;
		
	$check=$formFunctions->is_already_registered($dept,$form);
	if($check==1){
		echo "<script>
					alert('Already Registered');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=".$dept."';
			</script>";	
	}
	$formName=$formFunctions->get_sampleformName($dept,$form);
	$table_name=$formFunctions->getTableName($dept,$form);
	
	//$reg_fees=1500;
	
	$fetch_query="select form_id,uain,save_mode from ".$table_name." where user_id='$swr_id' and active='1'";
	
	$sql=$formFunctions->executeQuery($dept,$fetch_query);
	$row=$sql->fetch_array();
	if($sql->num_rows>0){
		$form_id=$row['form_id'];
		$uain=$row['uain'];
	
		$save_mode=$row['save_mode'];
		
	}
}
//https://easeofdoingbusinessinassam.in/makepayment.php?transactionType=A&FormID=1&totAmt=1&tin=kkk/sss/ddd/444/332/4433/iirurur/ommjm
if($uain==""){
	echo "<script type='text/javascript'>alert('Invalid page access !');window.location.href='index.php';</script>";exit();
}
if($save_mode=="C"){
	echo "<script type='text/javascript'>alert('Already Applied !');window.location.href='index.php';</script>";exit();
}
/*PGI Request to Treasury*/
$ResponseUrl=$server_url."departments/".$dept."/forms/form_payment.php";
/* $dept_name=$formFunctions->get_deptName($dept);
$industryName=$dept_name;
$financialYear=calculateFiscalYearForDate(date("Y/m/d"),"7/1","6/30");
$txDateTime=time();
$paymentDetails="";
$txremarks="";
$sentCustomerID=$uain."/A";

$dept_bank_code=$formFunctions->get_dept_bank_code($swr_id,$uain);
$newData="DOIACGOA|".$sentCustomerID."|NA|".$reg_fees.".00|NA|NA|NA|INR|NA|R|doiacgoa|NA|NA|F|".$industryName."|".$financialYear."|".$dept_bank_code."|".$txDateTime."|".$application_fees.".00|".$consent_fees.".00|".$dg_sets_fees.".00|".$returnUrl;
$checksum=hash_hmac('sha256',$newData,'EHaiRbheoy8p', false); 
$checksum=strtoupper($checksum);
$dataWithCheckSumValue=$newData."|".$checksum;
$msg=$dataWithCheckSumValue; */

/*Response from billdesk*/
$checksumValidation=false;
$authStatus=0;
$responseMsg=isset($_GET['Status'])?$_GET['Status']:"";
if($responseMsg!="" && $responseMsg=="S"){
	//print_r($responseMsg);
	require_once "form_payment_save.php";
	//die();
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PAYMENT | SDC</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../../user_area/includes/css.php';?>
	<style>
		/* Over writes AdminLTE form styles */
		p{text-align: justify;}
		.form-control text-uppercase:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control text-uppercase{
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #555;
			display: block;
			font-size: 14px;
			height: 34px;
			line-height: 1.42857;
			padding: 6px 12px;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
			width: 100%;
		}
	</style>
<?php if($responseMsg!="" && $responseMsg=="S"){ ?>

<?php if(isset($form) && !empty($form)){ ?>
<META http-equiv="refresh" content="5;URL=../../requires/acknowledgement.php?form=<?php echo $form; ?>&dept=sdc" />
<?php } ?>  
<?php } ?>  
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
	<div class="wrapper">
	  <?php require '../../../user_area/includes/header.php'; ?>
	  <?php require '../../../user_area/includes/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../includes/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center" >
									<strong><?php echo $form_name=$cms->query("select form_name from sdc_form_names where form_no='$form'")->fetch_object()->form_name; ?></strong>
								</h4>	
							</div>

		<div class="matter">
		<h3 class="text-center">Pay Online</h3>
				<form method="GET" action="https://easeofdoingbusinessinassam.in/makepayment.php">
				<!--<input type="hidden" value="<?php echo $msg; ?>" name="msg" />-->
				
				<input type="hidden" value="A" name="transactionType" />
				<input type="hidden" value="<?php echo $FormID; ?>" name="FormID" />
				<input type="hidden" value="<?php echo $reg_fees; ?>" name="totAmt" />
				<input type="hidden" value="<?php echo $uain; ?>" name="tin" />
				<input type="hidden" value="<?php echo $ResponseUrl; ?>" name="ResponseUrl" />
				
				
				
				
				<table border="1" align="center" class="table table-bordered table-responsive" width="50%">
					<?php if($responseMsg!="" && $responseMsg=="S"){ ?>
					<tr>
						<td colspan="4" align="center">
							<p>Your Payment was successful !</p>
							<p>Now, We are redirecting you to the acknowledgement page within 5 seconds...
							Please wait a moment !</p>
						</td>
					</tr>	
					<?php }else{ ?>
					<?php if($responseMsg!="" && $responseMsg=="F"){ ?>
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
						<td colspan="4" align="center">
							Application Fees : Rs. <?php echo $reg_fees; ?>.00
						</td>
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
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<?php
if(isset($sdc)){$sdc->close();}
if(isset($mysqli)){$mysqli->close();}
?>
</body>
</html>