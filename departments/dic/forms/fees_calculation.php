<?php

if($form==10 || $form==11){
	$actual_area_query="select actual_area from ".$table_name." where user_id='$swr_id' and active='1'";
	$actual_area_results=$formFunctions->executeQuery($dept,$actual_area_query);
	if($actual_area_results->num_rows>0){
		$actual_area_row=$actual_area_results->fetch_object();
		$actual_area=$actual_area_row->actual_area;
	}else{
		$actual_area=0;
	}
	$actual_area=round($actual_area);
	
	$reg_fees=round(0.5*$actual_area);
}
?>