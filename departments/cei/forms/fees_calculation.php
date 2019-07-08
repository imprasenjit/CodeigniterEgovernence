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
				$calValue2 = floor($calValue/200);
				$calValue3 = floor($calValue2 * 600);
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
				$calValue2 = floor($calValue/200);
				$calValue3 = floor($calValue2 * 600);
				$renewal_fees = floor($calValue3 + 21600);
				$heating_value_details="OTHERS (ABOVE 3000SQ. METERS)";
			}			
		}	
		return $renewal_fees ."//".$heating_value_details;
	}else{
		return $renewal_fees ."//".$heating_value_details;
	}	
}
switch($form){
	case 1: $reg_fees=20;
	break;
	case 5: 
	case 22: $reg_fees=0;
	break;
	case 7: 
	case 9: 
		
		$is_lift_esc_query="select rated_speed from ".$table_name." where user_id='$swr_id' and active='1'";
		$is_lift_esc_query_results=$formFunctions->executeQuery($dept,$is_lift_esc_query);
		if($is_lift_esc_query_results->num_rows>0){
			$rated_speed=$is_lift_esc_query_results->fetch_object()->rated_speed;
		}else{
			$rated_speed="";
		}
		if($form==7){
			if($rated_speed >=0 && $rated_speed <= 0.63){
				$reg_fees=1000;
			}else if($rated_speed >0.63 && $rated_speed <= 1.00){
				$reg_fees=1500;
			}else{
				$reg_fees=2000;
			}
		}else{
			$reg_fees=5000;
		}
		
	break;
	
	case 11: 
	case 13: 
		
		$is_lift_esc_query="select rated_speed from ".$table_name." where user_id='$swr_id' and active='1'";
		$is_lift_esc_query_results=$formFunctions->executeQuery($dept,$is_lift_esc_query);
		if($is_lift_esc_query_results->num_rows>0){
			$rated_speed=$is_lift_esc_query_results->fetch_object()->rated_speed;
		}else{
			$rated_speed="";
		}
		if($rated_speed >=0 && $rated_speed <= 0.63){
			$reg_fees=1000;
		}else if($rated_speed >0.63 && $rated_speed <= 1.00){
			$reg_fees=1500;
		}else{
			$reg_fees=2000;
		}
	break;
	case 14: $reg_fees=5000;
	break;
	case 15:
	case 16: $reg_fees=500;
	break;
	case 17: $reg_fees=2000;
	break;
	case 18: $reg_fees=4000;
	break;
	case 20: 
		
		$is_lift_esc_query="select is_lift_esc from ".$table_name." where user_id='$swr_id' and active='1'";
		$is_lift_esc_query_results=$formFunctions->executeQuery($dept,$is_lift_esc_query);
		if($is_lift_esc_query_results->num_rows>0){
			$is_lift_esc=$is_lift_esc_query_results->fetch_object()->is_lift_esc;
		}else{
			$is_lift_esc="";
		}
		if($is_lift_esc == "L"){
			$reg_fees=2000;
		}else{
			$reg_fees=4000;
		}
	break;
	case 21: 
			$is_lift_esc_query="select is_lift_esc,rated_speed from ".$table_name." where user_id='$swr_id' and active='1'";
			$is_lift_esc_query_results=$formFunctions->executeQuery($dept,$is_lift_esc_query);
			if($is_lift_esc_query_results->num_rows>0){
				$is_lift_esc_row=$is_lift_esc_query_results->fetch_object();
				$is_lift_esc=$is_lift_esc_row->is_lift_esc;
				$rated_speed=$is_lift_esc_row->rated_speed;
			}else{
				$is_lift_esc="";
				$rated_speed="";
			}
			if($is_lift_esc == "L"){
				if($rated_speed >=0 && $rated_speed <= 0.63){
					$reg_fees=500;
				}else if($rated_speed >0.63 && $rated_speed <= 1.00){
					$reg_fees=800;
				}else{
					$reg_fees=1000;
				}
			}else{
				$reg_fees=3000;
			}
	break;
	default : $reg_fees=0;
	break;
	
}

	


?>