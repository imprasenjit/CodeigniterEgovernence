<?php 

$reg_fees=0;

switch($form){
	case 5: $reg_fees=1000;
	break;
	case 13: $reg_fees=50;
	break;
	case 14: $reg_fees=25;
	break;
	case 18: $reg_fees=1000;
	break;
	case 15: 
	case 16: 
		$fees_query="select total_pesticides from ".$table_name." where user_id='$swr_id' and active='1'";
		$fees_query_results=$formFunctions->executeQuery($dept,$fees_query);
		if($fees_query_results->num_rows>0){
			$total_pesticides=$fees_query_results->fetch_object()->total_pesticides;
		}else{
			$total_pesticides="";
		}
		if($total_pesticides>0){
			$reg_fees=2000*$total_pesticides;
		}
		if(!isset($reg_fees) || $reg_fees==0 || $reg_fees>20000){
			$reg_fees=20000;
		}
	break;
	default : $reg_fees=0;
	break;
	
}

	


?>