<?php
/*
-------common variable is $uain,$today
-------this page is commonly used in payment/pay.php also
*/
if($formName=="TRADE"){
	$sqltrade=$water->query("select form_id,user_id,save_mode from water_form1 where uain='$uain'");
	$rowtrade=$sqltrade->fetch_array();
	if($sqltrade->num_rows>0){
		$form_id=$rowtrade['form_id'];
		$swr_id=$rowtrade['user_id'];
		$save_mode=$rowtrade['save_mode'];
		if($save_mode=="D"){
			$payment_insert=$water->query("INSERT INTO water_form1_payment(form_id,CustomerID,TxnReferenceNo,BankReferenceNo,TxnAmount,BankID,BankMerchantID,TxnType,CurrencyName,TxnDate,AuthStatus,AdditionalInfo1,AdditionalInfo2,AdditionalInfo3,AdditionalInfo4,AdditionalInfo5,AdditionalInfo6,AdditionalInfo7,submitted_on) VALUES('$form_id','$CustomerID','$TxnReferenceNo','$BankReferenceNo','$TxnAmount','$BankID','$BankMerchantID','$TxnType','$CurrencyName','$TxnDate','$authStatus','$AdditionalInfo1','$AdditionalInfo2','$AdditionalInfo3','$AdditionalInfo4','$AdditionalInfo5','$AdditionalInfo6','$AdditionalInfo7','$submitted_on')") or die($mysqli->error);
			if($payment_insert){
				$save_query=$water->query("update water_form1 set save_mode='C',payment_mode='1',sub_date='$today' where form_id='$form_id' and user_id='$swr_id'") or die($water->error);
				//$uain=$water->query("select uain from trade_license where form_id='$form_id'")->fetch_object()->uain;
						
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				
				/*----------------SEND MAIL-----------------*/
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.water@gmail.com";
				
				require_once "water_form1_print.php"; 
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
			}
		}	
	}
}
if($formName=="F2"){
	$sqltrade=$water->query("select form_id,user_id,save_mode from water_form2 where uain='$uain'");
	$rowtrade=$sqltrade->fetch_array();
	if($sqltrade->num_rows>0){
		$form_id=$rowtrade['form_id'];
		$swr_id=$rowtrade['user_id'];
		$save_mode=$rowtrade['save_mode'];
		if($save_mode=="D"){
			$payment_insert=$water->query("INSERT INTO water_form2_payment(form_id,CustomerID,TxnReferenceNo,BankReferenceNo,TxnAmount,BankID,BankMerchantID,TxnType,CurrencyName,TxnDate,AuthStatus,AdditionalInfo1,AdditionalInfo2,AdditionalInfo3,AdditionalInfo4,AdditionalInfo5,AdditionalInfo6,AdditionalInfo7,submitted_on) VALUES('$form_id','$CustomerID','$TxnReferenceNo','$BankReferenceNo','$TxnAmount','$BankID','$BankMerchantID','$TxnType','$CurrencyName','$TxnDate','$authStatus','$AdditionalInfo1','$AdditionalInfo2','$AdditionalInfo3','$AdditionalInfo4','$AdditionalInfo5','$AdditionalInfo6','$AdditionalInfo7','$submitted_on')") or die($mysqli->error);
			if($payment_insert){
				$save_query=$water->query("update water_form2 set save_mode='C',payment_mode='1',sub_date='$today' where form_id='$form_id' and user_id='$swr_id'") or die($water->error);
				//$uain=$water->query("select uain from trade_license where form_id='$form_id'")->fetch_object()->uain;
						
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				
				/*----------------SEND MAIL-----------------*/
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.water@gmail.com";
				
				require_once "water_form2_print.php"; 
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
			}
		}	
	}
}
if($formName=="F3"){
	$sqltrade=$water->query("select form_id,user_id,save_mode from water_form3 where uain='$uain'");
	$rowtrade=$sqltrade->fetch_array();
	if($sqltrade->num_rows>0){
		$form_id=$rowtrade['form_id'];
		$swr_id=$rowtrade['user_id'];
		$save_mode=$rowtrade['save_mode'];
		if($save_mode=="D"){
			$payment_insert=$water->query("INSERT INTO water_form3_payment(form_id,CustomerID,TxnReferenceNo,BankReferenceNo,TxnAmount,BankID,BankMerchantID,TxnType,CurrencyName,TxnDate,AuthStatus,AdditionalInfo1,AdditionalInfo2,AdditionalInfo3,AdditionalInfo4,AdditionalInfo5,AdditionalInfo6,AdditionalInfo7,submitted_on) VALUES('$form_id','$CustomerID','$TxnReferenceNo','$BankReferenceNo','$TxnAmount','$BankID','$BankMerchantID','$TxnType','$CurrencyName','$TxnDate','$authStatus','$AdditionalInfo1','$AdditionalInfo2','$AdditionalInfo3','$AdditionalInfo4','$AdditionalInfo5','$AdditionalInfo6','$AdditionalInfo7','$submitted_on')") or die($mysqli->error);
			if($payment_insert){
				$save_query=$water->query("update water_form3 set save_mode='C',payment_mode='1',sub_date='$today' where form_id='$form_id' and user_id='$swr_id'") or die($water->error);
				//$uain=$water->query("select uain from trade_license where form_id='$form_id'")->fetch_object()->uain;
						
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				
				/*----------------SEND MAIL-----------------*/
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.water@gmail.com";
				
				require_once "water_form3_print.php"; 
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
			}
		}	
	}
}
if($formName=="F4"){
	$sqltrade=$water->query("select form_id,user_id,save_mode from water_form4 where uain='$uain'");
	$rowtrade=$sqltrade->fetch_array();
	if($sqltrade->num_rows>0){
		$form_id=$rowtrade['form_id'];
		$swr_id=$rowtrade['user_id'];
		$save_mode=$rowtrade['save_mode'];
		if($save_mode=="D"){
			$payment_insert=$water->query("INSERT INTO water_form4_payment(form_id,CustomerID,TxnReferenceNo,BankReferenceNo,TxnAmount,BankID,BankMerchantID,TxnType,CurrencyName,TxnDate,AuthStatus,AdditionalInfo1,AdditionalInfo2,AdditionalInfo3,AdditionalInfo4,AdditionalInfo5,AdditionalInfo6,AdditionalInfo7,submitted_on) VALUES('$form_id','$CustomerID','$TxnReferenceNo','$BankReferenceNo','$TxnAmount','$BankID','$BankMerchantID','$TxnType','$CurrencyName','$TxnDate','$authStatus','$AdditionalInfo1','$AdditionalInfo2','$AdditionalInfo3','$AdditionalInfo4','$AdditionalInfo5','$AdditionalInfo6','$AdditionalInfo7','$submitted_on')") or die($mysqli->error);
			if($payment_insert){
				$save_query=$water->query("update water_form4 set save_mode='C',payment_mode='1',sub_date='$today' where form_id='$form_id' and user_id='$swr_id'") or die($water->error);
				//$uain=$water->query("select uain from trade_license where form_id='$form_id'")->fetch_object()->uain;
						
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				
				/*----------------SEND MAIL-----------------*/
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.water@gmail.com";
				
				require_once "water_form4_print.php"; 
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
			}
		}	
	}
}
?>