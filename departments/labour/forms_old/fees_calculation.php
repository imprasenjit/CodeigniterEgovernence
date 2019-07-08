<?php 
function labour_fees_calculation($form,$workers){
	global $formFunctions;
	$reg_fees=0;
	if($workers>50000){
		$workers=50000;
	}
	if($form==2 || $form==6 || $form==10){
		$query="select form".$form."_amount from payment_details_forms_2_6_10 where $workers>=min_workers and $workers<=max_workers";
		$fees_results=$formFunctions->executeQuery("labour",$query);
		if($fees_results->num_rows>0){
			$fees_results_row=$fees_results->fetch_object();
			if($form==2){
				$reg_fees=$fees_results_row->form2_amount;
			}else if($form==6){
				$reg_fees=$fees_results_row->form6_amount;
			}else if($form==10){
				$reg_fees=$fees_results_row->form10_amount;
			}else{
				$reg_fees=0;
			}
		}
	}else if($form==7 || $form==8 || $form==11){
		$query="select form".$form."_amount from payment_details_forms_7_8_11 where $workers>=min_workers and $workers<=max_workers";
		$fees_results=$formFunctions->executeQuery("labour",$query);
		if($fees_results->num_rows>0){
			$fees_results_row=$fees_results->fetch_object();
			if($form==7){
				$reg_fees=$fees_results_row->form7_amount;
			}else if($form==8){
				$reg_fees=$fees_results_row->form8_amount;
			}else if($form==11){
				$reg_fees=$fees_results_row->form11_amount;
			}else{
				$reg_fees=0;
			}
		}
	}else if($form==12 || $form==13){
		$query="select form".$form."_amount from payment_details_forms_12_13 where $workers>=min_workers and $workers<=max_workers";
		$fees_results=$formFunctions->executeQuery("labour",$query);
		if($fees_results->num_rows>0){
			$fees_results_row=$fees_results->fetch_object();
			if($form==12){
				$reg_fees=$fees_results_row->form12_amount;
			}else if($form==13){
				$reg_fees=$fees_results_row->form13_amount;
			}else{
				$reg_fees=0;
			}
		}
	}else if($form==3){
		$query="select form3_amount from payment_details_form3 where $workers>=min_workers and $workers<=max_workers";
		$fees_results=$formFunctions->executeQuery("labour",$query);
		if($fees_results->num_rows>0){
			$fees_results_row=$fees_results->fetch_object();
			$reg_fees=$fees_results_row->form3_amount;
		}
	}else{}
	return $reg_fees;
}
function labour_form_1_9_fees_calculation($form,$estab_category,$workers){
	global $formFunctions;
	$reg_fees=0;
	if($workers>50000){
		$workers=50000;
	}
	$query="select form".$form."_amount from payment_details_forms_1_9 where shops_category_id='$estab_category' and $workers>=min_workers and $workers<=max_workers";
	$fees_results=$formFunctions->executeQuery("labour",$query);
	if($fees_results->num_rows>0){
		$fees_results_row=$fees_results->fetch_object();
		if($form==1){
			$reg_fees=$fees_results_row->form1_amount;
		}else{
			$reg_fees=$fees_results_row->form9_amount;
		}
	}
	
	return $reg_fees;
}
if($form==1 || $form==9){
	$estab_category_query="select estab_category,max_workers from ".$table_name." where user_id='$swr_id' and active='1'";
	$estab_category_query_results=$formFunctions->executeQuery($dept,$estab_category_query);
	if($estab_category_query_results->num_rows>0){
		$estab_category_row=$estab_category_query_results->fetch_object();
		$estab_category=$estab_category_row->estab_category;
		$max_workers=$estab_category_row->max_workers;
	}else{
		$estab_category="";
		$max_workers="0";
	}
	
	$reg_fees=labour_form_1_9_fees_calculation($form,$estab_category,$max_workers);
	
}else if($form==2 || $form==3 || $form==6 || $form==7 || $form==8 || $form==10 || $form==11 || $form==12 || $form==13){
	$max_workers_query="select max_workers from ".$table_name." where user_id='$swr_id' and active='1'";
	$max_workers_query_results=$formFunctions->executeQuery($dept,$max_workers_query);
	if($max_workers_query_results->num_rows>0){
		$max_workers_row=$max_workers_query_results->fetch_object();
		$max_workers=$max_workers_row->max_workers;
	}else{
		$max_workers=0;
	}
	$reg_fees=labour_fees_calculation($form,$max_workers);
	
}else if($form==4){	
	$total_grant_query="select total_grant from ".$table_name." where user_id='$swr_id' and active='1'";
	$total_grant_query_results=$formFunctions->executeQuery($dept,$total_grant_query);
	if($total_grant_query_results->num_rows>0){
		$total_grant=$total_grant_query_results->fetch_object()->total_grant;
	}else{
		$total_grant="";
	}
	if($total_grant<=120){
		$reg_fees=250;
	}else if($total_grant>=121 && $total_grant<=200){
		$reg_fees=500;
	}else{
		$reg_fees=750;
	}
}else if($form==5){	
	$max_workers_query="select max_workers from ".$table_name." where user_id='$swr_id' and active='1'";
	$max_workers_query_results=$formFunctions->executeQuery($dept,$max_workers_query);
	if($max_workers_query_results->num_rows>0){
		$max_workers_row=$max_workers_query_results->fetch_object();
		$max_workers=$max_workers_row->max_workers;
	}else{
		$max_workers=0;
	}
	if($max_workers<=100){
		$reg_fees=100;
	}else if($max_workers>=101 && $max_workers<=500){
		$reg_fees=500;
	}else{
		$reg_fees=1000;
	}
}else{
	
}
?>