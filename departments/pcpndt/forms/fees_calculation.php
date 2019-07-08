<?php 

$reg_fees=0;

if($form==2 || $form==3){
	$fees_query="select fees_description from ".$table_name." where user_id='$swr_id' and active='1'";
	$fees_query_results=$formFunctions->executeQuery($dept,$fees_query);
	if($fees_query_results->num_rows>0){
		$row=$fees_query_results->fetch_object();
		$fees_description=$row->fees_description;
	}else{
		$fees_description=0;
	}
	if($fees_description==1){
		$reg_fees=25000;
		if($form==3){
			$reg_fees=$reg_fees/2;
		}
	}else{
		$reg_fees=35000;
		if($form==3){
			$reg_fees=$reg_fees/2;
		}
	}
	
}else{}
?>