<?php
/*
-------common variable is $uain,$today
-------this page is commonly used in payment/pay.php also
*/
if(!empty($token)){
	$table_name=$formFunctions->getTableName("sdc",$form);
	if($save_mode=="P"){
		//$payment_insert=$sdc->query("INSERT INTO ".$table_name."_payment(form_id,CustomerID,TxnReferenceNo,			BankReferenceNo,TxnAmount,BankID,BankMerchantID,TxnType,CurrencyName,TxnDate,AuthStatus,AdditionalInfo1,AdditionalInfo2,			AdditionalInfo3,AdditionalInfo4,AdditionalInfo5,AdditionalInfo6,AdditionalInfo7,submitted_on) VALUES('$form_id','$CustomerID','$TxnReferenceNo','$BankReferenceNo','$TxnAmount','$BankID','$BankMerchantID','$TxnType','$CurrencyName','$TxnDate','$authStatus','$AdditionalInfo1','$AdditionalInfo2','$AdditionalInfo3','$AdditionalInfo4','$AdditionalInfo5','$AdditionalInfo6','$AdditionalInfo7','$submitted_on')") or die($sdc->error);
	
		$check_treasury_payment=$mysqli->query("select PaymentStatus from pre_treasury_request where UAIN='$uain' and PaymentType='A' ORDER BY id DESC LIMIT 1");
		if($check_treasury_payment->num_rows>0){
			$PaymentStatus=$check_treasury_payment->fetch_object()->PaymentStatus;
			if($PaymentStatus==1){
				$save_query=$sdc->query("update ".$table_name." set save_mode='C',payment_mode='1',sub_date='$today' where form_id='$form_id' and user_id='$swr_id'") or die($sdc->error);
					
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/*----------------SEND MAIL-----------------*/
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.sdc@gmail.com";
				require_once "sdc_form".$form."_print.php"; 
				
				
				$mypdf=uniqid(rand()).".pdf";
				/*---------mpdf logic-----------*/
				require_once "../../../mpdf60/mpdf.php"; 
				$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
				$mpdf->SetDisplayMode('fullpage');
				// 1 or 0 - whether to indent the first level of a list 
				$mpdf->list_indent_first_level = 0;
				$mpdf->WriteHTML($printContents);         
				$mpdf->Output($mypdf,'F');
				require_once "../../../mailsending/sendAttachment.php";		
				$emal=$dept_email.",".$user_email;
				send_attachment($emal,$str,$mypdf);
				unlink($mypdf);
			}else{
				echo "<script type='text/javascript'>alert('Something went wrong ! Please try again to complete the process of submission of the application form.');window.location.href='index.php';</script>";exit();
			}
			
		}else{
			echo "<script type='text/javascript'>alert('Something went wrong ! Please try again to complete the process of submission of the application form.');window.location.href='index.php';</script>";exit();
		}
	}
}
?>