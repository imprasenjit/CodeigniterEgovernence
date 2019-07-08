<?php
require_once "../../requires/login_session.php"; 
/*-----------------page access validation------------------------------*/
$token=isset($_GET['token'])?$_GET['token']:"";
$form_id="";
$uian="";
$is_paid="N";
if($token!=""){
	if($token=="trade"){
		$form=1;
	}else{
		$form=$token;
	}
	$formName=$formFunctions->get_formName("gmc",$form);
	$sql=$gmc->query("select form_id,uain from gmc_form".$form." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows>0){
		$form_id=$row['form_id'];
		$uian=$row['uain'];
		#certificate check
		$sqlC=$gmc->query("select total_fees,is_paid from gmc_form".$form."_certificates where form_id='$form_id'") or die("Error : ".$gmc->error);
		$rowC=$sqlC->fetch_array();
		if($sqlC->num_rows>0){
			$fees=$rowC['total_fees'];
			$certificate_fees = number_format($fees, 2, '.', '');
			$is_paid=$rowC['is_paid'];
		}
	}
}
if($uian=="" || $is_paid=="Y" || $certificate_fees==""){
	echo "<script type='text/javascript'>alert('Invalid page access !');
	window.location.href='../../../user_area/index.php';</script>";exit();
}
/*PGI Request to billdesk*/
$returnUrl=$server_url."gmc/certificate_payment.php?token=".$token;
$industryName="Guwahati Municipal Corporation";
$financialYear=calculateFiscalYearForDate(date("Y/m/d"),"7/1","6/30");
$txDateTime=time();
$paymentDetails="";
$txremarks="";
$sentCustomerID=$uian."/C";
$newData="DOIACGOA|".$sentCustomerID."|NA|".$certificate_fees."|NA|NA|NA|INR|NA|R|doiacgoa|NA|NA|F|".$industryName."|".$financialYear."|GMC001|".$txDateTime."|".$formName."|NA|NA|".$returnUrl;
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
	##echo '<pre>';print_r($CustomerIDArray);die();
	require_once "certificate_payment_save.php";	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
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
<META http-equiv="refresh" content="5;URL=../../../user_area/my_applications.php" />
<?php }
	if($formName=="F2"){ ?>
<META http-equiv="refresh" content="5;URL=../../../user_area/my_applications.php" />
<?php } 
	if($formName=="F3"){ ?>
<META http-equiv="refresh" content="5;URL=../../../user_area/my_applications.php" />
<?php } 
	if($formName=="F4"){ ?>
<META http-equiv="refresh" content="5;URL=../../../user_area/my_applications.php" />
<?php } 
	if($formName=="F5"){ ?>
<META http-equiv="refresh" content="5;URL=../../../user_area/my_applications.php" />
<?php } ?> 
<?php } ?>
</head> 
<body>
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
								<h4 class="text-center text-bold" >
									<?php echo $form_name=$cms->query("select form_name from gmc_form_names where form_no='1'")->fetch_object()->form_name; ?>
								</h4>	
							</div>
							<div class="text-center alert alert-warning" role="alert"><h4 style="color: #230C0F"><strong>Certificate Fee Payment</strong></h4></div>
							<form method="post" action="https://pgi.billdesk.com/pgidsk/PGIMerchantPayment">
							<input type="hidden" value="<?php echo $msg; ?>" name="msg" />
							<table border="0" align="center">
								<tr>
									<td colspan="4">							
									</td>
								</tr>
								<?php if($checksumValidation==true && $authStatus=="0300"){ ?>
								<tr>
									<td width="250" colspan="4" align="center">
										<p>Your Payment was successfull !</p>
										<p>Now, We are redirecting you to the acknowledgement page within 5 seconds...
										Please wait a moment !</p>
									</td>
								</tr>	
								<?php }else{ ?>
								<?php if($checksumValidation==true && $authStatus!="0300"){ ?>
								<tr>
									<td width="250" colspan="4" align="center">
										<p>Your Payment was rejected !</p>
									</td>
								</tr>	
								<?php } ?>
								<tr>
									<td width="250" colspan="4" align="center">
										<h4>Amount : Rs. <?php echo $certificate_fees; ?></h4>
									</td>
								</tr>
								<tr>
									<td colspan="4"></td>
								</tr>
								</br>
								<tr>
									<td width="250" colspan="4" align="center">
										<input type="submit" class="btn btn-success" value="Pay Now" name="paynow" />
									</td>
								</tr>
								<?php } ?>
							</table>
							</form>
							<section class="content-header"></section>
					</div>
				</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
</body>
</html>
<?php
if(isset($gmc)){
	$gmc->close();
}
if(isset($mysqli)){
	$mysqli->close();
}
?>