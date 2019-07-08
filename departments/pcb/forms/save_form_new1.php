<?php

if(isset($_POST["save66"])){
	
	$date_acci=clean($_POST["date_acci"]);$event_seq=clean($_POST["event_seq"]);$type_construction=clean($_POST["type_construction"]);$effects_accidents=clean($_POST["effects_accidents"]);$emergency_measure=clean($_POST["emergency_measure"]);
	
	if(!empty($_POST["steps"])) $steps=json_encode($_POST["steps"]);
	else $steps=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,date_acci,event_seq,type_construction,effects_accidents,emergency_measure,steps) values ('$swr_id','$today','$date_acci','$event_seq','$type_construction','$effects_accidents','$emergency_measure','$steps')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',date_acci='$date_acci', event_seq='$event_seq', type_construction='$type_construction', effects_accidents='$effects_accidents',emergency_measure='$emergency_measure',steps='$steps' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($form,$dept); //pcb-- dept name and 68 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}

if(isset($_POST["save67"])){
	$address_authority=clean($_POST["address_authority"]);$appeal_made=clean($_POST["appeal_made"]);$sought_for=clean($_POST["sought_for"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,address_authority,appeal_made,sought_for) values ('$swr_id','$today','$address_authority','$appeal_made','$sought_for')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',address_authority='$address_authority',appeal_made='$appeal_made',sought_for='$sought_for' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($form,$dept); //pcb-- dept name and 68 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}

if(isset($_POST["save68"])){
	   
	$date_acci=clean($_POST["date_acci"]);$event_seq=clean($_POST["event_seq"]);$type_construction=clean($_POST["type_construction"]);$effects_accidents=clean($_POST["effects_accidents"]);$emergency_measure=clean($_POST["emergency_measure"]);$monthly_health=clean($_POST["monthly_health"]);$is_processing=clean($_POST["is_processing"]);$is_collection=clean($_POST["is_collection"]);
	
	
	if(!empty($_POST["steps"])) $steps=json_encode($_POST["steps"]);
	else $steps=NULL;
	if(!empty($_POST["collection"]))	$collection=json_encode($_POST["collection"]);
	else	$collection=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,date_acci,event_seq,type_construction,effects_accidents,emergency_measure,steps,monthly_health,is_processing,is_collection,collection) values ('$swr_id','$today','$date_acci', '$event_seq','$type_construction','$effects_accidents','$emergency_measure','$steps','$monthly_health','$is_processing','$is_collection','$collection')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',date_acci='$date_acci', event_seq='$event_seq', type_construction='$type_construction', effects_accidents='$effects_accidents',emergency_measure='$emergency_measure',steps='$steps',is_processing='$is_processing',is_collection='$is_collection',collection='$collection' where form_id=$form_id");		
	}				
	if($query){
		$formFunctions->insert_incomplete_forms($form,$dept); //pcb-- dept name and 68 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}


if(isset($_POST["save69"])){
	$input_size1=clean($_POST["hiddenval"]);		
	$reporting_period=clean($_POST["reporting_period"]);$name_city=clean($_POST["name_city"]);$city_population=clean($_POST["city_population"]);$area_kilometer=clean($_POST["area_kilometer"]);$summmechanisms=clean($_POST["summmechanisms"]);$details_manpower=clean($_POST["details_manpower"]);$details_contractor=clean($_POST["details_contractor"]);$is_difficulties=clean($_POST["is_difficulties"]);$is_prepared=clean($_POST["is_prepared"]);$facilities_validity=clean($_POST["facilities_validity"]);$facility2_valid=clean($_POST["facility2_valid"]);
	
	if(!empty($_POST["details_difficulties"]) && $_POST["is_difficulties"]=='Y')	$details_difficulties=$_POST["details_difficulties"];
	else	$details_difficulties=NULL;
	
	
	if(!empty($_POST["nmaddress"]))	  $nmaddress=json_encode($_POST["nmaddress"]);
	else	$nmaddress=NULL;
	if(!empty($_POST["totalnum"]))	$totalnum=json_encode($_POST["totalnum"]);
	else	$totalnum=NULL;
	if(!empty($_POST["quantity"]))	$quantity=json_encode($_POST["quantity"]);
	else	$quantity=NULL;
	if(!empty($_POST["facilities"]))	$facilities=json_encode($_POST["facilities"]);
	else	$facilities=NULL;
	if(!empty($_POST["facility2"]))	$facility2=json_encode($_POST["facility2"]);
	else	$facility2=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,reporting_period,name_city,city_population,area_kilometer,summmechanisms,details_manpower,details_contractor,is_difficulties,details_difficulties,is_prepared,nmaddress,totalnum,quantity,facilities,facilities_validity,facility2_valid,facility2) values ('$swr_id','$today','$reporting_period','$name_city','$city_population','$area_kilometer','$summmechanisms','$details_manpower','$details_contractor','$is_difficulties','$details_difficulties','$is_prepared','$nmaddress','$totalnum','$quantity','$facilities','$facilities_validity','$facility2_valid','$facility2')");
		$form_id=$query;
		
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery( $dept,"update ".$table_name." set sub_date='$today',reporting_period='$reporting_period',name_city='$name_city',city_population='$city_population',area_kilometer='$area_kilometer',summmechanisms='$summmechanisms',details_manpower='$details_manpower',details_contractor='$details_contractor',is_difficulties='$is_difficulties',details_difficulties='$details_difficulties',is_prepared='$is_prepared',nmaddress='$nmaddress',totalnum='$totalnum',quantity='$quantity',facilities='$facilities',facilities_validity='$facilities_validity',facility2_valid='$facility2_valid',facility2='$facility2' where form_id=$form_id" );			
	}
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);  
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$valg=$_POST["txtG".$i];
				$valh=$_POST["txtH".$i];
				$vali=$_POST["txtI".$i];
				$valj=$_POST["txtJ".$i];
				$valk=$_POST["txtK".$i];
				$vall=$_POST["txtL".$i];
				$valm=$_POST["txtM".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,name_spc,estimated_plastic,plastic_units,compostable_plastic,multilayer_plastic,no_unregistered,waste_management,complete_ban_usages,status_marking,explicit,details_meeting,no_violations) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf','$valg','$valh','$vali','$valj','$valk','$vall','$valm')") ;
			}
		}	
			
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";	
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php';
		</script>";
	}
}

