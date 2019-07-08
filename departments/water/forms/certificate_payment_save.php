<?php
/*
-------common variable is $uian,$today
-------this page is commonly used in payment/pay.php also
*/
if($formName=="TRADE"){
	$sqltrade=$gmc->query("select form_id,user_id from trade_license where form_no='$uian'");
	$rowtrade=$sqltrade->fetch_array();
	if($sqltrade->num_rows>0){
		$form_id=$rowtrade['form_id'];
		$sid=$rowtrade['user_id'];
		#certificate check
		$is_paid="N";
		$sqltradeC=$gmc->query("select is_paid from trade_license_certificates where form_id='$form_id'");
		$rowtradeC=$sqltradeC->fetch_array();
		if($sqltradeC->num_rows>0){
			$is_paid=$rowtradeC['is_paid'];
		}
		if($is_paid=="N"){
			$payment_insert=$gmc->query("INSERT INTO trade_license_payment(form_id,CustomerID,TxnReferenceNo,BankReferenceNo,TxnAmount,BankID,BankMerchantID,TxnType,CurrencyName,TxnDate,AuthStatus,AdditionalInfo1,AdditionalInfo2,AdditionalInfo3,AdditionalInfo4,AdditionalInfo5,AdditionalInfo6,AdditionalInfo7,submitted_on) VALUES('$form_id','$CustomerID','$TxnReferenceNo','$BankReferenceNo','$TxnAmount','$BankID','$BankMerchantID','$TxnType','$CurrencyName','$TxnDate','$authStatus','$AdditionalInfo1','$AdditionalInfo2','$AdditionalInfo3','$AdditionalInfo4','$AdditionalInfo5','$AdditionalInfo6','$AdditionalInfo7','$submitted_on')") or die($mysqli->error);
			if($payment_insert){
				$save_query=$gmc->query("update trade_license_certificates set is_paid='Y' where form_id='$form_id'") or die($gmc->error);
				$msgBody="Dear User, We have received your trade licence fees reciept. Your certificate will be issued soon";
				/*----------------SEND MAIL-----------------*/
				$user_email=$mysqli->query("select email from users where id='$sid'")->fetch_object()->email;
				$dept_email="esgoa.gmc@gmail.com";
				$email=$user_email.",".$dept_email;
				$sub="Trade Licence fees reciept is received";
				require_once "../../../mailsending/onlineMail.php";
				send_mail($email, $sub, $msgBody);
			}
		}	
	}
}
?>