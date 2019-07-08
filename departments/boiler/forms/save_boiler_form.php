<?php
if(isset($_POST["save1"])){
	$boiler_location=clean($_POST["boiler_location"]);$maker_no=clean($_POST["maker_no"]);$manu_name=clean($_POST["manu_name"]);$manu_year=clean($_POST["manu_year"]);$offering_insp_date=clean($_POST["offering_insp_date"]);$is_fabrication=clean($_POST["is_fabrication"]);
	if(isset($_POST["heating_value"])) $heating_value=clean($_POST["heating_value"]);
	else $heating_value=NULL;
	if(!empty($_POST["boiler_type"]))	 $boiler_type=json_encode($_POST["boiler_type"]);
	else	$boiler_type=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,boiler_location,maker_no,manu_name,manu_year,boiler_type,offering_insp_date,heating_value,is_fabrication) values ('$swr_id','$today','$boiler_location', '$maker_no', '$manu_name', '$manu_year', '$boiler_type', '$offering_insp_date', '$heating_value', '$is_fabrication')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', boiler_location='$boiler_location', maker_no='$maker_no', manu_name='$manu_name', manu_year='$manu_year', boiler_type='$boiler_type', offering_insp_date='$offering_insp_date', heating_value='$heating_value', is_fabrication='$is_fabrication' where form_id='$form_id'");			
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}		
}				

if(isset($_POST["save2"])){	
	$boiler_location=clean($_POST["boiler_location"]);$reg_no=clean($_POST["reg_no"]);$manu_name=clean($_POST["manu_name"]);$manu_year=clean($_POST["manu_year"]);$safety_valves=clean($_POST["safety_valves"]);$caliberation_date=clean($_POST["caliberation_date"]);$boiler_interior=clean($_POST["boiler_interior"]);$boiler_engr_name=clean($_POST["boiler_engr_name"]);$certificate_no=clean($_POST["certificate_no"]);$tentative_date=clean($_POST["tentative_date"]);
	if(isset($_POST["heating_value"])) $heating_value=clean($_POST["heating_value"]);
        else $heating_value=NULL;
	if(!empty($_POST["boiler_type"]))	 $boiler_type=json_encode($_POST["boiler_type"]);
	else	$boiler_type=NULL;
	
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,boiler_location,reg_no,manu_name,manu_year,boiler_type,heating_value,safety_valves,caliberation_date,boiler_interior,boiler_engr_name,certificate_no,tentative_date) values ('$swr_id','$today','$boiler_location', '$reg_no', '$manu_name', '$manu_year', '$boiler_type', '$heating_value','$safety_valves', '$caliberation_date', '$boiler_interior', '$boiler_engr_name', '$certificate_no', '$tentative_date')");
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',  boiler_location='$boiler_location', reg_no='$reg_no', manu_name='$manu_name', manu_year='$manu_year', boiler_type='$boiler_type' ,heating_value='$heating_value' ,safety_valves='$safety_valves', caliberation_date='$caliberation_date', boiler_interior='$boiler_interior', boiler_engr_name='$boiler_engr_name', certificate_no='$certificate_no', tentative_date='$tentative_date' where form_id=$form_id");				
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}							
}

