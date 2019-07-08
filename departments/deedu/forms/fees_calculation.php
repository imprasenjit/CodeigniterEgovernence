<?php 

$reg_fees=0;

if($form==1 || $form==2 || $form==3){
	$education_stage_query="select education_stage from ".$table_name." where user_id='$swr_id' and active='1'";
	$education_stage_query_results=$formFunctions->executeQuery($dept,$education_stage_query);
	if($education_stage_query_results->num_rows>0){
		$education_stage=$education_stage_query_results->fetch_object()->education_stage;
		$education_stage_array=Array();
		$education_stage_array=explode(",",$education_stage);
	}else{
		$education_stage_array=Array();
	}
	if(in_array("P",$education_stage_array)) $reg_fees=$reg_fees+1000;
	if(in_array("M",$education_stage_array)) $reg_fees=$reg_fees+1500;
	if(in_array("S",$education_stage_array)) $reg_fees=$reg_fees+2000;
	if(in_array("H",$education_stage_array)) $reg_fees=$reg_fees+3000;
}else{
	
}

 

?>