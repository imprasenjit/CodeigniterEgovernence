<?php
/*
-------common variable is $uian,$today
-------this page is commonly used in payment/pay.php also
*/
if(!empty($formName)){
	
	if($formName=="TRADE") $form_no=1;
	else if($formName=="F2") $form_no=2;
	else if($formName=="F3") $form_no=3;
	else if($formName=="F4") $form_no=4;
	else if($formName=="F5") $form_no=5;
	else{
		echo "<script>
				alert('Something went wrong !! Please try again after some time.');
				window.location.href = 'certificate_payment.php?token=".$form_no."';
			</script>";
	}
	$form_name=$formFunctions->get_formName($dept,$form);
	$tableName=$formFunctions->getTableName("gmc",$form_no);
	$sqltrade=$gmc->query("select form_id,user_id from ".$tableName." where uain='$uian'");
	$rowtrade=$sqltrade->fetch_array();
	if($sqltrade->num_rows>0){
		$form_id=$rowtrade['form_id'];
		$sid=$rowtrade['user_id'];
		#certificate check
		$is_paid="N";
		$sqltradeC=$gmc->query("select is_paid from ".$tableName."_certificates where form_id='$form_id'");
		$rowtradeC=$sqltradeC->fetch_array();
		if($sqltradeC->num_rows>0){
			$is_paid=$rowtradeC['is_paid'];
		}
		if($is_paid=="N"){
			$payment_insert=$gmc->query("INSERT INTO ".$tableName."_payment(form_id,CustomerID,TxnReferenceNo,BankReferenceNo,TxnAmount,BankID,BankMerchantID,TxnType,CurrencyName,TxnDate,AuthStatus,AdditionalInfo1,AdditionalInfo2,AdditionalInfo3,AdditionalInfo4,AdditionalInfo5,AdditionalInfo6,AdditionalInfo7,submitted_on) VALUES('$form_id','$CustomerID','$TxnReferenceNo','$BankReferenceNo','$TxnAmount','$BankID','$BankMerchantID','$TxnType','$CurrencyName','$TxnDate','$authStatus','$AdditionalInfo1','$AdditionalInfo2','$AdditionalInfo3','$AdditionalInfo4','$AdditionalInfo5','$AdditionalInfo6','$AdditionalInfo7','$submitted_on')") or die($mysqli->error);
			if($payment_insert){
				$save_query=$gmc->query("update ".$tableName."_certificates set is_paid='Y' where form_id='$form_id'") or die($gmc->error);
				$msgBody="Dear User, We have received your approval fees of ".$form_name." . Your approval License/NOC will be issued soon";
				/*----------------SEND MAIL-----------------*/
				$user_email=$mysqli->query("select email from users where id='$sid'")->fetch_object()->email;
				$dept_email="esgoa.gmc@gmail.com";
				$email=$user_email.",".$dept_email;
				$sub="Approval fees of ".$form_name." is received";
				require_once "../../../mailsending/onlineMail.php";
				send_mail($email, $sub, $msgBody);
			}
		}	
	}
}
?>