if(isset($_POST["save3"])){	
	$places_visit=clean($_POST["places_visit"]);	
	$is_copy_report=clean($_POST["is_copy_report"]);$is_sup_materials=clean($_POST["is_sup_materials"]);$non_destructive_testing=clean($_POST["non_destructive_testing"]);$directorate_info=clean($_POST["directorate_info"]);
	$input_size1=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$input_size3=$_POST["hiddenval3"];$input_size4=$_POST["hiddenval4"];$input_size5=$_POST["hiddenval5"];
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,places_visit,is_copy_report,is_sup_materials,non_destructive_testing,directorate_info) values ('$swr_id','$today','$places_visit', '$is_copy_report', '$is_sup_materials','$non_destructive_testing','$directorate_info')");
		$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', places_visit='$places_visit',is_copy_report='$is_copy_report',is_sup_materials='$is_sup_materials', non_destructive_testing='$non_destructive_testing', directorate_info='$directorate_info' where user_id='$swr_id' and form_id='$form_id'");	
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
				$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,details_machine,tools,tackles) VALUES ('$form_id','$i','$valb','$valc','$vald')") or die("error in insertion ".$table_name."_t1".$boiler->error);
			}
		}
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
				/*$vala=$_POST["txtA".$i];	*/		
				$valb=$_POST["textB".$i];
				$valc=$_POST["textC".$i];
				$vald=$_POST["textD".$i];
				$vale=$_POST["textE".$i];
				$valf=$_POST["textF".$i];	
				$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,name2,experience2,riveters,slotters,other_working_per) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale','$valf')");
			}
		}
		if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
			for($i=1;$i<$input_size3;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txB".$i];
				$valc=$_POST["txC".$i];
				$vald=$_POST["txD".$i];
				$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,name3,qualification3,experience3) VALUES ('$form_id','$i','$valb','$valc','$vald')") or die("error in insertion ".$table_name."_t3".$boiler->error);
			}
		}
		if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
			for($i=1;$i<$input_size4;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["txttB".$i];
				$valc=$_POST["txttC".$i];
				$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,slno,name4,address4) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
			for($i=1;$i<$input_size5;$i++){
				//$vala=$_POST["txtA".$i];		
				$valb=$_POST["ttxtB".$i];
				$valc=$_POST["ttxtC".$i];
				$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(form_id,slno,name_equip,det_equip) VALUES ('$form_id','$i','$valb','$valc')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}			
}

if(isset($_POST["save4"])){
	$inspector_places=clean($_POST["inspector_places"]);$is_repairs=clean($_POST["is_repairs"]);$is_fabricator=clean($_POST["is_fabricator"]);$testing_fabrication=clean($_POST["testing_fabrication"]);$job_significant=clean($_POST["job_significant"]);$class_applied=clean($_POST["class_applied"]);
	$input_size1=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];$input_size3=$_POST["hiddenval3"];$input_size4=$_POST["hiddenval4"];$input_size5=$_POST["hiddenval5"];$input_size6=$_POST["hiddenval6"];
		
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////				
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,inspector_places,is_repairs,is_fabricator,testing_fabrication,job_significant,class_applied) values ('$swr_id','$today','$inspector_places','$is_repairs','$is_fabricator','$testing_fabrication','$job_significant','$class_applied')");
			$form_id=$query;
	}else{
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',inspector_places='$inspector_places',is_repairs='$is_repairs',is_fabricator='$is_fabricator',testing_fabrication='$testing_fabrication',job_significant='$job_significant',class_applied='$class_applied' where form_id=$form_id");
	}	
    if($query){
			$formFunctions->insert_incomplete_forms($dept,$form);  
			if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
				for($i=1;$i<$input_size1;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["txtB".$i];
					$valc=$_POST["txtC".$i];
					$vald=$_POST["txtD".$i];	
					$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,details_of_machines,tools,tackles) VALUES ('$form_id','$i','$valb','$valc','$vald')");
				}
			}
			if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
				for($i=1;$i<$input_size2;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["textB".$i];
					$valc=$_POST["textC".$i];
					$vald=$_POST["textD".$i];
					$vale=$_POST["textE".$i];	
					$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,name_of_fitters,name_of_riveters,name_of_slotters,others_working_personnel) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
				}
			}
			if($input_size3!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t3 where form_id='$form_id'");
				for($i=1;$i<$input_size3;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["tcB".$i];
					$valc=$_POST["tcC".$i];
					$vald=$_POST["tcD".$i];
					$vale=$_POST["tcE".$i];	
					$part3=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t3(form_id,slno,exp_of_fitters,exp_of_riveters,exp_of_slotters,others_working) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
				}
			}
			if($input_size4!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t4 where form_id='$form_id'");
				for($i=1;$i<$input_size4;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["tbB".$i];
					$valc=$_POST["tbC".$i];
					$vald=$_POST["tbD".$i];
					$part4=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t4(form_id,slno,name1,qualifications1,experience1) VALUES ('$form_id','$i','$valb','$valc','$vald')");
				}
			}
			if($input_size5!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t5 where form_id='$form_id'");
				for($i=1;$i<$input_size5;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["tdB".$i];
					$valc=$_POST["tdC".$i];
					$part5=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t5(form_id,slno,name,address) VALUES ('$form_id','$i','$valb','$valc')");
				}
			}
			if($input_size6!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t6 where form_id='$form_id'");
				for($i=1;$i<$input_size6;$i++){
					/*$vala=$_POST["txtA".$i];	*/		
					$valb=$_POST["teB".$i];
					$valc=$_POST["teC".$i];
					$part6=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t6(form_id,slno,name2,details) VALUES ('$form_id','$i','$valb','$valc')");
				}
			}
			echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}			
}
	
