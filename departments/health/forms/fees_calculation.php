<?php 

$reg_fees=0;

if($form==1 || $form==2 || $form==5 || $form==6){
	$fees_query="select location_type,fees_description from ".$table_name." where user_id='$swr_id' and active='1'";
	$fees_query_results=$formFunctions->executeQuery($dept,$fees_query);
	if($fees_query_results->num_rows>0){
		$row=$fees_query_results->fetch_object();
		$location_type=$row->location_type;
		$fees_description=$row->fees_description;
	}else{
		$location_type=0;
		$fees_description=0;
	}
	if($location_type=="U"){
		$fees_details_query="select provisional_fees,permanent_fees from fees_details_urban where id='$fees_description'";
	}else if($location_type=="R"){
		$fees_details_query="select provisional_fees,permanent_fees from fees_details_rural where id='$fees_description'";
	}else if($location_type=="M"){
		$fees_details_query="select provisional_fees,permanent_fees from fees_details_metro where id='$fees_description'";
	}else{
		$check_query="select uain,form_id from ".$table_name." where user_id='$swr_id' and save_mode='P' and active='1'";
		$query=$formFunctions->executeQuery($dept,$check_query);
		if($query->num_rows==0){
			echo "<script>
				alert('Something went wrong !!!.');
				window.location.href = 'payment_section.php?dept=".$dept."&form=".$form."';
			</script>";
		}
		$row=$query->fetch_array();	
		$form_id=$row["form_id"];
		$_SESSION["form_id"]=$form_id;
		echo "<script>window.location.href = '".$server_url."departments/requires/final_submit.php';</script>";	
	}
	$fees_details_query_results=$formFunctions->executeQuery($dept,$fees_details_query);
	
	if($form==1){
		$reg_fees=$fees_details_query_results->fetch_object()->permanent_fees;
	}else if($form==2){
		$reg_fees=$fees_details_query_results->fetch_object()->provisional_fees;
	}else if($form==5){
		$reg_fees=$fees_details_query_results->fetch_object()->permanent_fees;
		$reg_fees=$reg_fees/2;
	}else if($form==6){
		$reg_fees=$fees_details_query_results->fetch_object()->provisional_fees;
		$reg_fees=$reg_fees/2;
	}
	
}else if($form==3 || $form==4){
	$reg_fees=10000;
}else if($form==7 || $form==8){
	$reg_fees=5000;
}else{}
?>