<?php 

$reg_fees=0;
function boiler_form1_fees_calculation($value){
	global $formFunctions;
	$fees=0;
	$heating_value_details="";
	if($value>0){
		$query="select * from fees_boiler_form1 where $value>=heating_value_range1 and $value<=heating_value_range2";
		$query_results=$formFunctions->executeQuery("boiler",$query);
		if($query_results->num_rows>0){
			$query_row=$query_results->fetch_object();
			$fees=$query_row->fees;
			$heating_value_details=$query_row->heating_value_details;
		}else{
			if($value > 3000){
				$calValue = $value-3000 ;
				$calValue2 = $calValue/200;
				$calValue3 = round($calValue2 * 600);
				$fees = floor($calValue3 + 21600);
				$heating_value_details="OTHERS (ABOVE 3000SQ. METERS)";
			}			
		}	
		return $fees ."//".$heating_value_details;
	}else{
		return $fees ."//".$heating_value_details;
	}
	 	
}

function boiler_form2_fees_calculation($value){
	global $formFunctions;
	$renewal_fees=0;
	$heating_value_details="";
	if($value>0){
		$query="select * from fees_boiler_form1 where $value>=heating_value_range1 and $value<=heating_value_range2";
		$query_results=$formFunctions->executeQuery("boiler",$query);
		if($query_results->num_rows>0){
			$query_row=$query_results->fetch_object();
			$renewal_fees=$query_row->renewal_fees;
			$heating_value_details=$query_row->heating_value_details;
		}else{
			if($value > 3000){
				$calValue = $value-3000 ;
				$calValue2 = $calValue/200;
				$calValue3 = round($calValue2 * 500);
				$renewal_fees = floor($calValue3 + 19000);
				$heating_value_details="OTHERS (ABOVE 3000SQ. METERS)";
			}			
		}	
		return $renewal_fees ."//".$heating_value_details;
	}else{
		return $renewal_fees ."//".$heating_value_details;
	}	
}
if(isset($_POST["heating_value"])){
	require_once "../../requires/login_session.php";
	
	$heating_value=$_POST["heating_value"];
	$form=$_POST["form"];
	if($form==1 || $form==6){		
		$reg_fees_details=boiler_form1_fees_calculation($heating_value);
	}else if($form==2){		
		$reg_fees_details=boiler_form2_fees_calculation($heating_value);
	}else{
		$reg_fees_details="0//0";
	}
	echo $reg_fees_details;
}else if(isset($_POST["classification_applied"])){
	require_once "../../requires/login_session.php";
	
	$classification_applied=$_POST["classification_applied"];
	$form=$_POST["form"];
	if($form==7 || $form==10){		
		if($classification_applied=="SC"){
			$reg_fees=15000;
		}else if($classification_applied=="C1"){
			$reg_fees=10000;
		}else if($classification_applied=="C2"){
			$reg_fees=5000;
		}else if($classification_applied=="C3"){
			$reg_fees=2500;
		}else{
			$reg_fees=15000;
		}
	}else if($form==8){		
		if($classification_applied=="SC"){
			$reg_fees=7500;
		}else if($classification_applied=="C1"){
			$reg_fees=5000;
		}else if($classification_applied=="C2"){
			$reg_fees=2500;
		}else if($classification_applied=="C3"){
			$reg_fees=1250;
		}else{
			$reg_fees=7500;
		}
	}else{
		$reg_fees=0;
	}
	echo $reg_fees;
}else{
	if($form==1 || $form==6){
		$heating_value_query="select heating_value,is_fabrication from ".$table_name." where user_id='$swr_id' and active='1'";
		$heating_value_results=$formFunctions->executeQuery($dept,$heating_value_query);
		if($heating_value_results->num_rows>0){
			$heating_value_row=$heating_value_results->fetch_object();
			$heating_value=$heating_value_row->heating_value;
			$is_fabrication=$heating_value_row->is_fabrication;
		}else{
			$heating_value=0;
			$is_fabrication="N";
		}
		$reg_fees_details=boiler_form1_fees_calculation($heating_value);
		
		$reg_fees_array=Array();
		$reg_fees_array=explode("//",$reg_fees_details);
		$reg_fees=$reg_fees_array[0];
		$heating_value_limit=$reg_fees_array[1];
		if($is_fabrication=="Y"){
			$reg_fees=$reg_fees*4;
		}
	}else if($form==2){
		$heating_value_query="select heating_value from ".$table_name." where user_id='$swr_id' and active='1'";
		$heating_value_results=$formFunctions->executeQuery($dept,$heating_value_query);
		if($heating_value_results->num_rows>0){
			$heating_value_row=$heating_value_results->fetch_object();
			$heating_value=$heating_value_row->heating_value;
		}else{
			$heating_value=0;
		}
		$reg_fees_details=boiler_form2_fees_calculation($heating_value);
		
		$reg_fees_array=Array();
		$reg_fees_array=explode("//",$reg_fees_details);
		$reg_fees=$reg_fees_array[0];
		$heating_value_limit=$reg_fees_array[1];
		
	}else if($form==7 || $form==10){
		$classification_applied_query="select classification_applied from ".$table_name." where user_id='$swr_id' and active='1'";
		$classification_applied_query_results=$formFunctions->executeQuery($dept,$classification_applied_query);
		if($classification_applied_query_results->num_rows>0){
			$classification_applied=$classification_applied_query_results->fetch_object()->classification_applied;
		}else{
			$classification_applied="";
		}
		
		if($classification_applied=="SC"){
			$reg_fees=15000;
		}else if($classification_applied=="C1"){
			$reg_fees=10000;
		}else if($classification_applied=="C2"){
			$reg_fees=5000;
		}else if($classification_applied=="C3"){
			$reg_fees=2500;
		}else{
			$reg_fees=15000;
		}
	}else if($form==8){
		$classification_applied_query="select classification_applied from ".$table_name." where user_id='$swr_id' and active='1'";
		$classification_applied_query_results=$formFunctions->executeQuery($dept,$classification_applied_query);
		if($classification_applied_query_results->num_rows>0){
			$classification_applied=$classification_applied_query_results->fetch_object()->classification_applied;
		}else{
			$classification_applied="";
		}
		
		if($classification_applied=="SC"){
			$reg_fees=7500;
		}else if($classification_applied=="C1"){
			$reg_fees=5000;
		}else if($classification_applied=="C2"){
			$reg_fees=2500;
		}else if($classification_applied=="C3"){
			$reg_fees=1250;
		}else{
			$reg_fees=7500;
		}
	}else{
		
	}
}


?>