if(isset($_POST["save5"])){	
	$is_firm=clean($_POST["is_firm"]);$is_copy_report=clean($_POST["is_copy_report"]);	$is_firm_prepared=clean($_POST["is_firm_prepared"]);	$is_internal_quality=clean($_POST["is_internal_quality"]);	$numeric_power_stn=clean($_POST["numeric_power_stn"]);$is_conservant=clean($_POST["is_conservant"]);$is_instruments=clean($_POST["is_instruments"]);	$testing=clean($_POST["testing"]);	$is_recording=clean($_POST["is_recording"]); $is_internal_quality_details=clean($_POST["is_internal_quality_details"]); 
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
	if(!empty($_POST["class_applied"]))	 $class_applied=json_encode($_POST["class_applied"]);
	else	$class_applied=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	if($sql->num_rows<1){////////////table is empty//////////////
    $query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_copy_report,class_applied,is_firm_prepared,is_firm,is_internal_quality,numeric_power_stn,is_conservant,is_instruments,testing,is_recording,is_internal_quality_details) values ('$swr_id','$today','$is_copy_report','$class_applied','$is_firm_prepared', '$is_firm','$is_internal_quality','$numeric_power_stn','$is_conservant','$is_instruments','$testing','$is_recording','$is_internal_quality_details')");
		$form_id=$query;
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' , is_copy_report='$is_copy_report',class_applied='$class_applied',is_firm_prepared='$is_firm_prepared',is_firm='$is_firm',is_internal_quality='$is_internal_quality',numeric_power_stn='$numeric_power_stn', is_conservant='$is_conservant',is_instruments='$is_instruments',testing='$testing',is_recording='$is_recording',is_internal_quality_details='$is_internal_quality_details' where user_id='$swr_id' and form_id='$form_id'");
	}
	if($input_size!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
		for($i=1;$i<$input_size;$i++){
			//$vala=$_POST["txtA".$i];		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,details_technical,	details_supervisory,qualification,experience) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
		}
	}
	if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
		for($i=1;$i<$input_size2;$i++){
		//$vala=$_POST["textA".$i];			
		$valb=$_POST["txxtB".$i];
		$valc=$_POST["txxtC".$i];
		$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,name1,experience) VALUES ('$form_id','$i','$valb','$valc')");
		}
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}			
}		

if(isset($_POST["save6"])){
	$boiler_location=clean($_POST["boiler_location"]);$maker_no=clean($_POST["maker_no"]);$manu_name=clean($_POST["manu_name"]);$manu_year=clean($_POST["manu_year"]);$offering_insp_date=clean($_POST["offering_insp_date"]);$is_fabrication=clean($_POST["is_fabrication"]);
	if(isset($_POST["heating_value"])) $heating_value=clean($_POST["heating_value"]);
	else $heating_value=NULL;
	if(!empty($_POST["boiler_type"]))	 $boiler_type=json_encode($_POST["boiler_type"]);
	else	$boiler_type=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,boiler_location,maker_no,manu_name,manu_year,boiler_type,offering_insp_date,heating_value,is_fabrication) values ('$swr_id','$today','$boiler_location', '$maker_no', '$manu_name', '$manu_year', '$boiler_type', '$offering_insp_date', '$heating_value', '$is_fabrication')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', boiler_location='$boiler_location', maker_no='$maker_no', manu_name='$manu_name', manu_year='$manu_year', boiler_type='$boiler_type', offering_insp_date='$offering_insp_date', heating_value='$heating_value', is_fabrication='$is_fabrication' where form_id='$form_id'");			
	}	
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}		
}	

