<?php
if(isset($_POST["save51"])){
    $from_year=clean($_POST["from_year"]);$to_year=clean($_POST["to_year"]);	
	$reference_uain=clean($_POST["reference_uain"]);$prev_cte_order_no=clean($_POST["prev_cte_order_no"]);$prev_cte_order_date=clean($_POST["prev_cte_order_date"]);
	
	if($prev_cte_order_date!="") $prev_cte_order_date=date("Y-m-d",strtotime($prev_cte_order_date)); else $prev_cte_order_date=NULL;
	
	$comm_name=clean($_POST["comm_name"]);$comm_st1=clean($_POST["comm_st1"]);$comm_st2=clean($_POST["comm_st2"]);$comm_vill=clean($_POST["comm_vill"]);$comm_dist=clean($_POST["comm_dist"]);$comm_pincode=clean($_POST["comm_pincode"]);$comm_mobile_no=clean($_POST["comm_mobile_no"]);$comm_email=clean($_POST["comm_email"]);
	$pre_status=clean($_POST["pre_status"]);$reason_renewal=clean($_POST["reason_renewal"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name." (user_id,sub_date,from_year,to_year,reference_uain,prev_cte_order_no,prev_cte_order_date,comm_name,comm_st1,comm_st2,comm_vill,comm_dist,comm_pincode,comm_mobile_no,comm_email,pre_status,reason_renewal) values ('$swr_id','$today','$from_year', '$to_year','$reference_uain','$prev_cte_order_no','$prev_cte_order_date','$comm_name', '$comm_st1', '$comm_st2','$comm_vill','$comm_dist', '$comm_pincode','$comm_mobile_no','$comm_email','$pre_status','$reason_renewal')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',from_year='$from_year',to_year='$to_year',reference_uain='$reference_uain',prev_cte_order_no='$prev_cte_order_no',prev_cte_order_date='$prev_cte_order_date',comm_name='$comm_name',comm_st1='$comm_st1',comm_st2='$comm_st2',comm_vill='$comm_vill',comm_dist='$comm_dist',comm_pincode='$comm_pincode',comm_mobile_no='$comm_mobile_no',comm_email='$comm_email',pre_status='$pre_status',reason_renewal='$reason_renewal' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}				
}
if(isset($_POST["save52"])){
	$from_year=clean($_POST["from_year"]);$to_year=clean($_POST["to_year"]);
	$reference_uain=clean($_POST["reference_uain"]);
	$prev_cto_order_no=clean($_POST["prev_cto_order_no"]);
	$prev_cto_order_date=clean($_POST["prev_cto_order_date"]);$prev_cto_order_validity_date=clean($_POST["prev_cto_order_validity_date"]);
	
	if($prev_cto_order_date!="") $prev_cto_order_date=date("Y-m-d",strtotime($prev_cto_order_date)); else $prev_cto_order_date=NULL;
	if($prev_cto_order_validity_date!="") $prev_cto_order_validity_date=date("Y-m-d",strtotime($prev_cto_order_validity_date));  else $prev_cto_order_validity_date=NULL;
	
	$prev_capital_investment=clean($_POST["prev_capital_investment"]);$capital_investment=clean($_POST["capital_investment"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,from_year,to_year,reference_uain,prev_cto_order_no,prev_cto_order_date,prev_cto_order_validity_date,prev_capital_investment,capital_investment) values ('$swr_id','$today','$from_year', '$to_year','$reference_uain','$prev_cto_order_no','$prev_cto_order_date','$prev_cto_order_validity_date','$prev_capital_investment','$capital_investment')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',from_year='$from_year',to_year='$to_year',reference_uain='$reference_uain',prev_cto_order_no='$prev_cto_order_no',prev_cto_order_date='$prev_cto_order_date',prev_cto_order_validity_date='$prev_cto_order_validity_date',prev_capital_investment='$prev_capital_investment',capital_investment='$capital_investment' where form_id=$form_id");
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=2';
		</script>";
	}				
}
?>