if(isset($_POST["save70"])){
	
	$input_size1=clean($_POST["hiddenval"]);$input_size2=clean($_POST["hiddenval1"]);$issuance_dt=clean($_POST["issuance_dt"]);$ref_no=clean($_POST["ref_no"]);$description_management=clean($_POST["description_management"]);$environmental_dt=clean($_POST["environmental_dt"]);
	
	
	if(!empty($_POST["facility"])) $facility=json_encode($_POST["facility"]);
	else $facility=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,facility,issuance_dt,ref_no,description_management,environmental_dt) values ('$swr_id','$today','$facility', '$issuance_dt','$ref_no','$description_management','$environmental_dt')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',facility='$facility', issuance_dt='$issuance_dt', ref_no='$ref_no', description_management='$description_management',environmental_dt='$environmental_dt' where form_id=$form_id");		
	}				
	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);  
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txtB".$i];
				$valc=$_POST["txtC".$i];
				$vald=$_POST["txtD".$i];
				$vale=$_POST["txtE".$i];
				$valf=$_POST["txtF".$i];
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(id,form_id,slno,date,waste_category,tot_quantity,method_storage,received) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')") ;
			}
		}
		if($input_size2!=0){					
			$k1=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txxtB".$i];
				$valc=$_POST["txxtC".$i];
				$vald=$_POST["txxtD".$i];
				$vale=$_POST["txxtE".$i];
				$valf=$_POST["txxtF".$i];
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(id,form_id,slno,date,waste_category,tot_quantity,method_storage,received) VALUES ('','$form_id','$i','$valb','$valc','$vald','$vale','$valf')") ;
			}
		}
		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}


if(isset($_POST["save73"])){
	$address_authority=clean($_POST["address_authority"]);$appeal_made=clean($_POST["appeal_made"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();			
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,address_authority,appeal_made) values ('$swr_id','$today','$address_authority','$appeal_made')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',address_authority='$address_authority',appeal_made='$appeal_made' where form_id=$form_id");		
	}				
	if($query){
		
		$formFunctions->insert_incomplete_forms($form,$dept); //pcb-- dept name and 73 -- form no 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$server_url."departments/requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";		
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}			
}
?>