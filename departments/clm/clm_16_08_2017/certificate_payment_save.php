<?php
/*
-------common variable is $uian,$today
-------this page is commonly used in payment/pay.php also
*/
if(!empty($formName)){
	if($formName=="CTE"){
		$form=1;
	}else if($formName=="CTO"){
		$form=2;
	}else{
		$form=substr($formName,1);
	}
	$table_name=$formFunctions->getTableName("pcb",$form);
	$sql=$pcb->query("select form_id,user_id from ".$table_name." where uain='$uian'");
	
	if($sql->num_rows>0){
		$row=$sql->fetch_array();
		$form_id=$row['form_id'];
		$sid=$row['user_id'];
		#certificate check
		$is_paid="N";
		$sqltradeC=$pcb->query("select is_paid from ".$table_name."_certificates where form_id='$form_id'");
		$rowtradeC=$sqltradeC->fetch_array();
		if($sqltradeC->num_rows>0){
			$is_paid=$rowtradeC['is_paid'];
		}
		if($is_paid=="N"){
			$payment_insert=$pcb->query("INSERT INTO ".$table_name."_payment(form_id,CustomerID,TxnReferenceNo,BankReferenceNo,TxnAmount,BankID,BankMerchantID,TxnType,CurrencyName,TxnDate,AuthStatus,AdditionalInfo1,AdditionalInfo2,AdditionalInfo3,AdditionalInfo4,AdditionalInfo5,AdditionalInfo6,AdditionalInfo7,submitted_on) VALUES('$form_id','$CustomerID','$TxnReferenceNo','$BankReferenceNo','$TxnAmount','$BankID','$BankMerchantID','$TxnType','$CurrencyName','$TxnDate','$authStatus','$AdditionalInfo1','$AdditionalInfo2','$AdditionalInfo3','$AdditionalInfo4','$AdditionalInfo5','$AdditionalInfo6','$AdditionalInfo7','$submitted_on')") or die($mysqli->error);
			if($payment_insert){
				$save_query=$pcb->query("update ".$table_name."_certificates set is_paid='Y' where form_id='$form_id'") or die($pcb->error);
				$msgBody="Dear User, We have received your certificate fees reciept. Your certificate will be issued soon";
				/*----------------SEND MAIL-----------------*/
				$user_email=$mysqli->query("select email from users where id='$sid'")->fetch_object()->email;
				$dept_email="esgoa.pollution@gmail.com";
				$sub="Certificate fees is received";
				require_once "../../../mailsending/onlineMail.php";
				send_mail($email, $sub, $msgBody);
			}
		}	
	}
}
?>