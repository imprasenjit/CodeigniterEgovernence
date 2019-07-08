<?php
/*
-------common variable is $uain,$today
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
	$sqlcte=$pcb->query("select form_id,user_id,save_mode from ".$table_name." where uain='$uain'");
	$rowcte=$sqlcte->fetch_array();
	if($sqlcte->num_rows>0){
		$form_id=$rowcte['form_id'];
		$swr_id=$rowcte['user_id'];
		$save_mode=$rowcte['save_mode'];
		if($save_mode=="P"){
			$payment_insert=$pcb->query("INSERT INTO ".$table_name."_payment(form_id,CustomerID,TxnReferenceNo,
			BankReferenceNo,TxnAmount,BankID,BankMerchantID,TxnType,CurrencyName,TxnDate,AuthStatus,AdditionalInfo1,AdditionalInfo2,
			AdditionalInfo3,AdditionalInfo4,AdditionalInfo5,AdditionalInfo6,AdditionalInfo7,submitted_on) VALUES('$form_id','$CustomerID','$TxnReferenceNo','$BankReferenceNo','$TxnAmount','$BankID','$BankMerchantID','$TxnType','$CurrencyName','$TxnDate','$authStatus','$AdditionalInfo1','$AdditionalInfo2','$AdditionalInfo3','$AdditionalInfo4','$AdditionalInfo5','$AdditionalInfo6','$AdditionalInfo7','$submitted_on')") or die($pcb->error);
			if($payment_insert){
				$save_query=$pcb->query("update ".$table_name." set save_mode='C',payment_mode='1',offline_challan='$TxnReferenceNo',sub_date='$today' where form_id='$form_id' and user_id='$swr_id'") or die($pcb->error);
					
				$formFunctions->insert_applications($uain);
				$str=$formFunctions->getEmail_str($uain);
				/*----------------SEND MAIL-----------------*/
				$user_email=$formFunctions->get_usermail($swr_id);
				$dept_email="esgoa.pollution@gmail.com";
				
				if($form==1) require_once "form1_print.php"; 
				else if($form==2)  require_once "form2_print.php"; 
				else require_once "pcb_form".$form."_print.php"; 
				
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