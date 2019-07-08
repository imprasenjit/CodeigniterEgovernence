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
	}else if($formName=="TRADE"){
		$form=1;
	}else{
		$form=substr($formName,1);
	}
	$table_name=$formFunctions->getTableName($dept,$form);
	$sql_query="select form_id,user_id,save_mode from ".$table_name." where uain='$uain'";
	$swl_results=$formFunctions->executeQuery($dept,$sql_query);
	
	
	if($swl_results->num_rows>0){
		$swl_row=$swl_results->fetch_array();
		$form_id=$swl_row['form_id'];
		$swr_id=$swl_row['user_id'];
		$save_mode=$swl_row['save_mode'];
		if($save_mode=="P"){
			
			$payment_update="INSERT INTO online_billdesk_payments(form_id,CustomerID,TxnReferenceNo,
			BankReferenceNo,TxnAmount,BankID,BankMerchantID,TxnType,CurrencyName,TxnDate,AuthStatus,AdditionalInfo1,AdditionalInfo2,
			AdditionalInfo3,AdditionalInfo4,AdditionalInfo5,AdditionalInfo6,AdditionalInfo7,submitted_on) VALUES('$form_id','$CustomerID','$TxnReferenceNo','$BankReferenceNo','$TxnAmount','$BankID','$BankMerchantID','$TxnType','$CurrencyName','$TxnDate','$authStatus','$AdditionalInfo1','$AdditionalInfo2','$AdditionalInfo3','$AdditionalInfo4','$AdditionalInfo5','$AdditionalInfo6','$AdditionalInfo7','$submitted_on')";
			
			$payment_insert=$formFunctions->executeQuery($dept,$payment_update);
			if($payment_insert){
				$submit_query="update ".$table_name." set payment_mode='1',offline_challan='$TxnReferenceNo' where form_id='$form_id' and user_id='$swr_id'";
				$save_query=$formFunctions->executeQuery($dept,$submit_query);
				if($save_query){
					$_SESSION["form_id"]=$form_id;
					echo "<script>window.location.href = '".$server_url."departments/requires/final_submit.php';</script>";	
				}
				
			}
		}	
	}
}
?>