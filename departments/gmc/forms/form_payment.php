<?php
require_once "../../requires/login_session.php"; 
/*-----------------page access validation------------------------------*/
$token=isset($_GET['token'])?$_GET['token']:"";
$form_id="";
$uain="";
$save_mode="D";
if($token=="trade" || $token=="1"){
	$check=$formFunctions->is_already_registered('gmc','1');
	if($check==1){
		echo "<script>
					alert('Successfully Submitted');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=gmc';
			</script>";	
	}
	$form_name="APPLICATION FOR TRADE LICENSE";
	$sql=$gmc->query("select form_id,uain,save_mode from gmc_form1 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){
		$form_id=$row['form_id'];
		$uain=$row['uain'];
		$save_mode=$row['save_mode'];
	}
}else if($token=="2"){
	$check=$formFunctions->is_already_registered('gmc','2');
	if($check==1){
		echo "<script>
					alert('Successfully Submitted');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=gmc';
			</script>";	
	}
	$form_name="APPLICATION FOR INDUSTRIAL TRADE LICENSE";
	$sql=$gmc->query("select form_id,uain,save_mode from gmc_form2 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){
		$form_id=$row['form_id'];
		$uain=$row['uain'];
		$save_mode=$row['save_mode'];
	}
}else if($token=="3"){
	$check=$formFunctions->is_already_registered('gmc','3');
	if($check==1){
		echo "<script>
					alert('Successfully Submitted');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=gmc';
			</script>";	
	}
	$form_name="APPLICATION FOR HEALTH LICENSE";
	$sql=$gmc->query("select form_id,uain,save_mode from gmc_form3 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){
		$form_id=$row['form_id'];
		$uain=$row['uain'];
		$save_mode=$row['save_mode'];
	}
}else if($token=="4"){
	$check=$formFunctions->is_already_registered('gmc','4');
	if($check==1){
		echo "<script>
					alert('Successfully Submitted');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=gmc';
			</script>";	
	}
	$form_name="APPLICATION FOR VETERINARY LICENSE";
	$sql=$gmc->query("select form_id,uain,save_mode from gmc_form4 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){
		$form_id=$row['form_id'];
		$uain=$row['uain'];
		$save_mode=$row['save_mode'];
	}
}else if($token=="5"){
	$check=$formFunctions->is_already_registered('gmc','5');
	if($check==1){
		echo "<script>
					alert('Successfully Submitted');
					window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=5&dept=gmc';
			</script>";	
	}
	$form_name="APPLICATION FOR INDUSTRIAL TRADE LICENSE";
	$sql=$gmc->query("select form_id,uain,save_mode from gmc_form5 where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){
		$form_id=$row['form_id'];
		$uain=$row['uain'];
		$save_mode=$row['save_mode'];
	}
}else{
	echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$server_url."user_area/';
	</script>";
}
if($uain==""){
	echo "<script type='text/javascript'>alert('Invalid page access !');window.location.href='../index.php';</script>";exit();
}
if($save_mode=="C"){
	echo "<script type='text/javascript'>alert('Already Applied !');window.location.href='trade_license_acknow.php';</script>";exit();
}
/*PGI Request to billdesk*/
$returnUrl=$server_url."departments/gmc/forms/form_payment.php?token=".$token;
$industryName="Guwahati Municipal Corporation";
$financialYear=calculateFiscalYearForDate(date("Y/m/d"),"7/1","6/30");
$txDateTime=time();
$paymentDetails="";
$txremarks="";
$sentCustomerID=$uain."/A";
if($sid==18){
$newData="DOIACGOA|".$sentCustomerID."|NA|1.00|NA|NA|NA|INR|NA|R|doiacgoa|NA|NA|F|".$industryName."|".$financialYear."|GMC001|".$txDateTime."|".$form_name."|NA|NA|".$returnUrl;
}else{
$newData="DOIACGOA|".$sentCustomerID."|NA|100.00|NA|NA|NA|INR|NA|R|doiacgoa|NA|NA|F|".$industryName."|".$financialYear."|GMC001|".$txDateTime."|".$form_name."|NA|NA|".$returnUrl;
}
$checksum=hash_hmac('sha256',$newData,'EHaiRbheoy8p', false); 
$checksum=strtoupper($checksum);
$dataWithCheckSumValue=$newData."|".$checksum;
$msg=$dataWithCheckSumValue;
/*Response from billdesk*/
$checksumValidation=false;
$authStatus=0;
$responseMsg=isset($_POST['msg'])?$_POST['msg']:"";
if($responseMsg!=""){
	$responseMsgArray=explode("|",$responseMsg);
	###echo '<pre>';print_r($responseMsgArray);die();
	$CustomerID=$responseMsgArray[1];
	$TxnReferenceNo=$responseMsgArray[2];
	$BankReferenceNo=$responseMsgArray[3];
	$TxnAmount=$responseMsgArray[4];
	$BankID=$responseMsgArray[5];
	$BankMerchantID=$responseMsgArray[6];
	$TxnType=$responseMsgArray[7];
	$CurrencyName=$responseMsgArray[8];
	$TxnDate=$responseMsgArray[13];
	$authStatus=$responseMsgArray[14]; /*0300=success*/
	$AdditionalInfo1=$responseMsgArray[16];
	$AdditionalInfo2=$responseMsgArray[17];
	$AdditionalInfo3=$responseMsgArray[18];
	$AdditionalInfo4=$responseMsgArray[19];
	$AdditionalInfo5=$responseMsgArray[20];
	$AdditionalInfo6=$responseMsgArray[21];
	$AdditionalInfo7=$responseMsgArray[22];
	$submitted_on=$today;
	$responseChecksum=array_pop($responseMsgArray);
	$responseOrginalString=implode("|",$responseMsgArray);
	$responseCalcChecksum=hash_hmac('sha256',$responseOrginalString,'EHaiRbheoy8p', false); 
	$responseCalcChecksum=strtoupper($responseCalcChecksum);
	if($responseChecksum==$responseCalcChecksum){
		$checksumValidation=true;
	}
}

