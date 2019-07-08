<?php
/*
-------common variable is $uain,$today
-------this page is commonly used in payment/pay.php also
*/

if(!empty($form)){
	if($save_mode=="P"){	
		
		$check_treasury_payment=$formFunctions->executeQuery("dicc","select * from pre_treasury_request a, treasury_response b where a.UAIN='$uain' and a.PaymentType='A' and a.PaymentStatus='1' and a.ChallanNo=b.applicationno ORDER BY a.id DESC LIMIT 1");
		if($check_treasury_payment->num_rows>0){
				$row=$check_treasury_payment->fetch_object();			
				$submitted_on=date("Y-m-d H:i:s");
				$response_time=$row->response_time;$totAmt=$row->totAmt;$TxnDate=$row->TxnDate;$tin=$row->tin;$BankID=$row->BankID;
				$applicationno=$row->applicationno;$PaymentType=$row->PaymentType;$Pay_Code=$row->Pay_Code;$Dept_Code=$row->Dept_Code;
				$TxnStatus=$row->TxnStatus;
				
				$insert_query="insert into `online_treasury_payments`(form_no,form_id,uain,ChallanNo,TxnAmount,BankReferenceNo,tin,TxnDate,TxnStatus,submitted_on,fee_type) values('$form','$form_id','$uain','$applicationno','$totAmt','$BankID','$tin','$TxnDate','$TxnStatus','$submitted_on','$PaymentType')";
				$insert_query_results=$formFunctions->executeQuery($dept,$insert_query);
				if($insert_query_results){
					$submit_query="update ".$table_name." set payment_mode='1',offline_challan='$applicationno' where form_id='$form_id' and user_id='$swr_id'";
					$save_query=$formFunctions->executeQuery($dept,$submit_query);
					if($save_query){
						$_SESSION["form_id"]=$form_id;
						echo "<script>window.location.href = '".$server_url."departments/requires/final_submit.php';</script>";	
					}
				}else{
					echo "<script type='text/javascript'>alert('1. Due to some technical outages, we do not receive the payment status of the final confirmation from the bank or payment gateway! Please try again to complete the process of submission of the application form.');window.location.href='../../users/';</script>";exit();
				}
			
		}else{
			echo "<script type='text/javascript'>alert('3. Due to some technical outages, we do not receive the payment status of the final confirmation from the bank or payment gateway! Please try again to complete the process of submission of the application form.');window.location.href='../../users/';</script>";exit();
		}
	}
}
?>