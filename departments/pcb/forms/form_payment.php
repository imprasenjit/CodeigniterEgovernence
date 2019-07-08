<?php
require_once "../../requires/login_session.php";
require_once "fees_calculation.php";
$get_file_name="";
/*-----------------page access validation------------------------------*/
$token=isset($_GET['token'])?$_GET['token']:"";
$form_id="";
$uain="";
$save_mode="P";
$dept="pcb";
$application_fees=100;
if(is_numeric($token)){
	$form=$token;
	
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
		$consent_fees=fees_calculation($uain);
		$dg_sets_fees=dg_set_fees_calculation($uain);			
		if($consent_fees==0 && $dg_sets_fees==0){
			echo "<script>
					alert('Please enter the total investment cost or DG Sets investment in the application form.');
					window.location.href = '".$server_url."user_area/';
			</script>";
			exit();
		}else{	
			$reg_fees=$application_fees+$consent_fees+$dg_sets_fees;	
		} 
	}
}
if($uain==""){
	echo "<script type='text/javascript'>alert('Invalid page access !');window.location.href='index.php';</script>";exit();
}
if($save_mode=="C"){
	echo "<script type='text/javascript'>alert('Already Applied !');window.location.href='index.php';</script>";exit();
}
/*PGI Request to billdesk*/
$returnUrl=$server_url."departments/".$dept."/forms/form_payment.php?token=".$token;
$dept_name=$formFunctions->get_deptName($dept);
$industryName=$dept_name;
$financialYear=calculateFiscalYearForDate(date("Y/m/d"),"7/1","6/30");
$txDateTime=time();
$paymentDetails="";
$txremarks="";
$sentCustomerID=$uain."/A";
/* if($sid==18){
	$reg_fees=1;
} */
$dept_bank_code=$formFunctions->get_dept_bank_code($swr_id,$uain);
$newData="DOIACGOA|".$sentCustomerID."|NA|".$reg_fees.".00|NA|NA|NA|INR|NA|R|doiacgoa|NA|NA|F|".$industryName."|".$financialYear."|".$dept_bank_code."|".$txDateTime."|".$application_fees.".00|".$consent_fees.".00|".$dg_sets_fees.".00|".$returnUrl;
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
	require_once "form_payment_save.php";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PAYMENT | PCBA</title>
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
<?php if($formName=="CTE"){ ?>
<META http-equiv="refresh" content="5;URL=../../requires/acknowledgement.php?form=1&dept=pcb" />
<?php } ?> 
<?php if($formName=="CTO"){ ?>
<META http-equiv="refresh" content="5;URL=../../requires/acknowledgement.php?form=2&dept=pcb" />
<?php } ?>
<?php if(isset($formName) && !empty($formName)){ 
$form=substr($formName,1);?>
<META http-equiv="refresh" content="5;URL=../../requires/acknowledgement.php?form=<?php echo $form; ?>&dept=pcb" />
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
									<strong><?php echo $form_name=$cms->query("select form_name from pcb_form_names where form_no='$form'")->fetch_object()->form_name; ?></strong>
								</h4>	
							</div>

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
							Consent and Application Fees : Rs. <?php echo $reg_fees; ?>.00
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
if(isset($pcb)){$pcb->close();}
if(isset($mysqli)){$mysqli->close();}
?>
</body>
</html>