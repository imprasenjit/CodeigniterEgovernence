<?php 
function fees_calculation($uain){
	global $pcb,$formFunctions;
	//$dept=$this->get_uainDept($uain);
	$form=$formFunctions->get_uainForm($uain);
	$table_name=$formFunctions->getTableName("pcb",$form);
	
	if($form==1 || $form==3){
		$fees_table="cte_fees_schedule";
		$results=$pcb->query("select form_id,dg_set,investment_cost from ".$table_name." where uain='$uain'") or  die($pcb->error);
	}else{
		$fees_table="cto_fees_schedule";
		$results=$pcb->query("select form_id,dg_set,investment_cost,application_for from ".$table_name." where uain='$uain'") or  die($pcb->error);
	}
			
	
	
	$reg_fees=0;
	if($results->num_rows>0){
		$row=$results->fetch_assoc();
		if(!empty($row["investment_cost"])){
			
			if(!is_numeric($row["investment_cost"])){
				$investment_cost=json_decode($row["investment_cost"]);
				$investment_cost_a=$investment_cost->a;$investment_cost_b=$investment_cost->b;
				$investment_cost_b=($investment_cost_b=="C")?'0000000':'00000';
				$investment_cost=$investment_cost_a.$investment_cost_b;
			}else{
				$investment_cost=$row["investment_cost"];
			}
			
			
			
			$fees_results=$pcb->query("select * from ".$fees_table." where min_invest<$investment_cost and max_invest>=$investment_cost") or die($pcb->error);
			if($fees_results->num_rows>0){
				$fees_details=$fees_results->fetch_object();
				$reg_fees=$fees_details->fee;
				
				$form_id=$row["form_id"];
				
				
				if($form==2 || $form==47 || $form==48 || $form==50){					
					
					if(!empty($row["application_for"])){				
						$application_for=json_decode($row["application_for"]);
						if(isset($application_for->a)) $application_for_a=$application_for->a; else $application_for_a="";
						if(isset($application_for->b)) $application_for_b=$application_for->b; else $application_for_b="";
						if(isset($application_for->c)) $application_for_c=$application_for->c; else $application_for_c="";			
					}else{
						$application_for_a="";$application_for_b="";$application_for_c="";
					}
					if(empty($application_for_a) || empty($application_for_b)){						
							$reg_fees=$reg_fees/2;
					}
				}
			}            
        }
    }
	return $reg_fees; 	
}
function dg_set_fees_calculation($uain){
	global $pcb,$formFunctions;
	$form=$formFunctions->get_uainForm($uain);
	$table_name=$formFunctions->getTableName("pcb",$form);
	$dgsets_reg_fees=0;
	if($form==1 || $form==3){
		$fees_table="cte_fees_schedule";
		$results=$pcb->query("select form_id,dg_set,investment_cost from ".$table_name." where  uain='$uain'") or  die($pcb->error);
	}else{
		$fees_table="cto_fees_schedule";
		$results=$pcb->query("select form_id,dg_set,investment_cost,application_for from ".$table_name." where  uain='$uain'") or  die($pcb->error);
	}
	if($results->num_rows>0){
		$row=$results->fetch_object();		
		$form_id=$row->form_id;		
		$results=$pcb->query("select * from ".$table_name."_dgsets where form_id='$form_id'") or  die($pcb->error);
		if($results->num_rows>0){
			while($rows=$results->fetch_object()){
				$dg_invest=$rows->dg_invest;
				$fees_results=$pcb->query("select * from ".$fees_table." where min_invest<$dg_invest and max_invest>=$dg_invest") or die($pcb->error);
				if($fees_results->num_rows>0){
					while($fees_details=$fees_results->fetch_object()){
						$dgsets_reg_fees=$fees_details->fee;
					}								
				}
			}
			if($form==2 || $form==47 || $form==48 || $form==50){
				if(!empty($row->application_for)){				
					$application_for=json_decode($row->application_for);
					if(isset($application_for->a)) $application_for_a=$application_for->a; else $application_for_a="";
					if(isset($application_for->b)) $application_for_b=$application_for->b; else $application_for_b="";
					if(isset($application_for->c)) $application_for_c=$application_for->c; else $application_for_c="";			
				}else{
					$application_for_a="";$application_for_b="";$application_for_c="";
				}
				if(empty($application_for_a) || empty($application_for_b)){						
						$dgsets_reg_fees=$dgsets_reg_fees/2;
				}
			}
			if($dgsets_reg_fees>0){
				$dgsets_reg_fees=$dgsets_reg_fees+100;
			}		
		}
	}
	return $dgsets_reg_fees; 	
}
?>