if($checksumValidation==true && $authStatus=="0300"){
	$CustomerIDArray=explode("/",$CustomerID);
	$formName=isset($CustomerIDArray[1])?$CustomerIDArray[1]:"";
	###echo '<pre>';print_r($CustomerIDArray);die();
	require_once "form_payment_save.php";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PAYMENT | GMC</title>
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
<?php if($checksumValidation==true && $authStatus=="0300"){ ?>
<?php if($formName=="TRADE"){ ?>
<META http-equiv="refresh" content="5;URL=../requires/acknowledgement.php?form=1&dept=gmc" />
<?php }
	if($formName=="F2"){ ?>
<META http-equiv="refresh" content="5;URL=../requires/acknowledgement.php?form=2&dept=gmc" />
<?php } 
	if($formName=="F3"){ ?>
<META http-equiv="refresh" content="5;URL=../requires/acknowledgement.php?form=3&dept=gmc" />
<?php } 
	if($formName=="F4"){ ?>
<META http-equiv="refresh" content="5;URL=../requires/acknowledgement.php?form=4&dept=gmc" />
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
									<strong><?php echo $form_name; ?></strong>
								</h4>	
							</div>

		<div class="matter">
		<div class="matter">
		<h3 class="text-center">Pay Online</h3>
				<form method="post" action="https://pgi.billdesk.com/pgidsk/PGIMerchantPayment">
				<input type="hidden" value="<?php echo $msg; ?>" name="msg" />
				<table border="1" align="center" class="table table-bordered table-responsive" width="50%">
					<?php if($checksumValidation==true && $authStatus=="0300"){ ?>
					<tr>
						<td colspan="4" align="center">
							<p>Your Payment was successful !</p>
							<p>Now, We are redirecting you to the acknowledgement page within 5 seconds...
							Please wait a moment !</p>
						</td>
					</tr>	
					<?php }else{ ?>
					<?php if($checksumValidation==true && $authStatus!="0300"){ ?>
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
							Application Fees : Rs. 100.00
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
				</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<?php
if(isset($gmc)){$gmc->close();}
if(isset($mysqli)){$mysqli->close();}
?>
</body>
</html>