if(isset($_POST["save7a"])){
	$esta_yr=clean($_POST["esta_yr"]);
	
	$jobs_typ=clean($_POST["jobs_typ"]);$is_firm_approved=clean($_POST["is_firm_approved"]);$firm_app_det=clean($_POST["firm_app_det"]);$is_recogn_req=clean($_POST["is_recogn_req"]);$firm_app_details=clean($_POST["firm_app_details"]);$is_rec_gener=clean($_POST["is_rec_gener"]);$working_sites=clean($_POST["working_sites"]);$classification_applied=clean($_POST["classification_applied"]);
	$input_size1=clean($_POST["hiddenval"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,esta_yr,classification_applied,jobs_typ,is_firm_approved,firm_app_det,is_recogn_req,firm_app_details,is_rec_gener,working_sites) values ('$swr_id','$today','$esta_yr', '$classification_applied', '$jobs_typ', '$is_firm_approved', '$firm_app_det', '$is_recogn_req', '$firm_app_details','$is_rec_gener', '$working_sites')");	
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', esta_yr='$esta_yr',classification_applied='$classification_applied',jobs_typ='$jobs_typ',is_firm_approved='$is_firm_approved',firm_app_det='$firm_app_det', is_recogn_req='$is_recogn_req' , firm_app_details='$firm_app_details',is_rec_gener='$is_rec_gener',working_sites='$working_sites' where form_id='$form_id'");			
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];
			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,designation,qualification,experience) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}		
}

if(isset($_POST["save7b"])){
	$is_firm_pre_execute=clean($_POST["is_firm_pre_execute"]);$is_firm_pre_accept=clean($_POST["is_firm_pre_accept"]);
	$is_firm_supply_mat=clean($_POST["is_firm_supply_mat"]);$is_firm_internal=clean($_POST["is_firm_internal"]);
	$firm_int_qua_det=clean($_POST["firm_int_qua_det"]);
	$input_size2=clean($_POST["hiddenval2"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_firm_pre_execute,is_firm_pre_accept,is_firm_supply_mat,is_firm_internal,firm_int_qua_det) values ('$swr_id','$today','$is_firm_pre_execute', '$is_firm_pre_accept', '$is_firm_supply_mat', '$is_firm_internal', '$firm_int_qua_det')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', is_firm_pre_execute='$is_firm_pre_execute', is_firm_pre_accept='$is_firm_pre_accept', is_firm_supply_mat='$is_firm_supply_mat', is_firm_internal='$is_firm_internal', firm_int_qua_det='$firm_int_qua_det' where form_id='$form_id'");
	}
	if($query){
	if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
		for($i=1;$i<$input_size2;$i++){
		/*$vala=$_POST["txtA".$i];	*/		
		$valb=$_POST["textB".$i];
		$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,name2) VALUES ('$form_id','$i','$valb')");
		}
	}
	echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}			
}

if(isset($_POST["save8a"])){
	$esta_yr=clean($_POST["esta_yr"]);
	$jobs_typ=clean($_POST["jobs_typ"]);$is_firm_approved=clean($_POST["is_firm_approved"]);$firm_app_det=clean($_POST["firm_app_det"]);$is_recogn_req=clean($_POST["is_recogn_req"]);$firm_app_details=clean($_POST["firm_app_details"]);$is_rec_gener=clean($_POST["is_rec_gener"]);$working_sites=clean($_POST["working_sites"]);$classification_applied=clean($_POST["classification_applied"]);
	$input_size1=clean($_POST["hiddenval"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,esta_yr,classification_applied,jobs_typ,is_firm_approved,firm_app_det,is_recogn_req,firm_app_details,is_rec_gener,working_sites) values ('$swr_id','$today','$esta_yr', '$classification_applied', '$jobs_typ', '$is_firm_approved', '$firm_app_det', '$is_recogn_req', '$firm_app_details','$is_rec_gener', '$working_sites')");	
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', esta_yr='$esta_yr',classification_applied='$classification_applied',jobs_typ='$jobs_typ',is_firm_approved='$is_firm_approved',firm_app_det='$firm_app_det', is_recogn_req='$is_recogn_req' , firm_app_details='$firm_app_details',is_rec_gener='$is_rec_gener',working_sites='$working_sites' where form_id='$form_id'");			
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];
			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,designation,qualification,experience) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}		
}

