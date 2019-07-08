<?php 
function factory_fees_calculation($manuf_process_nat_fac,$manuf_prod_max_emp,$power_p){
	global $formFunctions;
	//echo $manuf_process_nat_fac . "//". $power_p;die();
	switch($manuf_process_nat_fac){
		case "PGS":
			if($manuf_prod_max_emp>0 && $manuf_prod_max_emp<101){			
				$query=$formFunctions->executeQuery("factory","select fees_one from fees_schedule_b where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_one;
				}else{
					$fees=0;
				}
			}else if($manuf_prod_max_emp>100 && $manuf_prod_max_emp<251){
				$query=$formFunctions->executeQuery("factory","select fees_two from fees_schedule_b where capacity_min <= '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_two;
				}else{
					$fees=0;
				}
			}else if($manuf_prod_max_emp>250 && $manuf_prod_max_emp<501){
				$query=$formFunctions->executeQuery("factory","select fees_three from fees_schedule_b where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_three;
				}else{
					$fees=0;
				}
			}else{
				$query=$formFunctions->executeQuery("factory","select fees_four from fees_schedule_b where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_four;
				}else{
					$fees=0;
				}
			}
		break;
		case "ES":
			if($manuf_prod_max_emp>9){
				//echo "select fees_one from fees_schedule_c where capacity_min < '$power_p' and capacity_max > '$power_p'";
				$query=$formFunctions->executeQuery("factory","select fees_one from fees_schedule_c where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows > 0){
					$fees=$query->fetch_object()->fees_one;
				}else{
					$fees=0;
				}	
			}else{
				$fees=0;
			}
		break;
		default: 
			if($manuf_prod_max_emp>0 && $manuf_prod_max_emp<21){			
				$query=$formFunctions->executeQuery("factory","select fees_one from fees_schedule_a where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_one;
				}else{
					$fees=0;
				}
			}else if($manuf_prod_max_emp>20 && $manuf_prod_max_emp<51){
				$query=$formFunctions->executeQuery("factory","select fees_two from fees_schedule_a where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_two;
				}else{
					$fees=0;
				}
			}else if($manuf_prod_max_emp>50 && $manuf_prod_max_emp<101){
				$query=$formFunctions->executeQuery("factory","select fees_three from fees_schedule_a where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_three;
				}else{
					$fees=0;
				}
			}else if($manuf_prod_max_emp>100 && $manuf_prod_max_emp<501){
				$query=$formFunctions->executeQuery("factory","select fees_four from fees_schedule_a where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_four;
				}else{
					$fees=0;
				}
			}else if($manuf_prod_max_emp>500 && $manuf_prod_max_emp<1001){
				$query=$formFunctions->executeQuery("factory","select fees_five from fees_schedule_a where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_five;
				}else{
					$fees=0;
				}
			}else if($manuf_prod_max_emp>1000 && $manuf_prod_max_emp<2001){
				$query=$formFunctions->executeQuery("factory","select fees_six from fees_schedule_a where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_six;
				}else{
					$fees=0;
				}
			}else if($manuf_prod_max_emp>2000 && $manuf_prod_max_emp<5001){
				$query=$formFunctions->executeQuery("factory","select fees_seven from fees_schedule_a where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_seven;
				}else{
					$fees=0;
				}
			}else{
				$query=$formFunctions->executeQuery("factory","select fees_eight from fees_schedule_a where capacity_min < '$power_p' and capacity_max >= '$power_p'");
				if($query->num_rows>0){
					$fees=$query->fetch_object()->fees_eight;
				}else{
					$fees=0;
				}
			}
		break;
	}
	
	return $fees;
}
$query="select manuf_process,manuf_prod,power from ".$table_name." where user_id='$swr_id' and active='1'";
$query_results=$formFunctions->executeQuery($dept,$query);
if($query_results->num_rows>0){
	$row=$query_results->fetch_assoc();
	if(!empty($row["manuf_process"])){
		$manuf_process=json_decode($row["manuf_process"]);
		$manuf_process_carried=$manuf_process->carried;$manuf_process_car_fac=$manuf_process->car_fac;$manuf_process_nat_fac=$manuf_process->nat_fac;
	}else{
		$manuf_process_carried="";$manuf_process_car_fac="";$manuf_process_nat_fac="";
	}
	if(!empty($row["manuf_prod"])){
		$manuf_prod=json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $row["manuf_prod"]));
		$manuf_prod_nv=$manuf_prod->nv;$manuf_prod_max_emp=$manuf_prod->max_emp;
		$manuf_prod_max_emp1=$manuf_prod->max_emp1;$manuf_prod_max_emp2=$manuf_prod->max_emp2;
	}else{
		$manuf_prod_nv="";$manuf_prod_max_emp="";$manuf_prod_max_emp1="";$manuf_prod_max_emp2="";
	}
	if(!empty($row["power"])){
		$power=json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]\s+/', ' ', $row["power"]));
		$power_nature=$power->nature;$power_p=$power->p;$power_mp=$power->mp;
	}else{
		$power_nature="";$power_p="";$power_mp="";
	}
}else{
	$manuf_process_nat_fac="";
	$manuf_prod_max_emp="0";
	$power_p="0";
}
$reg_fees=factory_fees_calculation($manuf_process_nat_fac,$manuf_prod_max_emp,$power_p);
?>