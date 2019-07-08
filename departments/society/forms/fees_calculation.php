<?php 

$reg_fees=0;
if($form==2){
	$share_value_query="select share_value from ".$table_name." where user_id='$swr_id' and active='1'";
	$share_value_query_results=$formFunctions->executeQuery($dept,$share_value_query);
	if($share_value_query_results->num_rows>0){
		$share_value=$share_value_query_results->fetch_object()->share_value;
	}else{
		$share_value="";
	}
	$reg_fees=$share_value/100;
	$reg_fees=round($reg_fees);
}


?>