if(isset($_POST["save8b"])){
	
	$is_firm_pre_execute=clean($_POST["is_firm_pre_execute"]);$is_firm_pre_accept=clean($_POST["is_firm_pre_accept"]);
	$is_firm_supply_mat=clean($_POST["is_firm_supply_mat"]);$is_firm_internal=clean($_POST["is_firm_internal"]);
	$firm_int_qua_det=clean($_POST["firm_int_qua_det"]);
	$input_size2=clean($_POST["hiddenval2"]);
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();

	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_firm_pre_execute,is_firm_pre_accept,is_firm_supply_mat,is_firm_internal,firm_int_qua_det) values ('$swr_id','$today','$is_firm_pre_execute', '$is_firm_pre_accept', '$is_firm_supply_mat', '$is_firm_internal', '$firm_int_qua_det')");				
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', is_firm_pre_execute='$is_firm_pre_execute', is_firm_pre_accept='$is_firm_pre_accept', is_firm_supply_mat='$is_firm_supply_mat', is_firm_internal='$is_firm_internal', firm_int_qua_det='$firm_int_qua_det' where form_id='$form_id'");
	}
	if($query){
		if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["textB".$i];
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,name2) VALUES ('$form_id','$i','$valb')");
			}
		}
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";						
	}else{
	   echo "<script>
	   alert('Invalid Entry');
	   window.location.href = '".$table_name.".php';
	</script>";
	}			
 }

if(isset($_POST["save9"])){	
	$is_firm=clean($_POST["is_firm"]);$is_copy_report=clean($_POST["is_copy_report"]);	$is_firm_prepared=clean($_POST["is_firm_prepared"]);	$is_internal_quality=clean($_POST["is_internal_quality"]);	$numeric_power_stn=clean($_POST["numeric_power_stn"]);$is_conservant=clean($_POST["is_conservant"]);$is_instruments=clean($_POST["is_instruments"]);	$testing=clean($_POST["testing"]);	$is_recording=clean($_POST["is_recording"]); $is_internal_quality_details=clean($_POST["is_internal_quality_details"]); 
	$input_size=$_POST["hiddenval"];$input_size2=$_POST["hiddenval2"];
	if(!empty($_POST["class_applied"]))	 $class_applied=json_encode($_POST["class_applied"]);
	else	$class_applied=NULL;
	
	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	if($sql->num_rows<1){////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_copy_report,class_applied,is_firm_prepared,is_firm,is_internal_quality,numeric_power_stn,is_conservant,is_instruments,testing,is_recording,is_internal_quality_details) values ('$swr_id','$today','$is_copy_report','$class_applied','$is_firm_prepared', '$is_firm','$is_internal_quality','$numeric_power_stn','$is_conservant','$is_instruments','$testing','$is_recording','$is_internal_quality_details')");
		$form_id=$query;
	}else{
		$row=$sql->fetch_array();
		$form_id=$row["form_id"];		
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today',received_date='$today' , is_copy_report='$is_copy_report',class_applied='$class_applied',is_firm_prepared='$is_firm_prepared',is_firm='$is_firm',is_internal_quality='$is_internal_quality',numeric_power_stn='$numeric_power_stn', is_conservant='$is_conservant',is_instruments='$is_instruments',testing='$testing',is_recording='$is_recording',is_internal_quality_details='$is_internal_quality_details' where user_id='$swr_id' and form_id='$form_id'");
	}
	if($input_size!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
		for($i=1;$i<$input_size;$i++){
			//$vala=$_POST["txtA".$i];		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,details_technical,	details_supervisory,qualification,experience) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
		}
	}
	if($input_size2!=0){					
		$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
		for($i=1;$i<$input_size2;$i++){
		//$vala=$_POST["textA".$i];			
		$valb=$_POST["txxtB".$i];
		$valc=$_POST["txxtC".$i];
		$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,name1,experience) VALUES ('$form_id','$i','$valb','$valc')");
		}
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form); 
		
		echo "<script>
			alert('Successfully Saved..');
			window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
		</script>";						
	}else{
		   echo "<script>
		   alert('Invalid Entry');
		   window.location.href = '".$table_name.".php';
		</script>";
	}			
 } 
 
 if(isset($_POST["save10a"])){
	$esta_yr=clean($_POST["esta_yr"]);
	
	if(!empty($_POST["classification_applied"]))	$classification_applied=json_encode($_POST["classification_applied"]);
	else $classification_applied=NULL;
		
	$jobs_typ=clean($_POST["jobs_typ"]);$is_firm_approved=clean($_POST["is_firm_approved"]);$firm_app_det=clean($_POST["firm_app_det"]);$is_recogn_req=clean($_POST["is_recogn_req"]);$firm_app_details=clean($_POST["firm_app_details"]);$is_rec_gener=clean($_POST["is_rec_gener"]);$working_sites=clean($_POST["working_sites"]);
	$input_size1=clean($_POST["hiddenval"]);

	$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
	$row=$sql->fetch_array();
	
	if($sql->num_rows<1){   ////////////table is empty//////////////
		$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,esta_yr,classification_applied,jobs_typ,is_firm_approved,firm_app_det,is_recogn_req,firm_app_details,is_rec_gener,working_sites) values ('$swr_id','$today','$esta_yr', '$classification_applied', '$jobs_typ', '$is_firm_approved', '$firm_app_det', '$is_recogn_req', '$firm_app_details','$is_rec_gener', '$working_sites')");	
		$form_id=$query;
	}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', esta_yr='$esta_yr',classification_applied='$classification_applied',jobs_typ='$jobs_typ',is_firm_approved='$is_firm_approved',firm_app_det='$firm_app_det', is_recogn_req='$is_recogn_req' , firm_app_details='$firm_app_details',is_rec_gener='$is_rec_gener',working_sites='$working_sites' where form_id='$form_id'");			
	}
	if($query){
		$formFunctions->insert_incomplete_forms($dept,$form);  
		if($input_size1!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t1 where form_id='$form_id'");
			for($i=1;$i<$input_size1;$i++){
			/*$vala=$_POST["txtA".$i];*/		
			$valb=$_POST["txtB".$i];
			$valc=$_POST["txtC".$i];
			$vald=$_POST["txtD".$i];
			$vale=$_POST["txtE".$i];
			
			$part1=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t1(form_id,slno,name,designation,qualification,experience) VALUES ('$form_id','$i','$valb','$valc','$vald','$vale')");
			}
		}
		echo "<script>
				alert('Successfully Saved..');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}else{
		echo "<script>
			alert('Something went wrong !!!');
			window.location.href = '".$table_name.".php?tab=1';
		</script>";
	}		
}

if(isset($_POST["save10b"])){
		$is_firm_pre_execute=clean($_POST["is_firm_pre_execute"]);$is_firm_pre_accept=clean($_POST["is_firm_pre_accept"]);
		$is_firm_supply_mat=clean($_POST["is_firm_supply_mat"]);$is_firm_internal=clean($_POST["is_firm_internal"]);
		$firm_int_qua_det=clean($_POST["firm_int_qua_det"]);
		$input_size2=clean($_POST["hiddenval2"]);
		
		$sql=$formFunctions->executeQuery($dept,"select form_id from ".$table_name." where user_id='$swr_id' and active='1'");
		$row=$sql->fetch_array();
	
		if($sql->num_rows<1){   ////////////table is empty//////////////
			$query=$formFunctions->executeQueryInsertID($dept,"insert into ".$table_name."(user_id,sub_date,is_firm_pre_execute,is_firm_pre_accept,is_firm_supply_mat,is_firm_internal,firm_int_qua_det) values ('$swr_id','$today','$is_firm_pre_execute', '$is_firm_pre_accept', '$is_firm_supply_mat', '$is_firm_internal', '$firm_int_qua_det')");				
		}else{  ////////////table is not empty//////////////
		$form_id=$row["form_id"];	
		$query=$formFunctions->executeQuery($dept,"update ".$table_name." set sub_date='$today', is_firm_pre_execute='$is_firm_pre_execute', is_firm_pre_accept='$is_firm_pre_accept', is_firm_supply_mat='$is_firm_supply_mat', is_firm_internal='$is_firm_internal', firm_int_qua_det='$firm_int_qua_det' where form_id='$form_id'");			
	}
	if($query){
	if($input_size2!=0){					
			$k=$formFunctions->executeQuery($dept,"delete from ".$table_name."_t2 where form_id='$form_id'");
			for($i=1;$i<$input_size2;$i++){
			/*$vala=$_POST["txtA".$i];	*/		
			$valb=$_POST["textB".$i];
			$part2=$formFunctions->executeQuery($dept,"INSERT INTO ".$table_name."_t2(form_id,slno,name2) VALUES ('$form_id','$i','$valb')");
			}
		}
		echo "<script>
				alert('Successfully saved.');
				window.location.href = '../../requires/upload_section.php?dept=".$dept."&form=".$form."';
			</script>";		
	}else{
			echo "<script>
				alert('Something went wrong !!!');
				window.location.href = '".$table_name.".php?tab=2';
			</script>";
	}			
 }
?>